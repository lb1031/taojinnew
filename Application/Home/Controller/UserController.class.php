<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 9:32
 */

namespace Home\Controller;


use Think\Controller;

class UserController extends Controller
{
        //注册;
        public function regist(){
            if(IS_POST){
                $model = D('User');
                if($model->create(I('post.'),1)){
                    if($model->add()){
                            $this->success('注册成功!',U('Home/User/login'));
                            exit;
                    }
                }
                $msg = $model->getError();
                $this->error($msg);
            }
            $this->display();
        }

        //登陆;
        public function login(){

            if(IS_POST){
                $phone = I('post.phone');
                $model = D('User');
                if($model->chkpwd()){
                    session('phone',$phone);
                    $this->success('登陆成功!',U('Index/index'));
                    exit;
                }
                $this->error($model->getError());
            }
            $this->display();
        }


        //发短信
        public function send(){
            //引入发短信类
            Vendor('shumitech.smsgModel');


            $phone = I('post.phone');
            $code = rand(1000,9999);
            session('code',$code);
            $channel_id = 2;

            $smsgModel = new \smsgModel($channel_id);
           $info = $smsgModel->sendMsg([
//                'uid' => $uid,
                'phone' => $phone,
                'content' => $code
            ]);
            var_dump($info);

        }

        //忘记密码/修改密码
        public function forget(){
            if(IS_POST){
                $model = D('User');

                if($model->create(I('post.'),2)){
                    if($model->uppassword() !== false){
                        //提示成功，并跳转到list方法中
                        $this->success('修改成功',U('Home/User/login'));
                        exit;
                    }
                }
                $msg = $model->getError();
                $this->error($msg);
            }

            $this->display();
        }











}