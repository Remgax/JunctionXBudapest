<?php
require_once './countrybuskets.php';
require_once './user.php';
require_once './functions.php';
class Calculations
{
    public static function saveing(CountryBusketes $targetCountry, CountryBusketes $sourceCountry)
    {

    }
    public static function coverage(CountryBusketes $targetCountry, CountryBusketes $sourceCountry)
    {
        $overallIncome = 0;
        foreach (Calculations::generateIncomeTransactions() as $key => $value) {
            $overallIncome += $value;
        }

        $targetCountryGNI = $targetCountry->getGNIPerCaption();
        $targetCountryGDP = $targetCountry->getGDPPerCaption();
        $sourceCountryGNI = $sourceCountry->getGNIPerCaption();

        $calc = $targetCountryGNI / $sourceCountryGNI * $overallIncome;

        if ($calc > $targetCountryGDP) {
            return 'Happy';
        }
        else if($calc > $targetCountryGNI && $calc < $targetCountryGDP){
            return 'Avarage';
        }
        else if($calc < $targetCountryGNI){
            return 'UnHappy';
        }
    }


    private static function generateIncomeTransactions()
    {
        $incomeHistory = [];
        $transactions = rand(20);
        for ($i = 0; $i < $transactions; $i++) {
            $incomeHistory[] = rand(500);
        }
        return $incomeHistory;
    }
    public static function standerd_deviation($arr)
    {
        $num_of_elements = count($arr);
        $variance = 0.0;
        // calculating mean using array_sum() method
        $average = array_sum($arr) / $num_of_elements;
        foreach ($arr as $i) {
            // sum of squares of differences between 
            // all numbers and means.
            $variance += pow(($i - $average), 2);
        }
        return (float)sqrt($variance / $num_of_elements);
    }

    public static function comparator(CountryBusketes $targetCountry, User $user, $basket)
    {
        $targetCountryBasket = $targetCountry->getBasketValue($basket);
        $userBasketExpanse = $user->getUserBasketExpanse($basket);
        //$userCountry = $user->getUserCountery();
        $userCountry = "Germany";
        $sourceCountryBasketValue = null;
        foreach (Functions::$COUNTRYS as $key => $value) {
            if ($value->countryName == $userCountry) {
                $sourceCountryBasketValue = $value->baskets[$basket];
                break;
            }
        }
        return $targetCountryBasket - ($userBasketExpanse * ($targetCountryBasket / $sourceCountryBasketValue));
    }
    public static function comperison($deviation, $deflator)
    {
        $value = $deviation - $deflator;
        if ($value < 0) {
            return 'Happy';
        } else if ($value >= 0 && ($value < $deviation)) {
            return 'Avarage';
        } else if ($value > $deviation) {
            return 'Unhappy';
        }
    }
}
