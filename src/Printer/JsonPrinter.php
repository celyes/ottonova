<?php 

namespace Celyes\Ottonova\Printer;

use Celyes\Ottonova\Printer\PrinterInterface;

class JsonPrinter implements PrinterInterface
{
    public function __construct(string $filename)
    {
        $this->filename = trim(preg_replace('/[0-9\@\.\;\" "]+/', '', $filename));
    }

    public function print($data)
    {
        $file = fopen($this->filename . '.json', 'w');
        fwrite($file, json_encode($data, JSON_UNESCAPED_UNICODE));
        fclose($file);
        echo "\e[1;32mVacations data written successfully! checkout the file " . $this->filename . ".json\e[0m\n";
    }
}