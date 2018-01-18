<?php
/**
 * @Created by PhpStorm.
 * @author: lcj
 * @date: 2017/9/27 9:07
 * @note:
 */

namespace suduntec;


class suduntec
{
    private $config = [
        'url' => 'http://118.190.144.193:7862/sms',
        'account' => '700024',
        'password' => 'rWJ7cd',
    ];

    public function sendSmg($mobile,$content) {
        $sendArr = [
            'action'   => 'send',
            'account'  => $this->config['account'],
            'password' => $this->config['password'],
            'mobile'   => $mobile,
            'content'  => $content,
            'extno'    => '',
            'rt'       => 'json',
        ];
        $res = $this->curl_httprequest($this->config['url'],1,http_build_query($sendArr));
        return $res;
    }

    public function getBalanceNum() {
        $sendArr = [
            'action'   => 'balance',
            'account'  => $this->config['account'],
            'password' => $this->config['password'],
            'rt'       => 'json',
        ];
        $res = $this->curl_httprequest($this->config['url'],1,http_build_query($sendArr));
        return $res;
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