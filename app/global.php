<?php 



if (!function_exists('fetch_array')) {
    /**
     * 判断是否登录
     * @author 陈梦晨 <741459065@qq.com>
     * @return mixed
     */
	function fetch_array($data){
		$array=array();
		foreach($data as $key=>$val){
			$array[$key]['id']=$val->id;
			$array[$key]['pid']=$val->pid;
			$array[$key]['title']=$val->title;
			$array[$key]['mac']=$val->mca;
		}
		return $array;
    }
}