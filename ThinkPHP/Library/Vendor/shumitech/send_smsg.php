<?php
/**
 * Created by PhpStorm.
 * Author: lcj
 * Date: 2016/10/9 17:03
 */

class shumitech_send_info {
    private $config = array (
        'common_url'        => 'http://api.shumi365.com:8090/sms/send.do',
        'personality_url'   => 'http://api.shumi365.com:8090/sms/sendData.do',
        'check_balance_url' => 'http://api.shumi365.com:8090/sms/balance.do',
        'vocation'          => array (
            'id'  => '400264',
            'pwd' => '194397'
        ),
        'marketing'         => array (
            'id'  => '400265',
            'pwd' => '919470',
            )
    );

    /**
     * 发送行业群发短信
     * Author: lcj
     * Date:2016年10月9日18:04:09
     * @param $phone 手机号
     * @param $content 发送内容
     * @return mixed|string 返回结果
     */
    public function send_vocation_common_msg($phone,$content) {
        if (empty($this->config)) {
            return 'missing parameter';
        }

        $curr_timestamp = date('YmdHis');
        $request_array = array(
            'userid' => $this->config['vocation']['id'],
            'timespan' => $curr_timestamp,
            'pwd' => $this->get_pwd_encrypt($this->config['vocation']['pwd'],$curr_timestamp),
            'mobile' => $phone,
            'msgfmt' => 'UTF-8',
            'content' => base64_encode($content),
        );
        $url = $this->config['common_url'];
        $request_str = http_build_query($request_array);
        $request_result = $this->curl_httprequest($url,1,$request_str);
        return $request_result[0];
    }

    /**
     * 发送行业个性短信
     * Author: lcj
     * Date:2016年10月9日18:02:23
     * @param $phone
     * @param $content
     * @return mixed|string
     */
    public function send_vocation_personality_msg($phone,$content) {
        if (empty($this->config)) {
            return 'missing parameter';
        }
        $curr_timestamp = date('YmdHis');
        $request_array = array(
            'userid' => $this->config['vocation']['id'],
            'timespan' => $curr_timestamp,
            'pwd' => $this->get_pwd_encrypt($this->config['vocation']['pwd'],$curr_timestamp),
            'mobile' => $phone,
            'msgfmt' => 'UTF-8',
            'content' => base64_encode($content),
        );
        $url = $this->config['personality_url'];
        $request_str = http_build_query($request_array);
        $request_result = $this->curl_httprequest($url,1,$request_str);
        return $request_result[0];
    }

    /**
     * 发送营销群发短信：营销短信需要审核
     * Author: lcj
     * Date: 2016年10月9日18:00:05
     * @param $phone
     * @param $content
     * @return mixed|string
     */
    public function send_marketing_common_msg($phone,$content) {
        if (empty($this->config)) {
            return 'missing parameter';
        }
        $curr_timestamp = date('YmdHis');
        $request_array = array(
            'userid' => $this->config['marketing']['id'],
            'timespan' => $curr_timestamp,
            'pwd' => $this->get_pwd_encrypt($this->config['marketing']['pwd'],$curr_timestamp),
            'mobile' => $phone,
            'msgfmt' => 'UTF-8',
            'content' => base64_encode($content),
        );
        $url = $this->config['common_url'];
        $request_str = http_build_query($request_array);
        $request_result = $this->curl_httprequest($url,1,$request_str);
        return $request_result[0];
    }

    /**
     * 查询剩余金额
     * Author: lcj
     * Date:2016年10月9日17:58:19
     * @return mixed|string
     */
    public function check_balance() {
        if (empty($this->config)) {
            return 'missing parameter';
        }

        $curr_timestamp = date('YmdHis');
        $request_array = array(
            'userid' => $this->config['vocation']['id'],
            'timespan' => $curr_timestamp,
            'pwd' => $this->get_pwd_encrypt($this->config['vocation']['pwd'],$curr_timestamp),
        );
        $url = $this->config['check_balance_url'];
        $request_str = http_build_query($request_array);
        $request_result = $this->curl_httprequest($url,1,$request_str);
        return $request_result[0];
    }

    /**
     * 密码加密
     * Author: lcj
     * Date: 2016年10月9日13:20:12
     * @param $pwd
     * @param $curr_timestamp
     * @return string
     */
    private function get_pwd_encrypt($pwd,$curr_timestamp) {
        return strtoupper(md5($pwd.$curr_timestamp));
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