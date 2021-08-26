<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Celyes\Ottonova\Calculator;
use Celyes\Ottonova\Printer\ConsolePrinter;
use ReflectionClass;

class VacationCalculatorTest extends TestCase
{

    private $data;
    private $calculator;

    public function setUp(): void
    {
        $this->data = json_decode(file_get_contents('data.json'), true);   
        $this->calculator = new Calculator('2020', $this->data, new ConsolePrinter());
    }

    public function invokeMethod($object, $methodName, array $parameters = array())
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
    
    public function getProperty($object, $propertyName)
    {
        $class = new ReflectionClass($object);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }

    /**
     * @test 
     * check if `testHasSpecialContractWorks` method detects if an employee has a special contract 
     */
    public function testGetEmployeeAgeWorks()
    {
        $age = $this->invokeMethod($this->calculator, 'getEmployeeAge', [$this->data[0]['birthdate']]);
        $this->assertEquals($age, 70); 

        $age = $this->invokeMethod($this->calculator, 'getEmployeeAge', [$this->data[2]['birthdate']]);
        $this->assertEquals($age, 29); 
    }

    /**
     * @test
     * checks if the the output is an array and it holds correct values 
     */
    public function testOutputIsCorrect()
    {
        
        $this->calculator->calculate();

        $vacations = $this->getProperty($this->calculator, 'vacations');
        
        $this->assertEquals($vacations[0]['vacation'], 26);
        $this->assertIsArray($vacations);
    }
}