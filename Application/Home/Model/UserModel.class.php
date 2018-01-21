<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 9:44
 */

namespace  Home\Model;
use Think\Model;

class UserModel extends Model
{

    //定义可以提交到数据库的字段
    protected $fields  = array('phone','password','user_name','card_number','is_authentication','is_credit','card_photo_positive','card_photo_back','verification_photo','user_grade','id');//此处写入di字段时为了解决当用户实名认证的时候，调用save方法会接受不到id而加上的

    protected $_validate = array(
        array('phone','require','手机号必填'),
        array('user_name','require','姓名必填'),
        array('card_number','require','身份证号必填'),
        array('card_number','','该身份证号已被注册！',0,'unique',1),
        array('phone','','手机号已被注册！',0,'unique',1),
        array('password','require','密码必填'),
        array('cpassword','password','确认密码不正确',0,'confirm'),
        array('code','require','验证码必填'),
        array('code','checkcode','验证码不正确',0,'callback'),
    );
    function checkcode(){
        $code = I('post.code');
        $chcode = session('code');
        if($code == $chcode){
            return true;
        }
        return true;
    }

    public function _before_insert(&$data, $options)
    {
           $data['password'] = md5($data['password']);
           $data['create_time'] = time();
    }

    public function chkpwd(){
        $password = I('post.password');
        $where['phone'] = I('post.phone');
        $where['password'] =md5($password);

        $info = $this->where($where)->select();
        if(!$info){
            $this->error = '输入的用户名或密码不正确';
            return false;
        }
        return true;

    }

    //修改密码
    public function uppassword(){
        $phone = I('post.phone');

        $password = I('post.password');
        $password = md5($password);
        $sql = "UPDATE `tj_user` SET password = '{$password}' WHERE phone = {$phone}";
        $info = $this->execute($sql);
        return $info;

    }

    //判断是否有实名制认证
    public function is_authentication(){

        $where['phone'] = session('phone');
        $where['is_authentication'] = 1;// 后面这个where一直没有,暂时用这种方式

//            $info = $this->where($where)->where('is_authentication = 1 ')->select();
        $info =  $this->where($where)->select();

//        var_dump($info,$this->getLastSql());die;


        if(!$info){
            $this->error = '还没有实名制认证';
            return false;
        }
        return true;


    }
    public  function _before_update(&$data,$option){

        //数据提交前将用户图片地址存到数据库，图片保存到硬盘
        if(!isset($_FILES['card_photo_positive']) || $_FILES['card_photo_positive']['error'] != 0){
            $this->getError();
            return false;
        }
        if(!isset($_FILES['card_photo_back']) || $_FILES['card_photo_back']['error'] != 0){
            $this->getError();
            return false;
        }
        if(!isset($_FILES['verification_photo']) || $_FILES['verification_photo']['error'] != 0){
            $this->getError();
            return false;
        }

        $upload = new \Think\Upload(array(
            'maxSize'=>2*1024*1024,
            'exts'=>array('jpg','gif','png','jpeg'),
            'rootPath'=>'./Public/Uploads/',
            'savePath'=>'User/',
        ));
        /****************************上传图片之前先看之前是否有存入照片*****************************/

        $img = $this->field('card_photo_positive,card_photo_back,verification_photo')->find($option['where']['id']);
        @unlink('./Public/Uploads/'.$img['card_photo_positive']);
        @unlink('./Public/Uploads/'.$img['card_photo_back']);
        @unlink('./Public/Uploads/'.$img['verification_photo']);

        $this->getError();
//
//        $info = $upload->upload();
//        if($info){
//            $data['card_photo_positive'] ='/Public/Uploads/'.$info['card_photo_positive']['savepath']. $info['card_photo_positive']['savename'];
//
//            $data['card_photo_back'] ='/Public/Uploads/'.$info['card_photo_back']['savepath']. $info['card_photo_back']['savename'];
//
//            $data['verification_photo'] ='/Public/Uploads/'.$info['verification_photo']['savepath']. $info['verification_photo']['savename'];
//
//        }

    }
//写入户姓名和身份证号   后续改为框架方法
    public function add_user_info(){
//        var_dump($_POST);die;
        $name = I('post.user_name');
        $id = I('post.id');
        $card = I('post.card_number');
        $data = $this->uploads();
        $card_photo_positive = $data['card_photo_positive'];
        $card_photo_back = $data['card_photo_back'];
        $verification_photo = $data['verification_photo'];

        $sql = "UPDATE `tj_user` SET user_name = '{$name}' ,card_number = '{$card}',card_photo_positive = '{$card_photo_positive}' , card_photo_back = '{$card_photo_back}' , verification_photo = '{$verification_photo}'  WHERE id = {$id}";
        $info = $this->execute($sql);
//        var_dump($this->getLastSql());die;
        return $info;
    }

    protected function uploads(){
        if(!isset($_FILES['card_photo_positive']) || $_FILES['card_photo_positive']['error'] != 0){
            $this->getError();
            return false;
        }
        if(!isset($_FILES['card_photo_back']) || $_FILES['card_photo_back']['error'] != 0){
            $this->getError();
            return false;
        }
        if(!isset($_FILES['verification_photo']) || $_FILES['verification_photo']['error'] != 0){
            $this->getError();
            return false;
        }

        $upload = new \Think\Upload(array(
            'maxSize'=>2*1024*1024,
            'exts'=>array('jpg','gif','png','jpeg'),
            'rootPath'=>'./Public/Uploads/',
            'savePath'=>'User/',
        ));
        $info = $upload->upload();

        if($info){
            $data['card_photo_positive'] ='/Public/Uploads/'.$info['card_photo_positive']['savepath']. $info['card_photo_positive']['savename'];

            $data['card_photo_back'] ='/Public/Uploads/'.$info['card_photo_back']['savepath']. $info['card_photo_back']['savename'];

            $data['verification_photo'] ='/Public/Uploads/'.$info['verification_photo']['savepath']. $info['verification_photo']['savename'];
            return $data;
        }

        $this->getError();
        return false;


    }



}