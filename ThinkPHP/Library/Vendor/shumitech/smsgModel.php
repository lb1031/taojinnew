<?php
/**
 * @Created by PhpStorm.
 * @author: lcj
 * @date: 2017/7/10 14:48
 * @note:
 */
class smsgModel
{
    private $obj = null;
    private $method = null;
    private $id = null;
    function __construct($id=2)
    {
        if (empty($id)) {
            $id=2;
        }
        $this->id = $id;
        $this->getChannel();
    }

    public function sendMsg($params,$isRecord = true){
        if (empty($this->obj)) {
            return false;
        }
//        if (empty($params['uid'])) {
//            return false;
//        }
        $method = $this->method;
        if (5 == $this->id) {
            $ret = $this->obj->$method($params['uid'],$params['phone'],$params['name']);
        } else {
            if (9 == $this->id) {
                $params['content'] = preg_replace('/【.+】/','',$params['content']);
            }
            $ret = $this->obj->$method($params['phone'],$params['content']);
        }


        return $ret;
    }

    private function getChannel() {
        if (empty($this->id)) {
            return false;
        }
        switch ($this->id) {
            case 1:
                require_once(__DIR__ . '/send_smsg.php');
                $this->obj = new shumitech_send_info();
                $this->method = 'send_vocation_common_msg';
                break;
            case 2:
                require_once (__DIR__ . '/../zhuwangtec/zhuwangtec.php');
                $this->obj = new zhuwangtec();
                $this->method = 'send_marketing_msg';
                break;
            case 3:
                require_once (__DIR__ . '/../zhuwangtec/zhuwangtec.php');
                $this->obj = new zhuwangtec();
                $this->method = 'send_verification_msg';
                break;
            case 4:
                require_once(__DIR__ . '/smsAliDaYu.php');
                $this->obj = new smsAliDaYu();
                $this->method = 'sendVerifyCode';
                break;
            case 5:
                require_once(__DIR__ . '/smsAliDaYu.php');
                $this->obj = new smsAliDaYu();
                $this->method = 'sendNoticesms';
                break;
            case 6:
                require_once(__DIR__ . '/send_smsg.php');
                $this->obj = new shumitech_send_info();
                $this->method = 'send_marketing_common_msg';
                break;
            case 7:
                require_once(__DIR__ . '/smsAliDaYu.php');
                $this->obj = new smsAliDaYu();
                $this->method = 'sendCurrentNotice';
                break;
            case 8:
                require_once(__DIR__ . '/smsAliDaYu.php');
                $this->obj = new smsAliDaYu();
                $this->method = 'sendDataOverdue';
                break;
            case 9:
                require_once(__DIR__ . '/suduntec.php');
                $this->obj = new \suduntec\suduntec();
                $this->method = 'sendSmg';
                break;
            default:
                break;
        }
        return true;
    }
}