 <?php
 	include 'inc/header.php';
 ?>
 <?php
			if($_SERVER['REQUEST_METHOD']== 'POST'){
				$fname=$fm->validation($_POST['firstname']);
				$lname=$fm->validation($_POST['lastname']);
				$email=$fm->validation($_POST['email']);
				$body=$fm->validation($_POST['body']);


				$fname=mysqli_real_escape_string($db->link, $fname);
				$lname=mysqli_real_escape_string($db->link, $lname);
				$email=mysqli_real_escape_string($db->link, $email);
				$body=mysqli_real_escape_string($db->link, $body);
		
				if(empty($fname)){//showing all errors together
					$errorf="First Name Required";
				}if(empty($lname)){
					$errorl="Last Name Requires";
				}if(empty($email)){
					$errore="Email Address Requires";
				}if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
					$errore="Invalid Email";
				}if(empty($body)){
					$errorb="Enter Some Message";
				}else{
					$query="INSERT into tbl_contact(firstname,lastname,email,body)
							VALUES('$fname','$lname','$email','$body');";
					$insert=$db->insert($query);
					if($insert){
						$msg="Message Send Successsfully";
					}else{
						$error="Message Can not be Send";
					}
				}

				/*$error="";//showing one error at a time
				if(empty($fname)){
					$error="First Name Required";
				}elseif(filter_var($fname, FILTER_SANITIZE_SPECIAL_CHARS)==false){
					$error="Invalid Name";
				}elseif(empty($lname)){
					$error="Last Name Requires";
				}elseif(filter_var($lname, FILTER_SANITIZE_SPECIAL_CHARS)==false){
					$error="Invalid Name";
				}elseif(empty($email)){
					$error="Email Address Requires";
				}elseif(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
					$error="Invalid Email";
				}elseif(empty($body)){
					$error="Enter Some Message";
				}*/
			}
?>
<style>
	.cuserror{
		color: red;
		float: left;
	}

</style>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>

				<?php
					if(isset($error)){
						echo "<span style='color: red'>$error</span>";
					}if(isset($msg)){
						echo "<span style='color: green'>$msg</span>";
					}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
						<?php
							if(isset($errorf)){
								echo"<span class='cuserror'>$errorf</span><br/>";
							}
						?>
						<input type="text" name="firstname" placeholder="Enter first name" />
						<?php
								if(isset($errorf)){
									echo "<span style='color: red;'>*</span><br/>";
								}
						?> 
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
						<?php
							if(isset($errorl)){
								echo "<span class='cuserror'>$errorl</span><br/>";
							}
						?> 
					    <input type="text" name="lastname" placeholder="Enter Last name" />
					    <?php
							if(isset($errorl)){
								echo "<span style='color: red;'>*</span><br/>";
							}
						?> 
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
						<?php
							if(isset($errore)){
								echo "<span class='cuserror'>$errore</span><br/>";
							}
					    ?> 
						<input type="text" name="email" placeholder="Enter Email Address"/>
						<?php
							if(isset($errore)){
								echo "<span style='color: red;'>*</span><br/>";
							}
					    ?> 
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
						<?php
							if(isset($errorb)){
								echo "<span class='cuserror'>$errorb</span><br/>";
							}
						?> 
						<textarea name="body"></textarea>
						<?php
							if(isset($errorb)){
								echo "<span style='color: red;'>*</span>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

</div>
</html>
    <?php 
		include 'inc/sidebar.php';
		include 'inc/footer.php';
	?>