<?php

/**
 * @Created by PhpStorm.
 * @author: lcj
 * @date: 2017/7/10 15:41
 * @note:
 */
class smsAliDaYu
{
    private $obj;

    function __construct()
    {
        require_once (__DIR__.'/../alidayu/TopSdk.php');
        $msgconfig = require(__DIR__.'/../../Webconfig/msgconfig.php');
        $uid=$msgconfig['sms']['user4']; //分配给你的账号
        $pwd=$msgconfig['sms']['pass4']; //密码

        $this->obj = new TopClient;
        $this->obj->appkey =$uid ;
        $this->obj->secretKey =$pwd;
        $this->obj->format = 'json';
    }

    public function sendVerifyCode($mob,$content) {
        preg_match('/\d+/',$content,$a);
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsType('normal');
        $req->setSmsFreeSignName('小葱钱包');
        $smsParams = [
            'code'    => $a[0],
            'product' => '小葱钱包'
        ];
        $req->setSmsParam(json_encode($smsParams));
        $req->setRecNum("$mob");
        $req->setSmsTemplateCode("SMS_5071776");
        $resp = $this->obj->execute($req);
        if(isset($resp->code)){
            return $resp->code;
        } else{
            return $resp->result->model;
        }
    }

    public function sendNoticesms($uid,$phone,$name) {
        $ali_req = new AlibabaAliqinFcSmsNumSendRequest;
        $ali_req->setSmsType('normal');
        $ali_req->setSmsFreeSignName('小葱钱包');
        $ali_req->setSmsTemplateCode('SMS_61805162');

        $ali_req->setExtend($uid);
        $ali_req->setSmsParam(json_encode(['name'=>$name]));
        $ali_req->setRecNum($phone);
        $resp = $this->obj->execute($ali_req);

        return $resp;
    }

    public function sendDataOverdue($mob,$content) {
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsType('normal');
        $req->setSmsFreeSignName('小葱钱包');
        $req->setRecNum($mob);
        $req->setSmsTemplateCode("SMS_79075093");
        $resp = $this->obj->execute($req);
        return $resp;
    }

    public function sendCurrentNotice($mob,$content) {
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsType('normal');
        $req->setSmsFreeSignName('小葱钱包');
        $smsParams = [
            'name'    => $content,
        ];
        $req->setSmsParam(json_encode($smsParams));
        $req->setRecNum($mob);
        $req->setSmsTemplateCode('SMS_61770185');
        $resp = $this->obj->execute($req);
        return $resp;
    }
}