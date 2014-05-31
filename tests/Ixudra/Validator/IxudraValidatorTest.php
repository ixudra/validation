<?php namespace Ixudra\Validation;


class IxudraValidatorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var IxudraValidator
     */
    protected static $validator;

    const USER_ID_1 = 1;

    const USER_EMAIL_1 = 'john.doe@dansgroepdiest.be';

    const USER_ID_2 = 2;

    const USER_EMAIL_2 = 'jane.doe@dansgroepdiest.be';


    public static function setUpBeforeClass()
    {
        self::$validator = null;
    }

    public static function tearDownAfterClass()
    {
        self::$validator = null;
    }

    public function tearDown()
    {
        \Mockery::close();
    }


    // ============================================================================================================
    //      Truthy
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateTruthy()
     */
    public function testValidateTruthy_returnsTrueIfValueIsTrue()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTruthy(null, true, null) );
    }

    /**
     * @covers IxudraValidator::validateTruthy()
     */
    public function testValidateTruthy_returnsTrueIfValueIsFalse()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTruthy(null, false, null) );
    }

    /**
     * @covers IxudraValidator::validateTruthy()
     */
    public function testValidateTruthy_returnsFalseIfValueIsText()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTruthy(null, 'foo', null) );
    }

    /**
     * @covers IxudraValidator::validateTruthy()
     */
    public function testValidateTruthy_returnsFalseIfValueIsNumeric()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTruthy(null, 1, null) );
    }

    /**
     * @covers IxudraValidator::validateTrue()
     */
    public function testValidateTrue()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTrue(null, true, null) );
    }

    /**
     * @covers IxudraValidator::validateTrue()
     */
    public function testValidateTrue_returnsFalseIfValueIsFalse()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTrue(null, false, null) );
    }

    /**
     * @covers IxudraValidator::validateTrue()
     */
    public function testValidateTrue_returnsFalseIfValueIsString()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTrue(null, 'foo', null) );
    }

    /**
     * @covers IxudraValidator::validateTrue()
     */
    public function testValidateTrue_returnsFalseIfValueIsInteger()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTrue(null, 125, null) );
    }


    // ============================================================================================================
    //      Date
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validatePast()
     */
    public function testValidatePast()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validatePast(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers IxudraValidator::validatePast()
     */
    public function testValidatePast_returnsFalseIfValueIsInTheFuture()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validatePast(null, date('Y-m-d', strtotime('+1 year')), null) );
    }

    /**
     * @covers IxudraValidator::validatePast()
     */
    public function testValidatePast_returnsFalseIfValueIsText()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validatePast(null, 'foo', null) );
    }

    /**
     * @covers IxudraValidator::validatePast()
     */
    public function testValidatePast_returnsFalseIfValueIsInteger()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validatePast(null, 1, null) );
    }

    /**
     * @covers IxudraValidator::validateFuture()
     */
    public function testValidateFuture()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateFuture(null, date('Y-m-d', strtotime('+1 year')), null) );
    }

    /**
     * @covers IxudraValidator::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsInThePast()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateFuture(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers IxudraValidator::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsText()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateFuture(null, 'foo', null) );
    }

    /**
     * @covers IxudraValidator::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsInteger()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateFuture(null, 1, null) );
    }

    /**
     * @covers IxudraValidator::validateFuture()
     */
    public function testValidateFuture_returnsFalseIfValueIsNumeric()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateFuture(null, 1, null) );
    }

    /**
     * @covers IxudraValidator::validateLessThanThreeDaysOld()
     */
    public function testValidateLessThanThreeDaysOld()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateLessThanThreeDaysOld(null, date('Y-m-d', strtotime('-1 day')), null) );
    }

    /**
     * @covers IxudraValidator::validateLessThanThreeDaysOld()
     */
    public function testValidateLessThanThreeDaysOld_returnsFalseIfDateIsMoreThanThreeDaysOld()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateLessThanThreeDaysOld(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers IxudraValidator::validateTodayOrLater()
     */
    public function testValidateTodayOrLater()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTodayOrLater(null, date('Y-m-d', strtotime('+1 year')), null) );
    }

    /**
     * @covers IxudraValidator::validateTodayOrLater()
     */
    public function testValidateTodayOrLater_returnsFalseIfValueIsInThePast()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTodayOrLater(null, date('Y-m-d', strtotime('-1 year')), null) );
    }

    /**
     * @covers IxudraValidator::validateTodayOrLater()
     */
    public function testValidateTodayOrLater_returnsTrueIfDateIsToday()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTodayOrLater(null, date('Y-m-d'), null) );
    }

    /**
     * @covers IxudraValidator::validateTodayOrLater()
     */
    public function testValidateTodayOrLater_returnsTrueIfDateIsTodayWithLargeFormat()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTodayOrLater(null, date('Y-m-d H:i:s'), null) );
    }


    // ============================================================================================================
    //      Time
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateTime()
     */
    public function testValidateTime()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTime(null, '19:00:00', null) );
    }

    /**
     * @covers IxudraValidator::validateTime()
     */
    public function testValidateTime_returnsTrueForShortNotation()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTime(null, '19:00', null) );
    }

    /**
     * @covers IxudraValidator::validateTime()
     */
    public function testValidateTime_returnsFalseIfValueIsString()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTime(null, 'foo', null) );
    }

    /**
     * @covers IxudraValidator::validateTime()
     */
    public function testValidateTime_returnsFalseIfValueIsInteger()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTime(null, '10055223366', null) );
    }


    // ============================================================================================================
    //      String
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateEmpty()
     */
    public function testValidateEmpty()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateEmpty(null, '', null) );
    }

    /**
     * @covers IxudraValidator::validateEmpty()
     */
    public function testValidateEmpty_returnsFalseIfValueIsNotEmpty()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateEmpty(null, 'foo', null) );
    }


    // ============================================================================================================
    //      Array
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateArraySize()
     */
    public function testValidateArraySize()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateArraySize(null, array('one', 'two', 'three', 'four', 'five'), array(5)) );
    }

    /**
     * @covers IxudraValidator::validateArraySize()
     */
    public function testValidateArraySize_returnsFalseIfValueIsNotArray()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateArraySize(null, 'Foo', array(5)) );
    }

    /**
     * @covers IxudraValidator::validateArraySize()
     */
    public function testValidateArraySize_returnsFalseIfArrayContainsLessThanRequestedNumber()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateArraySize(null, array('one', 'two', 'three', 'four', 'five'), array(10)) );
    }

    /**
     * @covers IxudraValidator::validateArraySize()
     */
    public function testValidateArraySize_returnsFalseIfArrayContainsMoreThanRequestedNumber()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateArraySize(null, array('one', 'two', 'three', 'four', 'five'), array(2)) );
    }

    /**
     * @covers IxudraValidator::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateOneOrMoreSelected(null, array(1 => true, 4 => false), null) );
    }

    /**
     * @covers IxudraValidator::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected_returnsFalseIfZeroSelected()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateOneOrMoreSelected(null, array(1 => false, 4 => false), null) );
    }

    /**
     * @covers IxudraValidator::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected_returnsFalseIfValueIsNotArray()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateOneOrMoreSelected(null, 'Foo', null) );
    }

    /**
     * @covers IxudraValidator::validateOneOrMoreSelected()
     */
    public function testValidateOneOrMoreSelected_returnsFalseIfArrayIsEmpty()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateOneOrMoreSelected(null, array(), null) );
    }


    // ============================================================================================================
    //      JSON
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateJson()
     */
    public function testValidateJson_returnsTrueIfJsonIsValid()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateJson(null, '{"menu": {"id": "file","value": "File","popup": {"menuitem": [{"value": "New", "onclick": "CreateNewDoc()"},{"value": "Open", "onclick": "OpenDoc()"},{"value": "Close", "onclick": "CloseDoc()"}]}}}', null) );
    }

    /**
     * @covers IxudraValidator::validateJson()
     */
    public function testValidateJson_returnsFalseIfJsonIsNotValid()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateJson(null, '{"menu": {"id": "file","value": "File","popup": {"menuitem": {"value": "New", "onclick": "CreateNewDoc()"},{"value": "Open", "onclick": "OpenDoc()"},{"value": "Close", "onclick": "CloseDoc()"}]}}}', null) );
    }

    /**
     * @covers IxudraValidator::validateJson()
     */
    public function testValidateJson_returnsFalseIfValueIsInteger()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateJson(null, 15, null) );
    }

    /**
     * @covers IxudraValidator::validateJson()
     */
    public function testValidateJson_returnsFalseIfValueIsString()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateJson(null, 'Foo', null) );
    }

    /**
     * @covers IxudraValidator::validateJson()
     */
    public function testValidateJson_returnsFalseIfValueIsTruthy()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateJson(null, true, null) );
    }


    // ============================================================================================================
    //      Telephone
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsTrueIfInputContainsValidTelephoneNumber()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTelephoneNumber(null, '011/44.55.66', null) );
    }

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfTelephoneNumberIsNotCorrect()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTelephoneNumber(null, '411/44.55.66', null) );
    }

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfTelephoneNumberFormattingIsNotCorrect_incorrectSpacers()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTelephoneNumber(null, '011/44/55/66', null) );
    }

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfTelephoneNumberFormattingIsNotCorrect_noSpacers()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTelephoneNumber(null, '011445566', null) );
    }

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsTrueIfInputContainsValidCellphoneNumber()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateTelephoneNumber(null, '0496/44.55.66', null) );
    }

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfCellphoneNumberIsNotCorrect()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTelephoneNumber(null, '0596/44.55.66', null) );
    }

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfCellphoneNumberFormattingIsNotCorrect_incorrectSpacers()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTelephoneNumber(null, '0496/44/55/66', null) );
    }

    /**
     * @covers IxudraValidator::validateTelephoneNumber()
     */
    public function testValidateTelephoneNumber_returnsFalseIfCellphoneNumberFormattingIsNotCorrect_noSpacers()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateTelephoneNumber(null, '0496445566', null) );
    }


    // ============================================================================================================
    //      Coordinates
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateWorldCoordinate()
     */
    public function testValidateWorldCoordinate()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateWorldCoordinate(null, '50.135209', null) );
    }

    /**
     * @covers IxudraValidator::validateWorldCoordinate()
     */
    public function testValidateWorldCoordinate_returnsFalseIfCoordinateIsTooPrecise()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateWorldCoordinate(null, '50.1352393', null) );
    }

    /**
     * @covers IxudraValidator::validateWorldCoordinate()
     */
    public function testValidateWorldCoordinate_returnsFalseIfCoordinateIsNotPreciseEnough()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateWorldCoordinate(null, '50.1', null) );
    }


    // ============================================================================================================
    //      Password
    // ============================================================================================================

    /**
     * @covers IxudraValidator::validateValidPassword()
     */
    public function testValidatePassword()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertTrue( self::$validator->validateValidPassword(null, 'Abc@123', null) );
    }

    /**
     * @covers IxudraValidator::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordIsLessThanSixCharactersLong()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateValidPassword(null, 'foo', null) );
    }

    /**
     * @covers IxudraValidator::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordDoesNotContainCapitalLetter()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateValidPassword(null, 'abc@123', null) );
    }

    /**
     * @covers IxudraValidator::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordDoesNotContainSpecialCharacter()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateValidPassword(null, 'abcd123', null) );
    }

    /**
     * @covers IxudraValidator::validateValidPassword()
     */
    public function testValidatePassword_returnsFalseIfPasswordDoesNotContainNumber()
    {
        $this->makeValidator( array(), array(), array() );

        $this->assertFalse( self::$validator->validateValidPassword(null, 'abc@xyz', null) );
    }


    protected function makeValidator( $attributes, $rules, $messages )
    {
        if( !ini_get('date.timezone') ) {
            date_default_timezone_set('Europe/Brussels');
        }

        $lang = \Mockery::mock('Illuminate\Translation\Translator');

        self::$validator = new IxudraValidator( $lang, $attributes, $rules, $messages );
    }

}
