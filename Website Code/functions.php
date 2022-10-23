<?php
require_once './user.php';
require_once './countrybuskets.php';
require_once './Calculations.php';
class Functions
{
    public static $COUNTRYS = [];
    public static $BASKETSTANDARDDIVIATION = [];
    public static function createCountryData()
    {
        if (file_exists(COUNTRY_DATA_PATH)) {
            if (($open = fopen(COUNTRY_DATA_PATH, "r")) !== FALSE) {

                while (($data = fgetcsv($open, 1000, PHP_EOL)) !== FALSE) {
                    $values = explode(';', $data[0]);
                    $busket = new CountryBusketes();
                    foreach ($values as $key => $value) {
                        // TODO: its not affitiont, needs to resolve this later
                        switch ($key) {
                            case 0:
                                $busket->countryName = $value;
                                break;
                            case 1:
                                $busket->gdppercapita = intval($value);
                                break;
                            case 2:
                                $busket->gnipercapita = intval($value);
                                break;
                            case 3:
                                $busket->baskets["Food and non-alcoholic beverages"] = intval($value);
                                break;
                            case 4:
                                $busket->baskets["Alcoholic beverages, tobacco"] = intval($value);
                                break;
                            case 5:
                                $busket->baskets["Clothing and footwear"] = intval($value);
                                break;
                            case 6:
                                $busket->baskets["Housing, water, electricity, gas, fuel"] = intval($value);
                                break;
                            case 7:
                                $busket->baskets["Furnishings, household equipment, house maintenanceh"] = intval($value);
                                break;
                            case 8:
                                $busket->baskets["Health"] = intval($value);
                                break;
                            case 9:
                                $busket->baskets["Transport"] = intval($value);
                                break;
                            case 10:
                                $busket->baskets["Communication"] = intval($value);
                                break;
                            case 11:
                                $busket->baskets["Recreation and culture"] = intval($value);
                                break;
                            case 12:
                                $busket->baskets["Education"] = intval($value);
                                break;
                            case 13:
                                $busket->baskets["Restaurants and hotels"] = intval($value);
                                break;
                            case 14:
                                $busket->baskets["Miscellaneous goods and services"] = intval($value);
                                break;
                        }
                    }
                    Functions::$COUNTRYS[] = $busket;
                }
                fclose($open);
            }
        }
    }

    public static function basketStandardDeviation()
    {
        $countrybaskets = new CountryBusketes();
        $temp = [];
        foreach ($countrybaskets->getBaskets() as $basket) {
            foreach (Functions::$COUNTRYS as $key => $value) {
                $v = $value->getBasketValue($basket);
                $temp[$basket][] = $v;
            }
        }
        foreach ($temp as $key => $value) {
            Functions::$BASKETSTANDARDDIVIATION[$key] = Calculations::standerd_deviation($value);
        }
        return Functions::$BASKETSTANDARDDIVIATION;
    }
}
