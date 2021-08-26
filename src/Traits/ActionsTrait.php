<?php

namespace Celyes\Ottonova\Traits;

trait ActionsTrait
{
    /**
     * set the vacation days based on the kind of the contract (special / regular)
     * 
     * @return self 
     */
    protected function setVacationBasedOnKindOfContract()
    {
        if($this->hasSpecialContract($this->cursor)) {
            $this->vacationDays = $this->cursor['specialContract'];
        }
        return $this;
    }

    /**
     * set the vacation days according to the employee's age (>= 30)
     * 
     * @return self 
     */
    protected function setVacationAccordingToAge()
    {
        if($this->getEmployeeAge($this->cursor['birthdate']) >= 30) {
            if(($this->year - explode('.', $this->cursor['start'])[2]) % 5 === 0)
            {
                $this->vacationDays++;
            }
        }
        return $this;
    }


    /**
     * set the vacation days based on the date that the employee started working on
     * 
     * @return self 
     */
    protected function setVacationBasedOnStartingDate()
    {
        if($this->hasStartedInCourseOfTheYear($this->cursor['start'])) {
            $this->vacationDays *= 2;
        }
        return $this;
    }
}