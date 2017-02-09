<?php namespace Ixudra\Validation;


trait NumberValidationTrait {

    public function validatePositive($attribute, $value, $parameters)
    {
        return ( $value > 0 );
    }

    public function validateNegative($attribute, $value, $parameters)
    {
        return ( $value < 0 );
    }

}