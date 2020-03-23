<?php 
	require_once'config.php';
/**
 * 封装大家公用的函数
 */
session_start();
// 定义函数时一定要注意：函数名与内置函数冲突问题
// JS 判断方式：typeof fn === 'function'
// PHP 判断函数是否定义的方式： function_exists('get_current_user')

/**
 * 获取当前登录用户信息，如果没有获取到则自动跳转到登录页面
 * @return [type] [description]
 */
function xiu_get_current_user(){
	// 没有当前登录用户信息，意味着没有登录
	if(empty($_SESSION['current_login_user'])){
		header('Location: /admin/login.php');
		exit();// 没有必要再执行之后的代码
	}
	return $_SESSION['current_login_user'];
 }

 /**
 * 通过一个数据库查询获取多条数据
 * => 索引数组套关联数组
 */
function xiu_fetch_all($sql){
	$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if(!$conn){
			exit('连接数据库失败');
		}
	$query=mysqli_query($conn,$sql);
		if(!$query){
		return false;
		}
	while($row= mysqli_fetch_assoc($query)){
		$result[]=$row;
	}
	//释放缓存
	// mysqli_affected_rows($query);
	//断开数据连接
	mysqli_close($conn);

	return $result;
}


 /**
 * 通过一个数据库查询获取一条数据
 * => 索引数组套关联数组
 */
function xiu_fetch_one($sql){
		$res=xiu_fetch_all($sql);
		return isset($res[0]) ? $res[0] :null;

}
function xiu_execute($sql){
	$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if(!$conn){
			exit('连接数据库失败');
		}
	$query=mysqli_query($conn,$sql);
		if(!$query){
		return false;
		}
	$affected_rows = mysqli_affected_rows($conn);
	return $affected_rows;

}
