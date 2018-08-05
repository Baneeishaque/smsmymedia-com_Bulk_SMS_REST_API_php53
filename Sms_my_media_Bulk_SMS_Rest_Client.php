<?php
/**
 * Created by PhpStorm.
 * User: Srf
 * Date: 05-08-2018
 * Time: 23:09
 */

namespace Ndk_common;

use Nette\Utils\Json;

require_once 'API_Utils.php';

class Sms_my_media_Bulk_SMS_Rest_Client
{
    public $AUTH_KEY, $senderId, $routeId, $smsContentType;

    /**
     * Sms_my_media_Bulk_SMS_Rest_Client constructor.
     * @param $AUTH_KEY
     * @param $senderId
     * @param $routeId
     * @param $smsContentType
     */
    public function __construct($AUTH_KEY, $senderId, $routeId = 1, $smsContentType = 'english')
    {
        $this->AUTH_KEY = $AUTH_KEY;
        $this->senderId = $senderId;
        $this->routeId = $routeId;
        $this->smsContentType = $smsContentType;
    }


    public function send_sms($message, $mobileNos)
    {
//        $client = new Client('http://smsmymedia.com/rest/services/sendSMS');
//        $request = $client->get('sendGroupSms?AUTH_KEY=' . $this->AUTH_KEY . '&message=' . $message . '&senderId=' . $this->senderId . '&routeId=' . $this->routeId . '&mobileNos=' . $mobileNos . '&smsContentType=' . $this->smsContentType);
////        Send the request and get the response
//        $api_response = $request->send();
//        dump($api_response);

        $api_utils = new API_Utils('http://smsmymedia.com/rest/services/sendSMS');

//        try {
//            $api_response_array = Json::decode($api_utils->perform_get_request('sendGroupSms', array('AUTH_KEY' => $this->AUTH_KEY, 'message' => $message, 'senderId' => $this->senderId, 'routeId' => $this->routeId, 'mobileNos' => $mobileNos, 'smsContentType' => $this->smsContentType)), Json::FORCE_ARRAY);
//            dump($api_response_array);
//            if ($api_response_array['responseCode'] == '3001') {
//                echo 'SMS Send Successfully.';
//                return true;
//            } else {
//                echo 'SMS Send Failure, Response : ' . $api_response_array['response'];
//            }
//        } catch (\Nette\Utils\JsonException $e) {
//            echo 'Exception : ' . $e;
//        }
//        return false;

        return $this->check_response($api_utils->perform_get_request('sendGroupSms', array('AUTH_KEY' => $this->AUTH_KEY, 'message' => $message, 'senderId' => $this->senderId, 'routeId' => $this->routeId, 'mobileNos' => $mobileNos, 'smsContentType' => $this->smsContentType)));
    }

    function check_response($api_response)
    {
        try {
            $api_response_array = Json::decode($api_response, Json::FORCE_ARRAY);
            dump($api_response_array);
            if ($api_response_array['responseCode'] == '3001') {
                echo 'SMS Send Successfully.';
                return true;
            } else {
                echo 'SMS Send Failure, Response : ' . $api_response_array['response'];
            }
        } catch (\Nette\Utils\JsonException $e) {
            echo 'Exception : ' . $e;
        }
        return false;
    }
}