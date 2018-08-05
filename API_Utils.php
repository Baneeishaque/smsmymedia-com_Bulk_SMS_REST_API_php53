<?php
/**
 * Created by PhpStorm.
 * User: Srf
 * Date: 05-08-2018
 * Time: 23:25
 */

namespace Ndk_common;

use Guzzle\Http\Client;

class API_Utils
{

    public $base_URL;

    /**
     * API_Utils constructor.
     * @param $base_URL
     */
    public function __construct($base_URL)
    {
        $this->base_URL = $base_URL;
    }


    public function perform_get_request($method_name, $parameters)
    {
        $client = new Client($this->base_URL);
        $request = $client->get($this->get_method_URL_with_parameters($method_name, $parameters));
        $api_response = $request->send();
        dump($api_response);
        return $api_response->getBody();
    }

    function get_method_URL_with_parameters($method_name, $parameters)
    {
        $i = 0;

        foreach ($parameters as $parameter_key => $parameter_value) {

            if ($i == 0) {
                $method_name = $method_name . '?';
            } else {
                $method_name = $method_name . '&';
            }
            $method_name = $method_name . $parameter_key . '=' . $parameter_value;

            $i++;
        }

        return $method_name;
    }
}