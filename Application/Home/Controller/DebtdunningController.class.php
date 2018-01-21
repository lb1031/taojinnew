<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 13:20
 */

namespace Home\Controller;


use Think\Controller;

class DebtdunningController extends Controller
{
    public function index(){

        if(!(session('phone'))){

            $this->display('unauthorized');

//            $this->error('你好请先登录',U('unauthorized'),1);
            exit;
        }
        $model = D('User');
        if(!($model->is_authentication())){

            $where['phone'] = session('phone');
            $info = $model->field('id')->where($where)->find();
//            var_dump($info);die;
            $this->assign('info',$info);

            $this->display('authentication');

//            $this->error('你好,请先实名认证',U('authentication'),1);
            exit;
        }
        $this->display();
    }

    public function authentication(){

        $User = D('User');
        if($User->create(I('post.'),2)){

//此处用框架方法有些问题,先用原生的
            if($User->save() !== FALSE){
                        echo 'ok';die;
            }
        }
        $msg = $User->getError();
        $this->error($msg);






    }


}