<?php 
	require_once'../functions.php';
	if(empty($_GET['id'])){
		exit('缺少必要参数');
	}

	$id = $_GET['id'];

	$row=xiu_execute('delete from posts where id in (' . $id . ');');


	header('Location:' . $_SERVER['HTTP_REFERER']);

 ?>
 