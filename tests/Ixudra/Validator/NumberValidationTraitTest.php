<?php namespace Ixudra\Validation;


class NumberValidationTraitTest extends \PHPUnit_Framework_TestCase {

    protected $validator;


    public function setUp()
    {
        $this->validator = $this->getObjectForTrait('\Ixudra\Validation\NUmberValidationTrait');
    }


    /**
     * @covers NumberValidationTrait::validatePositive()
     */
    public function testValidatePositive()
    {
        $this->assertTrue( $this->validator->validatePositive(null, 5, null) );
    }

    /**
     * @covers NumberValidationTrait::validatePositive()
     */
    public function testValidatePositive_ReturnsFalseIfValueIsZero()
    {
        $this->assertFalse( $this->validator->validatePositive(null, 0, null) );
    }

    /**
     * @covers NumberValidationTrait::validatePositive()
     */
    public function testValidatePositive_returnsFalseIfValueIsNegative()
    {
        $this->assertFalse( $this->validator->validatePositive(null, -5, null) );
    }

    /**
     * @covers NumberValidationTrait::validateNegative()
     */
    public function testValidateNegative()
    {
        $this->assertTrue( $this->validator->validateNegative(null, -5, null) );
    }

    /**
     * @covers NumberValidationTrait::validateNegative()
     */
    public function testValidateNegative_ReturnsFalseIfValueIsZero()
    {
        $this->assertFalse( $this->validator->validateNegative(null, 0, null) );
    }

    /**
     * @covers NumberValidationTrait::validateNegative()
     */
    public function testValidateNegative_returnsFalseIfValueIsNegative()
    {
        $this->assertFalse( $this->validator->validateNegative(null, 5, null) );
    }

}
