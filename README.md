# sortingservice
Just a Simple Sorting Service

## How it works
The 

## Installation
### By downloading
1. Clone/download this repository
2. Copy `lib/SortingService.php` to your project's desired folder.
### Requires
* php 5.3+

### 3rd party packages installation and/or configurations
none

## Usage
You can see a working example of use in `/example/index.php`
```php
	//data: I used a json file, but you can use an array or adapt to read a .csv or any data format.
	$data = file_get_contents("test.json");
	$ss = new SortingService($data);
	//you can specify the column and order where Column=[0,1,n] and order=[asc,desc]
	$ss->sort(array(1=>'asc',2=>'desc'));
	$result = $ss->getData();
```

## Tests
You can find the test file `/tests/UnitTest.php`
(https://phpunit.de)
```
$ phpunit UnitTest.php
```
The file does the following tests:
- Sort by Title Ascending
- Sort by Author Asc and Title Desc
- Sort by Edition Desc, Author Desc  and Title Asc
- Sort by Null Param (exception)
- Sort by empty param

## License
This plugin is available under the [MIT license](http://mths.be/mit).

## Authors
[Adonai Cruz](https://github.com/adonaicruz)