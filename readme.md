# REST API BMI calculation
Test project for Vitaly. 

## About

For test task purposes some features were used:

- OOP pattern "Strategy" for units. So, it's easy now to add any unit type
- PHP framework "Slim"
- Monolog for logging
- PHPUnit tests for class Bmi 
- Composer
- functional test and Guzzle for api request
- Bootstrap 3 for example

## Installation

- Via Composer install all required components:

``` bash
$ composer install --no-dev
```

If you want to user dev stuff (like PHPUnit), remove --no-dev

- Chmod /logs/ for writing

## Params

Parameters via GET request:
 
- height (cm for metric, inches for imperial)
- weight (kg for metric, pounds for imperial)
- unit (metric or imperial)

## Demo:

<b>Live demo:</b>

http://bakharevich.by/projects/bmi/public/bmi.html

<b>API response</b> - calculate BMI for weight 85 kg, height 185 (metric):

http://bakharevich.by/projects/bmi/public/get/?weight=85&height=185&unit=metric

<b>API response</b> - calculate BMI for weight 187 pounds, height 72 inches (imperial):

http://bakharevich.by/projects/bmi/public/get/?weight=187&height=72&unit=imperial

  
## Featuers


## Links

http://www.whathealth.com/bmi/formula.html - about a formula