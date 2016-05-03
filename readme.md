# REST API BMI calculation
Test project for Vitaly. 

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
- type of response (json or xml)

## Demo:

Calculate BMI for weight 85 kg, height 185 (metric):

http://bmi.lt/get/?weight=85&height=185&unit=metric&type=json

Calculate BMI for weight 187 pounds, height 72 inches (imperial):

http://bmi.lt/get/?weight=187&height=72&unit=imperial&type=json

  
## Featuers


## Links

http://www.whathealth.com/bmi/formula.html - about a formula