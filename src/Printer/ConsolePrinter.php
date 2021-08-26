<?php 

namespace Celyes\Ottonova\Printer;

use Celyes\Ottonova\Printer\PrinterInterface;

class ConsolePrinter implements PrinterInterface
{
    public function print($data)
    {
        echo "\n\e[0;32;1;4mName :\e[0m"."\e[0;33m Vacation days\e[0m";
        echo "\n---------------------\n";
        foreach($data as $employee) {
            echo "\e[0;32;1;4m". $employee['name'] .":\e[0m";
            echo "\e[0;33m ". $employee['vacation'] ." days\e[0m\n";
            echo "\n";
        }
    }
}