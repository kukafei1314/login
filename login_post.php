<?php
header("Content-Type: text/html; charset=utf-8");
if(!isset($_COOKIE['username'])){
	if(isset($_POST['submit'])){
		$user_username = $_POST['username'];
        $user_password = $_POST['key'];
		if(!empty($user_username)&&!empty($user_password)){
			$con = new mysqli('localhost','root','','test');
			if(!$con){
				die("'连接服务器失败：'.$con->error()");
				}
			$sql_n = "SELECT ID, name FROM data WHERE name = '$user_username' AND pwd = '$user_password'";
			$result_n = $con->query($sql_n) or die('$con->error()');
			if($result_n->num_rows==1){
				$array_n=$result_n->fetch_array();
				setcookie('username',$array_n['name'],time()+3600);//
				header('Location:test_ht.html');
				/*echo"<script language='javascript'>";
				echo"alert('登陆成功！');";
				echo"</script>";
				break;*/
				}else {
						echo"<script language='javascript'>";
						echo"alert('登录失败！');";
						echo"</script>";
					}
		}
	}
}else{
		$home_url = 'test_ht.html';
    	header('Location: '.$home_url);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0033)http://localhost/login/login.html -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>用户登录</title>
</head>

<body>
<center>
<?php 
if(empty($_COOKIE['username'])){
?>
    <form id="login_form" name="login_form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <p>用户名： 
        <input type="text" name="username" id="username">
      </p>
      <p>密&nbsp;&nbsp;码： 
        <input type="password" name="key" id="key">
      </p>
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="submit" value="提交">
        &nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重新输入">
      </p>
    </form>
<?php
}else{
		$home_url = 'test_ht.html';
        header('Location: '.$home_url);
	}
?>
</center>

</body></html>