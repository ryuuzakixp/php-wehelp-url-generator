## Description

Function to help generate valid url for surveys on Wehelp

## Installation

```bash
composer require ryuuzakixp/php-wehelp-url-generator
```

## Usage

Example minimum data required

```php
    use WeHelpUrlGenerator\SurveyLink;

    $encryptKey = 'xxxx';

    $url = SurveyLink::generate([
        'code' => 'xxx',
        'experience_id' => 'xxxx', 
        'experience_date' => 'xxx',//Y-m-d H:i:s
        'company_unit_code' => 'xxxx', 
        'person' => [
            'name' => 'xxxx', 
            'internal_code' => 'xxxxx', 
            'type' => 'xxxxx',//CUSTOMER,COLLABORATOR
            'company_unit_code' => 'xxx'
        ]
    ], $encryptKey);
```
Example full data

```php
    use WeHelpUrlGenerator\SurveyLink;

    $encryptKey = 'xxxx';

    $url = SurveyLink::generate([
        'code' => 'xxx',
        'experience_id' => 'xxxx', 
        'experience_date' => 'xxx',//Y-m-d H:i:s
        'company_unit_code' => 'xxxx', 
        'person' => [
            'name' => 'xxxx', 
            'internal_code' => 'xxxxx', 
            'type' => 'xxxxx',//CUSTOMER,COLLABORATOR
            'company_unit_code' => 'xxx',
            'created_at' => '2022-10-10',
            'date_of_birth' => '1988-07-06',
            'language' => 'PORTUGUESE', //PORTUGUESE,SPANISH,ENGLISH
            'email' => 'xxxxxx',
            'phone' => 'xxxxx',
        ],
        'cf' => [
            11 => 'xxxxx', //ID Custom field => value
            12 => 'xxxxx' //ID Custom field => value
        ]
    ], $encryptKey);
```
## Exceptions

To prevent errors when generating a valid url, we validate the mandatory fields, if the field does not exist an WeHelpUrlGenerator\RequiredFieldException will be thrown.