<?php
if(!empty($_POST["username"])){
	$name = $_POST["username"];
	$pwd = $_POST["pwd"];
	$mail = $_POST["mail"];
	$phone = $_POST["phone"];
	echo"$name.</br>";
	echo"$pwd.</br>";
	echo"$mail.</br>";
	echo"$phone.</br>";
	header("Content-Type: text/html; charset=utf-8");
	$con = mysqli_connect('localhost','root','','test');
	if(!$con){
		 die('连接服务器失败：'.mysqli_error());
		}
	echo"成功连接到服务器!";
	$sql="select name from data";
	$result = mysqli_query($con, $sql);
	$num = mysqli_num_rows($result);
	if($num > 0){
		$array = mysqli_fetch_array($result,MYSQLI_NUM);
		while($array){
			if($name == $array[0]){
				echo"<script language='javascript'>";
				echo"alert('用户名已存在！');";
				echo"</script>";
				die();
				break;
				}
			$array = mysqli_fetch_array($result,MYSQLI_NUM);
			}
		}
	$sql="insert into data(name, pwd, phone, mail) values ('$name','$pwd','$phone','$mail')";
	$t = mysqli_query ($con,$sql);
	if($t){
		echo"数据成功写入数据库！";
		}else echo"数据写入数据库失败！";
}else{
		echo"<script language='javascript'>";
		echo"alert('用户名不能为空！');";
		echo"</script>";
	}
?>