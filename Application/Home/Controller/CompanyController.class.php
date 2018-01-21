<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 10:42
 */

namespace Home\Controller;


use Think\Controller;

class CompanyController extends  Controller
{

    public function about(){

        $this->display();
    }

    public function test(){

        $payload = [
            'apikey' => 'ZltcUKL-efitFwcNaukqtWgBhYq*****',
            'nonce' => time(),
        ];

// Generation of apiseal
        $apiseal = hash_hmac('sha256', http_build_query($payload), 'HeKi5_wYlVA14KvomUPIHC-9Bn******
');

// Append the generated apiseal to payload
        $payload['apiseal'] = $apiseal;

// Set request URL (in this case we check your balance)
        $ch = curl_init('https://paxful.com/api/wallet/balance');

// NOTICE that we send the payload as a string instead of POST parameters
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json; version=1',
            'Content-Type: text/plain',
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
// fetch response
        $response = curl_exec($ch);
        var_dump($response);

// convert json response into array
        $data = json_decode($response);

//        var_dump($data);

        curl_close($ch);

    }


}