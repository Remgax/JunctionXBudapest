<?php

class CountryBusketes
{
    public $countryName = null;
    public $gdppercapita = 0;
    public $gnipercapita = 0;
    public $baskets = [
        "Food and non-alcoholic beverages" => 0,
        "Alcoholic beverages, tobacco" => 0,
        "Clothing and footwear" => 0,
        "Housing, water, electricity, gas, fuel" => 0,
        "Furnishings, household equipment, house maintenance" => 0,
        "Health" => 0,
        "Transport"    => 0,
        "Communication"    => 0,
        "Recreation and culture" => 0,
        "Education" => 0,
        "Restaurants and hotels" => 0,
        "Miscellaneous goods and services" => 0
    ];
    public function getGDPPerCaption()
    {
        return $this->gdppercapita;
    }

    public function getGNIPerCaption()
    {
        return $this->gnipercapita;
    }
     
    public function getBasketValue($key)
    {
        if(key_exists($key,$this->baskets))
        {
            return $this->baskets[$key];
        }

    }
    public function getBasketValueByCounter($country,$basket){
        if($country == $this->countryName){
            return $this->baskets[$basket];
        }

    }
    public function getBaskets(){
        return array_keys($this->baskets);
    }
}



