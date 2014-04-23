Validation
==========

Custom PHP validation library for the Laravel 4 framework - developed by Ixudra.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.




## Installation

Pull this package in through Composer.

```js
{
    "require": {
        "ixudra/validation": "dev-master"
    }
}
```

Add the API service provider to your app.php file

```php
    providers     => array(

        //...
        'Ixudra\Validation\ValidationServiceProvider',
    )
```

Once this is done, you can access the API using the alias you have selected in you app.php file.



## Usage

The package is implemented to augment the existing validation rules with additional rules. This implies that there are no special actions that need to be taken to get it to work. You would just have to create a validator in tha same way you would before. You will automatically have access to all original validation rules provided by Laravel and additional validation rules provided by the package.

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


Have fun!