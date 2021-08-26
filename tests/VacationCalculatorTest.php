<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Celyes\Ottonova\Calculator;
use Celyes\Ottonova\Printer\ConsolePrinter;
use ReflectionClass;

class VacationCalculatorTest extends TestCase
{

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
        $data = json_decode(file_get_contents('data.json'), true);
        
        $calculator = new Calculator('2020', $data, new ConsolePrinter());
        
        $age = $this->invokeMethod($calculator, 'getEmployeeAge', [$data[0]['birthdate']]);
        $this->assertEquals($age, 70); 

        $age = $this->invokeMethod($calculator, 'getEmployeeAge', [$data[2]['birthdate']]);
        $this->assertEquals($age, 29); 
    }

    public function testOutputIsString()
    {
        $data = json_decode(file_get_contents('data.json'), true);
        
        $calculator = new Calculator('2020', $data, new ConsolePrinter());
        
        $calculator->calculate();

        $vacations = $this->getProperty($calculator, 'vacations');
        
        $this->assertIsArray($vacations);
    }


}