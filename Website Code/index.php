<?php
require_once './functions.php';
require_once './user.php';
require_once './Calculations.php';
$user = new User();
Functions::createCountryData();
Functions::basketStandardDeviation(); 

//var_dump(Functions::$COUNTRYS);
$a = Calculations::comparator(Functions::$COUNTRYS[0],$user,'Food and non-alcoholic beverages') . PHP_EOL;
echo $a;
echo Calculations::comperison($BASKETSTANDARDDIVIATION['Food and non-alcoholic beverages'],$a) . PHP_EOL;

$a = Calculations::comparator(Functions::$COUNTRYS[2],$user,'Alcoholic beverages, tobacco') . PHP_EOL;
echo $a;
echo Calculations::comperison($BASKETSTANDARDDIVIATION['Alcoholic beverages, tobacco'],$a) . PHP_EOL;
