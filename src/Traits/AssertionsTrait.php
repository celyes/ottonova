<?php

namespace Celyes\Ottonova\Traits;

trait AssertionsTrait
{
    /**
     * determines whether the user has signed a special contract 
     * 
     * @param object $employee
     * @return bool 
     */
    protected function hasSpecialContract($employee)
    {
        return isset($employee['specialContract']);
    }

    /**
     * determines whether the user has started in the course of the year (not in the beginning of it)
     * 
     * @param string $start
     * @return bool 
     */
    protected function hasStartedInCourseOfTheYear($start)
    {
        return !preg_match("/(01).(01).(\d{4})/", $start);
    }

}