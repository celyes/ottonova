<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Celyes\Ottonova\Calculator;
use Celyes\Ottonova\Printer\ConsolePrinter;
use ReflectionClass;

class AssertionsTraitsTest extends TestCase
{


    public function setUp(): void
    {
        $this->data = json_decode(file_get_contents('data.json'), true);   
        $this->calculator = new Calculator('2021', $this->data, new ConsolePrinter());
    }
    
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
        $hasSpecialContract = $this->invokeMethod($this->calculator, 'hasSpecialContract', [$this->data[0]]);
        $this->assertFalse($hasSpecialContract); 
          
        $hasSpecialContract = $this->invokeMethod($this->calculator, 'hasSpecialContract', [$this->data[2]]);
        $this->assertTrue($hasSpecialContract);    
    }

    /**
     * @test
     * check if `hasStartedInCourseOfTheYear` method determines 
     * if employee started in the course of the year indeed
     */

    public function testEmployeeHasStartedInCourseOfTheYear()
    {
        $hasSpecialContract = $this->invokeMethod($this->calculator, 'hasStartedInCourseOfTheYear', [$this->data[0]['start']]);
        $this->assertFalse($hasSpecialContract); 

        $hasSpecialContract = $this->invokeMethod($this->calculator, 'hasStartedInCourseOfTheYear', [$this->data[1]['start']]);
        $this->assertTrue($hasSpecialContract); 

    }

}