<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Celyes\Ottonova\Calculator;
use Celyes\Ottonova\Printer\ConsolePrinter;
use ReflectionClass;

class AssertionsTraitsTest extends TestCase
{

    public function invokeMethod($object, $methodName, array $parameters = array())
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
    
    /**
     * @test 
     * check if `testHasSpecialContractWorks` method detects if an employee has a special contract 
     */
    public function testHasSpecialContractWorks()
    {
        $data = json_decode(file_get_contents('data.json'), true);
        
        $calculator = new Calculator('2021', $data, new ConsolePrinter());
        
        $hasSpecialContract = $this->invokeMethod($calculator, 'hasSpecialContract', [$data[0]]);
        $this->assertFalse($hasSpecialContract); 
          
        $hasSpecialContract = $this->invokeMethod($calculator, 'hasSpecialContract', [$data[2]]);
        $this->assertTrue($hasSpecialContract);    
    }

    /**
     * @test
     * check if `hasStartedInCourseOfTheYear` method determines 
     * if employee started in the course of the year indeed
     */

    public function testEmployeeHasStartedInCourseOfTheYear()
    {
        $data = json_decode(file_get_contents('data.json'), true);
        
        $calculator = new Calculator('2021', $data, new ConsolePrinter());
        
        $hasSpecialContract = $this->invokeMethod($calculator, 'hasStartedInCourseOfTheYear', [$data[0]['start']]);
        $this->assertFalse($hasSpecialContract); 

        $hasSpecialContract = $this->invokeMethod($calculator, 'hasStartedInCourseOfTheYear', [$data[1]['start']]);
        $this->assertTrue($hasSpecialContract); 

    }

}