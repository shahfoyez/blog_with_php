
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
				$email=$fm->validation($_POST['email']);
				$email=mysqli_real_escape_string($db->link, $email);
				if(empty($email)){
                    echo "<span style= 'color: red; font-size:20px; font-weight: bold;'>Enter Your Email</span>";
                }elseif(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
					echo "<span style= 'color: red; font-size:20px; font-weight: bold;'>Invalid Email</span>";
				}else{

					$query="select * from tbl_user where email='$email' limit 1";
					$emailcheck=$db->select($query);
					if($emailcheck){
						while($value=$emailcheck->fetch_assoc()){
							$userid=$value['id'];
							$username=$value['username'];
							$password=$value['pass'];

						}
						$text=substr($email, 0, 3);
						$rand=rand(10000, 99999);
						$newpass="$text$rand";
						$password=md5($newpass);
						$query="UPDATE tbl_user 
                                SET
                                pass='$password' 
                                where id='$userid'";
                         $update=$db->update($query);
                         $to=$email;
                         $from="Foyez's Blog";
                         $sub="Recovery";
                         $headers="From: $from\n";
                         $headers .='MIME_VERSION: 1.0' . "\r\n";
                         $headers .='Content-type: text/html; charset=iso-8859-1' ."\r\n";
      
                         $message="Your Username is ".$username." and password is ".$newpass;
                         $sendmail=mail($to, $sub, $message, $headers);
                         if($sendmail){
                         	echo "<span style= 'color: green; font-size:20px; font-weight: bold;'>Please Check Your Email</span>";
                         }else{
                         	echo "<span style= 'color: red; font-size:20px; font-weight: bold;'>Email Not Send</span>";
                         }
						 
					}else{
						echo "<span style= 'color: red; font-size:20ps; font-weight: bold;'>Email Address Not Found</span>";
					}
				}
				
			}
		?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter your Email Address..." name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login!</a>
		</div>
		<div class="button">
			<a href="#">Admin Panel of Foyez's Blog</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>