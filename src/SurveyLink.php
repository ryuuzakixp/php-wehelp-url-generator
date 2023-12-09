<?php 

namespace WeHelpUrlGenerator;

class SurveyLink
{
    private const BASE_URL = 'https://app.wehelpsoftware.com/survey_persons/link';
    private string $queryParams;

    private function __construct(array $data, string $encryptKey)
    {
        $this->validationRequiredFields($data);

        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);

        $payload = json_encode($data);

        $signature = hash_hmac('sha256', $header . $payload, $encryptKey, true);

        $accessToken = $this->base64UrlEncode($header) . '.' . $this->base64UrlEncode($payload) . '.' . $this->base64UrlEncode($signature);

        $this->queryParams = "?access_token=" . $accessToken;
    }

    /**
     * @throws RequiredFieldException
     */
    public static function generate(array $data, string $encryptKey): string
    {
        $instance = new self($data, $encryptKey);
        return $instance->getUrl();
    }

    private function base64UrlEncode($input): string
    {
        return strtr(base64_encode($input), '+/', '_-');
    }

    private function getUrl(): string
    {
        return self::BASE_URL . $this->queryParams;
    }

    /**
     * @throws RequiredFieldException
     */
    private function validationRequiredFields(array $data): void
    {
        $requireFields = [
            'code',
            'experience_id',
            'experience_date',
            'company_unit_code',
            'person'
        ];

        foreach ((array_values($requireFields)) as $key) {
            if (!array_key_exists($key, $data)) {
                throw new RequiredFieldException("Required field: $key not found");
            }
        }

        $requiredFieldPerson = [
            'name',
            'internal_code',
            'type', 
            'company_unit_code'
        ];

        foreach ((array_values($requiredFieldPerson)) as $key) {
            if (!array_key_exists($key, $data['person'])) {
                throw new RequiredFieldException("Required field: $key not found");
            }
        }
    }
}