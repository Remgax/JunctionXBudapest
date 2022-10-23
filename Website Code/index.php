<?php
require_once './functions.php';
require_once './user.php';
require_once './Calculations.php';
$user = new User();
Functions::createCountryData();
Functions::basketStandardDeviation(); 

//var_dump(Functions::$COUNTRYS);
echo "Based on Basketek standard deviation" . '<br>';
$a = Calculations::comparator(Functions::$COUNTRYS[0],$user,'Food and non-alcoholic beverages') . '<br>';
echo "Comparator: ". $a ;
echo "Comperision: ".Calculations::comperison($BASKETSTANDARDDIVIATION['Food and non-alcoholic beverages'],$a) . '<br>';


echo "Coverage" . '<br>';
$b = Calculations::comparator(Functions::$COUNTRYS[2],$user,'Alcoholic beverages, tobacco') . '<br>';
echo "Comparator: ". $b;
echo "Comperision: ".Calculations::comperison($BASKETSTANDARDDIVIATION['Alcoholic beverages, tobacco'],$b) . '<br>';

echo "Savings". '<br>';
$c = Calculations::saveing(Functions::$COUNTRYS[0],Functions::$COUNTRYS[2],$user);
var_dump($c);
echo $c . '<br>';

