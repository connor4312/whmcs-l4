<?php namespace Connor4312\WhmcsL4\API;

use \Config;

/**
 * This class is is based on the API package queiroz/whmcs, which can be found
 * here: https://github.com/queiroz/whmcs-api.
 */
class API 
{

    /**
     * Calls the WHMCS "action" with the given parameters.
     * @param string $action 
     * @param array $actionParams 
     * @return stdclass
     */
    public function call($action, $actionParams)
    {
        return $this->curl(
            Config::get('whmcs-l4::api.url'),
            array(
                'username' => Config::get('whmcs-l4::api.username'),
                'password' => Config::get('whmcs-l4::api.password'),
                'action' => $action
            ) + $actionParams
        );

    }

    /**
     * Runs the curl request and returns an object, from apropriate xml or json
     * @param string $url 
     * @param array $params 
     * @return stdclass
     */
    protected function curl($url, $params)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $data = curl_exec($ch);

        if (curl_error($ch)) {
            throw new APIException("Connection Error: " . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);

        if ($output = simplexml_load_string($data)) {
            return $output;
        } elseif ($output = json_decode($data)) {
            return $output;
        } else {
            return false;
        }
    }
}