<?php
require_once './API.php';
class User
{
    private  $userId = 0;
    private  $name = "";
    private  $email = "";
    private  $active = false;
    private $userProfileId = 0;
    private $balanceAccounts = [];
    private  $details = [
        "firstName" => "Example",
        "lastName" => "Person",
        "phoneNumber" => "+37111111111",
        "occupation" => "",
        "address" => [
            "city" => "Tallinn",
            "countryCode" => "EE",
            "postCode" => "11111",
            "state" => "",
            "firstLine" => "Road 123"
        ],
        "dateOfBirth" => "1977-01-01",
        "avatar" => "https://lh6.googleusercontent.com/photo.jpg",
        "primaryAddress" => 111
    ];
    private $basket =
    [
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
    public function __construct()
    {
        $this->setUserData();
    }
    public function getUserBasketExpanse($key){
        return $this->basket[$key];
    }
    public function getUser()
    {
        return $this;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getUserProfileId()
    {
        return $this->userProfileId;
    }
    public function getUserCountery(){
        return $this->details['address']['countryCode'];
    }
    private function setUserData()
    {
        $user_data = API::getUser();
        $this->userId = $user_data['id'];
        $this->userProfileId = API::getUserProfileID();
        $this->name = $user_data['name'];
        $this->email = $user_data['email'];
        $this->active = $user_data['active'];
        foreach ($user_data['details'] as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subkey => $subvalue) {
                    $this->details[$key][$subkey] = $subvalue;
                }
            } else {
                $this->details[$key] = $value;
            }
        }
        foreach ($this->basket as $key => $value) {
            $this->basket[$key] = rand(0, 3000);
        }
        $this->balanceAccounts = API::getBalanceAccounts($this);
    }
    public function getUserBaskets()
    {
        return $this->basket;
    }
}
