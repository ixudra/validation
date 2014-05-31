<?php namespace Ixudra\Validation;


class IxudraValidator extends \Illuminate\Validation\Validator {

    // ============================================================================================================
    //      Truthy
    // ============================================================================================================

    public function validateTruthy($attribute, $value, $parameters)
    {
        if( $value === true ) {
            return true;
        }

        if( $value === false ) {
            return true;
        }

        return false;
    }

    public function validateTrue($attribute, $value, $parameters)
    {
        return ( $value === true );
    }


    // ============================================================================================================
    //      Date
    // ============================================================================================================

    public function validatePast($attribute, $value, $parameters)
    {
        $date = $this->getValueAsDate($value);

        return ( ( $date != null ) && ( (new \DateTime()) > ($date) ) );
    }

    public function validateFuture($attribute, $value, $parameters)
    {
        $date = $this->getValueAsDate($value);

        return ( ( $date != null ) && ( (new \DateTime()) < ($date) ) );
    }

    public function validateLessThanThreeDaysOld($attribute, $value, $parameters)
    {
        $date = $this->getValueAsDate($value);

        return ( ( $date != null ) && ( (new \DateTime( date('Y-m-d H:i:s', strtotime('-3 days')) )) < ($date) ) );
    }

    public function validateTodayOrLater($attribute, $value, $parameters)
    {
        $date = null;
        try {
            $date = new \DateTime($value);
        } catch( \Exception $e ) {
            return false;
        }

        return ( ( new \DateTime( date('Y-m-d') ) ) <= ( $date ) );
    }

    protected function getValueAsDate($value)
    {
        $date = null;

        try {
            $date = new \DateTime($value);
        } catch( \Exception $e ) {

        }

        return $date;
    }


    // ============================================================================================================
    //      Time
    // ============================================================================================================

    public function validateTime($attribute, $value, $parameters)
    {
        if( strtotime( $value ) !== false ) {
            return true;
        }

        return false;
    }

    public function validateTimeFormat($attribute, $value, $parameters)
    {
        if( preg_match("/^(2[0-3]|[01]?[1-9]):([0-5]?[0-9])$/", $value) ) {
            return true;
        }

        return false;
    }


    // ============================================================================================================
    //      String
    // ============================================================================================================

    public function validateEmpty($attribute, $value, $parameters)
    {
        return ( $value == '' );
    }


    // ============================================================================================================
    //      Array
    // ============================================================================================================

    public function validateArraySize($attribute, $value, $parameters)
    {
        if( !is_array( $value ) ) {
            return false;
        }

        return ( sizeof($value) == $parameters[0] );
    }

    public function validateOneOrMoreSelected($attribute, $value, $parameters)
    {
        if( !is_array( $value ) ) {
            return false;
        }

        $count = 0;
        foreach( $value as $item ) {
            if( $item ) {
                ++$count;
            }
        }

        return ( $count > 0 );
    }


    // ============================================================================================================
    //      JSON
    // ============================================================================================================

    function validateJson($attribute, $value, $parameters)
    {
        if( $value === true || $value === false ) {
            return false;
        }

        if( is_numeric($value) ) {
            return false;
        }

        json_decode($value);

        return (json_last_error() == JSON_ERROR_NONE);
    }


    // ============================================================================================================
    //      Telephone
    // ============================================================================================================

    public function validateTelephoneNumber($attribute, $value, $parameters)
    {
        if( preg_match("/^0(4)?([0-9]){2}\\/([0-9]){2}\\.([0-9]){2}\\.([0-9]){2}/", $value) ) {
            return true;
        }

        return false;
    }


    // ============================================================================================================
    //      Coordinates
    // ============================================================================================================

    public function validateWorldCoordinate($attribute, $value, $parameters)
    {
        if( preg_match("/^([0-9]){1,2}\\.([0-9]){2,6}$/", $value) ) {
            return true;
        }

        return false;
    }


    // ============================================================================================================
    //      Password
    // ============================================================================================================

    public function validateValidPassword($attribute, $value, $parameters)
    {
        if( strlen($value) < 6 ) {
            return false;
        }

        if( preg_match('/\d/', $value) != 1 ) {
            return false;
        }

        if( preg_match('/[A-Z]/', $value) != 1 ) {
            return false;
        }

        if( preg_match('/[@#&?.-_%$]/', $value) != 1 ) {
            return false;
        }

        return true;
    }

    public function validateCorrectPassword($attribute, $value, $parameters)
    {
        $credentials = array(
            'email'         => \Auth::user()->email,
            'password'      => $value
        );

        return ( \Auth::validate($credentials) );
    }


    // ============================================================================================================
    //      User
    // ============================================================================================================

    public function validateEmailBelongsToAuthenticatedUser($attribute, $value, $parameters)
    {
        return ( $value == \Auth::user()->email );
    }

    public function validateIdBelongsToAuthenticatedUser($attribute, $value, $parameters)
    {
        return ( $value == \Auth::user()->id );
    }

}
