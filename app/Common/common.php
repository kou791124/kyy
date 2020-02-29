<?php

/**
 * 返回json串
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */

function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}

/**
 * 无限极分类
 * @param $data foreach循环的数据
 * @param int $p_id
 * @param int $level
 * @return array|void
 */
function createTree($data,$p_id=0,$level=1)
{

    static $new_array = [];

    if (!$data) {
        return;
    }
    foreach ($data as $k => $v) {

        if ($v->p_id == $p_id) {

            $v->level = $level;

            $new_array[] = $v;

            createTree($data, $v->cate_id, $level + 1);
        }
    }
    return $new_array;
}

/**
 * 文件上传
 * @param $filename 文件名
 * @return false|string
 */
function upload($filename){

    if( request()->file($filename)->isValid() ){

        //接收值
        $photo = request()->file($filename);

        //上传
        $store_result = $photo->store('uploads');

        return $store_result;
    }
    exit('未上传文件');
}

/**
 * 多文件上传
 * @param $filename
 * @return array|void
 */
function Moreuploads($filename){
    $photo = request()->file($filename);
    if(!is_array($photo)){
        return;
    }

    foreach( $photo as $v ){
        if ($v->isValid()){
            $store_result[] = $v->store('uploads');
        }
    }

    return $store_result;
}

function getUserId(){
    return session('user', 'user_id');
}
