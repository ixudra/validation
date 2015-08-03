ixudra/validation
======================

Custom PHP validation library - developed by [Ixudra](http://ixudra.be).

This package provides a wide variety of validation rules for PHP web applications. These rules can be used to easily validate
user input to make sure that it meets the requirements that you have set.

Please also note that this package is intended for, but not exclusive to the Laravel framework. This basically means that
most validation methods are universally usable in any PHP application but some make use of internal Laravel components
(e.g. see `UserValidationTrait`). These methods will probably not work correctly unless you also include the used dependencies
in you application as well.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom
workflow. It may not suit your project perfectly and modifications may be in order.



## Installation

Pull this package in through Composer.

```js
{

    "require": {
        "ixudra/validation": "1.*"
    }

}
```



## Laravel usage

To use this package with Laravel 4 or 5, you will have to extend the default validator class. Once this class is created, you can
include the traits into the class to make use of the validation methods. Laravel will automatically pick up the validation
rules and make them available to you. Note that you don't have to include all traits if you don't want to. All validation
rules are completely independent, which allows for maximum customization.

```php

    use Ixudra\Validation\DateValidationTrait;
    use Ixudra\Validation\TimeValidationTrait;
    use Ixudra\Validation\ArrayValidationTrait;
    use Ixudra\Validation\PasswordValidationTrait;
    use Ixudra\Validation\CoordinateValidationTrait;

    class CustomValidator extends \Illuminate\Validation\Validator {

        use DateValidationTrait;
        use TimeValidationTrait;
        use ArrayValidationTrait;
        use PasswordValidationTrait;
        use CoordinateValidationTrait;

    }

```

Next, you will need to add the following to your `routes.php` to let Laravel know that you want to use your custom validator
class instead of the default one:

```php

    Validator::resolver(function($translator, $data, $rules, $messages)
    {
        return new CustomValidator($translator, $data, $rules, $messages);
    });

```

Once this is done, you are all set to go. You can now include the custom validation rules in the same way you use the default
rules that Laravel already provides to you:

```php

    $attributes = array(
        'att1'              => 'john.doe@gmail.com',
        'att2'              => 0,
        'att3'              => date('Y-m-d', strtotime('next week'))
    );

    $rules = array(
        'att1'              => 'required|email',
        'att2'              => 'required|truthy',
        'att3'              => 'required|future'
    );

    $validator = Validator::make( $attributes, $rules );
    $validator->fails();

```



## Available validation methods

### Array Validation

- **array_size**: validates the size of an array
- **one_or_more_selected**: returns `true` if an array contains an entry where the value is `true`


### Date Validation

- **past**: returns `true` if the value contains a date which is set in the past
- **future**: returns `true` if the value contains a date which is set in the future (not including today)
- **less_than_three_days_old**: returns `true` if the value contains a date which is set less that three days in the past
- **today_or_later**: returns `true` if the value contains a date which is set in the future (including today)


### File Validation

- **unique_file_name**: returns `true` if the value a unique file name. This function expects the full path name of the file starting from the Laravel `public/` directory


### JSON Validation

- **json**: returns `true` is the value contains a valid JSON string


### Number Validation

- **positive**: returns `true` is the value larger than 0
- **negative**: returns `true` if the value is smaller than 0


### Password Validation

- **valid_password**: returns `true` is the value contains a valid password (at least 6 characters long, at least one lowercase letter, at least one uppercase letter and at least one number) 
- **correct_password**: returns `true` if the value contains the correct password for the authenticated user (does not try to re-authenticate the user)


### String Validation

- **empty**: returns `true` if the value contains an empty string


### Telephone Validation

- **telephone_number**: returns `true` if the value contains a valid (Belgian) telephone number


### Time Validation

- **time**: returns `true` if the value contains a valid timestamp
- **time_format**: returns `true` if the value contains a timestamp with the specified format


### Truthy Validation

- **truthy**: returns `true` if the value is either `true` of `false`
- **true**: returns `true` if the value is `true`


### User Validation

- **email_belongs_to_authenticated_user**: returns `true` if the value contains an email address which belongs to the authenticated user
- **id_belongs_to_authenticated_user**: returns `true` if the value contains an ID which belongs to the authenticated user 


Have fun!