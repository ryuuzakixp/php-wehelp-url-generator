## Description

Function to help generate valid url for surveys on Wehelp

## Installation

```bash
composer require ryuuzakixp/php-wehelp-url-generator
```

## Usage

```php
    use WeHelpUrlGenerator\SurveyLink;

    $encryptKey = "xxxx";

    $url = SurveyLink::generate([
        'code' => "xxx",
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
```