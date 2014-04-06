<?php namespace Ixudra\Validation;


use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {

    protected $defer = false;

    protected $rules = array(

        // Truthy
        'truthy',
        'true',

        // Date
        'past',
        'future',
        'lessThanThreeDaysOld',
        'todayOrLater',

        // Time
        'time',
        'timeFormat',

        // String
        'empty',

        // Array
        'arraySize',
        'oneOrMoreSelected',

        // Telephone
        'telephoneNumber',

        // Coordinates
        'worldCoordinate',

        // Password
        'validPassword',
        'correctPassword',

        // User
        'emailBelongsToAuthenticatedUser',
        'idBelongsToAuthenticatedUser',

    );


    public function boot()
    {
        $this->package('ixudra/validation', 'IxdVal');

        $app = $this->app;
        $this->app->bind('Ixudra\Validation\IxudraValidator', function($app)
        {
            $validator = new IxudraValidator( $app['translator'], array(), array(), $app['translator']->get('IxdVal::validation') );

            if( isset( $app['validation.presence'] ) ) {
                $validator->setPresenceVerifier( $app['validation.presence'] );
            }

            $validator->setContainer($app);

            return $validator;
        });

        $this->addNewRules();
    }

    protected function addNewRules()
    {
        foreach( $this->rules as $rule ) {
            $method = 'validate' . studly_case($rule);
            $translation = $this->app['translator']->get('IxdVal::validation');

            $this->app['validator']->extend($rule, 'Ixudra\Validation\IxudraValidator@' . $method, $translation[$rule]);
        }
    }

    public function register()
    {
        $this->app['IxdVal.validator'] = $this->app->share(
            function()
            {
                return new IxudraValidator();
            }
        );
    }

    public function provides()
    {
        return array('IxdVal.IxudraValidator');
    }

}