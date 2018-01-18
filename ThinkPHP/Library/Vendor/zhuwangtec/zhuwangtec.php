<?php

/**
 * @Created by PhpStorm.
 * @author: lcj
 * @date: 2017/6/2 18:02
 * @note:
 */
class zhuwangtec
{
    private $config = array (
        'verification' => array(
            'url'      => 'http://120.55.189.229',
            'id'       => '977165',
            'account'  => '977165',
            'pwd'      => 'ZTYOBEW8PX',
            'port'     => '8861',
            'access'   => '10690979165',
        ),
        'marketing' => array(
            'url'    => 'http://120.55.189.229',
            'id'       => '977166',
            'account'  => '977166',
            'pwd'      => '2TQVRFWZRA',
            'port'     => '8861',
            'access'   => '10690979166',
        ),
        'collection' => array(
            'url'   => 'http://115.231.168.138',
            'id'       => '988085',
            'account'  => '988085',
            'pwd'      => 'CVIEN2AYJE',
            'port'     => '8861',
            'access'   => '10690926405285',
        ),
    );
    
    public function send_collec_msg($phone,$msg) {
        $content = urlencode(json_encode(array(array(
            'phone' => $phone,
            'context' => $msg,
        )),JSON_UNESCAPED_UNICODE));
        $sign = md5($content.$this->config['collection']['pwd']);
        $url = $this->config['collection']['url'].':'.$this->config['collection']['port'];
        $post_arr = array(
            'uid' => $this->config['collection']['account'],
            'sign' => $sign,
            'srcphone' => $this->config['collection']['access'],
            'msg' => $content,
        );
        $post_str = $this->http_build_query($post_arr);
        $res = $this->curl_httprequest($url,1,$post_str);
        $return_arr = $this->analysis_res($res[0]);
        return $return_arr;
    }

    public function send_verification_msg($phone,$msg) {
        $content = urlencode(json_encode(array(array(
            'phone' => $phone,
            'context' => $msg,
        )),JSON_UNESCAPED_UNICODE));
        $sign = md5($content.$this->config['verification']['pwd']);
        $post_arr = array(
            'uid' => $this->config['verification']['account'],
            'sign' => $sign,
            'srcphone' => $this->config['verification']['access'],
            'msg' => $content,
        );
        $url = $this->config['verification']['url'].':'.$this->config['verification']['port'];
        $post_str = $this->http_build_query($post_arr);
        $res = $this->curl_httprequest($url,1,$post_str);
        $return_arr = $this->analysis_res($res[0]);
        return $return_arr;
    }

    public function send_marketing_msg($phone,$msg) {
        $content = urlencode(json_encode(array(array(
            'phone' => $phone,
            'context' => $msg,
        )),JSON_UNESCAPED_UNICODE));
        $sign = md5($content.$this->config['marketing']['pwd']);
        $post_arr = array(
            'uid' => $this->config['marketing']['account'],
            'sign' => $sign,
            'srcphone' => $this->config['marketing']['access'],
            'msg' => $content,
        );
        $url = $this->config['marketing']['url'].':'.$this->config['marketing']['port'];
        $post_str = $this->http_build_query($post_arr);
        $res = $this->curl_httprequest($url,1,$post_str);
        $return_arr = $this->analysis_res($res[0]);
        return $return_arr;
    }

    private function analysis_res($res) {
        if (strstr($res,'ERROR:')) {
            $error_arr = explode(':',$res);
            return array(
                'error' => false,
                'msg'   => urldecode($error_arr[1]),
            );
        } else {
            if(strstr($res,'0')) {
                $error_arr = explode(',',$res);
                return array(
                    'error' => true,
                    'code'  => 0,
                    'msg'   => $error_arr[1],
                );
            } else {
                return array(
                    'error' => true,
                    'code'  => $res,
                    'msg'   => $res,
                );
            }
        }
    }

    private function http_build_query($post_arr) {
        $return_str = '';
        foreach ($post_arr as $key => $val) {
            $return_str .= '&'.$key.'='.$val;
        }
        $return_str = substr($return_str,1);
        return $return_str;
    }

    private function curl_httprequest($url, $method = 0, $postdata = "", $cookie = "", $allowredirect = 0, $referer = "", $useragent = "", $head = "", $timeout = 30) {
        if ($url == "") return false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, $method);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $allowredirect);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 7);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        if ($postdata != "") curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        if ($cookie != "") curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        if ($referer != "") curl_setopt($ch, CURLOPT_REFERER, $referer);
        if ($useragent != "") curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        if ($head != "") curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        $ret = curl_exec($ch);
        $curl_info = curl_getinfo($ch);
        $info = $curl_info['url'] . '|' . $curl_info['http_code'] . '|' . $curl_info['total_time'];
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($ret, 0, $headerSize);
        $body = substr($ret, $headerSize);
        if (mb_detect_encoding($body, "ASCII,GB2312,GBK,UTF-8") == "EUC-CN") $body = iconv("GB2312", "UTF-8//IGNORE", $body);
        curl_close($ch);
        return array($body, $header, $info, $cookie, "body" => $body, "header" => $header, "info" => $info, "cookie" => $cookie);
    }
}