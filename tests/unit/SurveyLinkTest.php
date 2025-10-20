<?php

namespace WeHelpUrlGenerator\Test\unit;

use PHPUnit\Framework\TestCase;
use WeHelpUrlGenerator\RequiredFieldException;
use WeHelpUrlGenerator\SurveyLink;

class SurveyLinkTest extends TestCase
{
    public function testGenerate_WhenDataIsValid_ReturnValidUrl()
    {
        $encryptKey = 'xxxx';

        $url = SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->assertNotEmpty($url);
        $this->assertStringContainsString("https://app.wehelpsoftware.com/link", $url);
    }

    public function testGenerate_WhenDataNoHasValidFields_ReturnRequiredFieldException()
    {
        $encryptKey = 'xxxx';

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            //'code' => 'xxxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            //'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            //'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            //'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            //'person' => [
                //'name' => 'xxxx', 
                //'internal_code' => 'xxxxx', 
                //'type' => 'xxxxx',
                //'company_unit_code' => 'xxx'
            //]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                //'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                //'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                //'type' => 'xxxxx',
                'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);

        $this->expectException(RequiredFieldException::class);
        SurveyLink::generate([
            'code' => 'xxx',
            'experience_id' => null, 
            'experience_date' => 'xxx',
            'company_unit_code' => 'xxxx', 
            'person' => [
                'name' => 'xxxx', 
                'internal_code' => 'xxxxx', 
                'type' => 'xxxxx',
                //'company_unit_code' => 'xxx'
            ]
        ], $encryptKey);
    }

    public function testGenerate_WhenCfIsEmptyArray_ShouldRemoveCfFromPayload()
    {
        $encryptKey = 'test-secret-key';

        $url = SurveyLink::generate([
            'code' => 'TEST123',
            'experience_id' => 1, 
            'experience_date' => '2025-10-20',
            'company_unit_code' => 'UNIT001', 
            'cf' => [], // Empty array - should be removed
            'person' => [
                'name' => 'John Silva', 
                'internal_code' => 'EMP001', 
                'type' => 'customer',
                'company_unit_code' => 'UNIT001'
            ]
        ], $encryptKey);

        // Extract token from URL
        $this->assertNotEmpty($url);
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        $token = $params['access_token'];

        // Decode JWT payload
        $parts = explode('.', $token);
        $this->assertCount(3, $parts, 'JWT must have 3 parts');
        
        $payload = json_decode($this->base64UrlDecode($parts[1]), true);

        // Verify that 'cf' does not exist in payload
        $this->assertArrayNotHasKey('cf', $payload, 'Empty cf field should be removed from payload');
        
        // Verify that other fields are present
        $this->assertArrayHasKey('code', $payload);
        $this->assertArrayHasKey('person', $payload);
    }

    public function testGenerate_WhenCfHasValues_ShouldKeepCfInPayload()
    {
        $encryptKey = 'test-secret-key';

        $url = SurveyLink::generate([
            'code' => 'TEST456',
            'experience_id' => 2, 
            'experience_date' => '2025-10-20',
            'company_unit_code' => 'UNIT002', 
            'cf' => [
                11 => 'valor1',
                12 => 'valor2'
            ],
            'person' => [
                'name' => 'Mary Santos', 
                'internal_code' => 'EMP002', 
                'type' => 'customer',
                'company_unit_code' => 'UNIT002'
            ]
        ], $encryptKey);

        // Extract token from URL
        $this->assertNotEmpty($url);
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        $token = $params['access_token'];

        // Decode JWT payload
        $parts = explode('.', $token);
        $this->assertCount(3, $parts, 'JWT must have 3 parts');
        
        $payload = json_decode($this->base64UrlDecode($parts[1]), true);

        // Verify that 'cf' exists in payload when it has values
        $this->assertArrayHasKey('cf', $payload, 'Cf field with values should be kept in payload');
        $this->assertEquals([11 => 'valor1', 12 => 'valor2'], $payload['cf']);
    }

    /**
     * Helper method to decode base64 URL
     */
    private function base64UrlDecode(string $input): string
    {
        return base64_decode(strtr($input, '_-', '+/'));
    }
}
