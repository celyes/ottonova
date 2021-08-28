## Ottonova coding challenge

This package solves the 'Ottonova PHP developers challenge'

### Installation

Run this command to install the package:
```sh
composer create-project celyes/ottonova --prefer-dist
```
While you can install this project globally, it is not recommended to do it this way because there will be issues pointing to the composer `autoload.php` file.

### Usage

The package comes with an executable file written in PHP that can be used as follows:
```sh
./vdc
```

Usage with options:
```sh
./vdc --year=2021 --input=data.json --printer=json --file=vacations
```

##### Options
```sh
--year      Specifies the year in which you calculate the vacation days. defaults to the current year if not provided. 
--input     Specifies a json file that contains the data. you can specify a path to the file . file must be JSON only 
--printer    Specifies how to output the processed data. you can choose between console or json. If needed, you can export data in other formats by writing a class (read what follows)
--file      If you specify the output as JSON, you need to specify the filename in which the data will be written to. you don't need to specify the extension
```
Note that all arguments are optional since the project already comes with a simple data set that serves as an example.

### Adding a new mechanism to export data

You can add a new printer (well, that's how I called it) to export data in the format you like (ex.: csv, xls...) by adding a new class to the `src/Printer` directory. the new printer should implement the interface `Celyes\Ottonova\Printer\PrinterInterface`

### Running tests

To run tests, run this command:
```sh
composer test
```

For more verbosity in tests:
```sh
composer test:verbose
```
