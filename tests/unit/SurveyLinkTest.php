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
        $this->assertStringContainsString("https://app.wehelpsoftware.com/survey_persons/link", $url);
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
}
