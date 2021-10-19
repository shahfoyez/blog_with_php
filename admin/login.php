
<?php
 	include '../lib/Session.php';
 	Session::init();
 	 
 ?><?php
 	include '../config/config.php';
 	include '../lib/Database.php';
 	include '../helpers/Format.php';
 ?>
 <?php
 	$db=new Database();
 	$fm=new Format();
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD']== 'POST'){
				$username=$fm->validation($_POST['username']);
				$password=$fm->validation(md5($_POST['password']));
				$username=mysqli_real_escape_string($db->link, $username);
				$password=mysqli_real_escape_string($db->link, $password);
				if(empty($username) || empty($password)){
					//$errore="Enter Username and Password";
                   echo "<span style='color: red; font-size:18px; font-weight: bold;'>Enter Email and Password!</span>";
                }else{
					$query="select * from tbl_user where username='$username' AND pass='$password'";
					$result=$db->select($query);
					if($result!=false){
						 
						//$value=mysqli_fetch_array($result);
						$value=$result->fetch_assoc();
						Session::set("login", true);
						Session::set("username", $value['username']);
						Session::set("userid", $value['id']);
						//Session::set("name", $value['name']);
						Session::set("userrole", $value['role']);
						Session::set("name", $value['name']);
						header('Location: index.php'); 
					}else{
						$query="select * from tbl_user where username='$username'";
						$result=$db->select($query);
						if($result){
							echo "<span style='color: red; font-size: 18px; font-weight: bold;'>Password is not Corrrect!</span>";
						
						}else{
						    echo "<span style='color: red; font-size: 18px; font-weight: bold;'>Invalid username and passsword!</span>";
						}
					}
				}
			}
		?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="passrecovery.php">Forgot Password?</a>
		</div>
		<div class="button">
			<a href="#">Admin Panel of Foyez's Blog</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>