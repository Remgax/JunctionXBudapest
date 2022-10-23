<?php
require_once './settings.php';
class API
{
    static function callAPI($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . API_KEY,
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    static function getUser()
    {
        $url = API_HOST . "/v1/me";
        $get_data = API::callAPI('GET', $url, false);
        $response = json_decode($get_data, true);
        return $response;  
    }
    static function getUserProfileID()
    {
        $url = API_HOST . "/v1/profiles";
        $get_data = API::callAPI('GET', $url, false);
        $response = json_decode($get_data, true);
        $errors = $response['response']['errors'];
        $data = $response['response']['data'][0];
        if (is_array($response) && count($response) > 0) {
            return $response[0]['id'];
        }
    }

    public static function getBalanceAccounts(User $user)
    {
        $url = API_HOST . '/v4/profiles/' . $user->getUserProfileID() . '/balances?types=STANDARD';
        $get_data = API::callAPI('GET', $url, false);
        $response = json_decode($get_data, true);
        $errors = $response['errors'];
        $data = $response['response']['data'][0];
        return $response;
    }

}