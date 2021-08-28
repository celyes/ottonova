<?php 

namespace Celyes\Ottonova;

use Celyes\Ottonova\Printer\PrinterInterface;
use Celyes\Ottonova\Traits\AssertionsTrait; 
use Celyes\Ottonova\Traits\ActionsTrait;

class Calculator
{

    use AssertionsTrait, ActionsTrait;

    /**
     * the year for which the vacations will be calculated
     * 
     * @property string $year 
     */
    protected $year;

    /**
     * the list of employees as an array
     * 
     * @property array $employees
     */
    protected $employees;

    /**
     * the final output to the terminal
     * 
     * @property array $vacations
     */
    protected $vacations;

    /**
     * a place to hold the days of vacation for each employee
     * 
     * @property int $vacationDays
     */
    protected $vacationDays;

    /**
     * an array that contains the current employee being iterated on
     * 
     * @property array $cursor  
     */
    protected $cursor;

    public function __construct(string $year, array $employees, PrinterInterface $printer)
    {
        $this->year = $year;
        $this->employees = $employees;
        $this->vacationDays = 26;
        $this->printer = $printer;
    }


    /**
     * gets the employee's age
     * 
     * @param string $birthdate
     * @return bool 
     */
    protected function getEmployeeAge(string $birthdate): bool
    {
        return $this->year - explode('.', $birthdate)[2];
    }

    /**
     * calculates the vacation days for each of the employees
     * 
     * @return self
     */
    public function calculate(): self
    {

        foreach($this->employees as $key => $employee) {

            $this->cursor = $employee;
            
            // set employee name 
            $this->vacations[$key]['name'] = $this->cursor['name'];

            $this->setVacationBasedOnKindOfContract()
                ->setVacationAccordingToAge()
                ->setVacationBasedOnStartingDate();

            // assign vacation days
            $this->vacations[$key]['vacation'] = $this->vacationDays;
            
            // reset the vacation days to the default value (26 days)
            $this->vacationDays = 26;
        }

        return $this;
    }

    /**
     * prints the output
     * 
     * @return void
     */
    public function output(): void
    {
        $this->printer->print($this->vacations);
    }
}