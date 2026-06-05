<?php
session_start();

$message = '';

if(isset($_POST['email'])){
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $remember=$_POST['remember'];

    $conn = mysqli_connect('localhost', 'root', '', 'oddc');
    if (!$conn) {
        die("Connection failed");
    }

    // secure the data
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);	
    $query=mysqli_query($conn,"SELECT * FROM members WHERE email='$email'AND password="YOUR_OWN_API_KEY"")or die("Could not check Member");
    $count_query=mysqli_num_rows($query);
    if($count_query==0){
        $message="The information you entered was incorrect!";
    }else{

        // start the sessions
        while($row=mysqli_fetch_array($query)){
            $username=$row['username'];
            $id=$row['id'];
        }
        $_SESSION['id']=$id;
        $_SESSION['username']=$username;
        $_SESSION['email']=$email;
        $_SESSION['remember']=$remember;

        if($remember=="yes"){

            // create the cookies
            setcookie("id_cookie",$id,time()+60*60*24*100,"/");
            setcookie("pass_cookie",$pass,time()+60*60*24*100,"/");	
        }

        header("Location: home.php");
    }	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<!-- Link custom CSS -->
	
    <style>
		body {
    background-image: url("images/reg.png");
    background-repeat: no-repeat;
    background-size: cover;
}
		/* Center the form vertically */
		.form {
    margin-top: 5%;
}

/* Add some spacing between the form elements */
.form-group {
    margin-bottom: 1.5rem;
}

/* Style the submit button */
.button {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
}

.button:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

/* Style the login link */
.login-link {
    margin-top: 1.5rem;
    color: #007bff;
}

.login-link a {
    color: #007bff;
}

.login-link a:hover {
    text-decoration: none;
    color: #0056b3;
}
.form {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.form input[type=text], .form input[type=email], .form input[type=password] {
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    margin-bottom: 20px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.form input[type=text]:focus, .form input[type=email]:focus, .form input[type=password]:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
}

.form button[type=submit] {
    background-color: #007bff;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    margin-top: 20px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    color: #fff;
    transition: all 0.3s ease-in-out;
}

.form button[type=submit]:hover {
    background-color: #0069d9;
    cursor: pointer;
}
	</style>
</head>
<body>
    <div class="container">
       

            <div class="col-md-4 offset-md-4 form login-form animated-form">
                <form action="login.php" method="POST">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Login with your email and password.</p>

                    <div id="error" class="text-center"><?php echo $message;?></div>
                    <br/>
                    <div class="form-group">
                        <input class="form-control" type="email"  autocomplete="" id="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" autocomplete="" id="pass" name="pass" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input class="form-checkbox" type="checkbox" id="checkbox" name="remember" value="yes" checked="checked">&nbsp; 
                        Remember me
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" id="submit" name="login" value="Login">
                    </div>
                    <br>
                    <div class="link forget-pass text-center">Forgot password? <a href="forgot-password.php"> Reset here</a></div>
                    <div class="link login-link text-center">Not yet a member? <a href="register.php">Register now</a></div>
                    <div class="link login-link text-center"><a href="index.php">Go to Home Page</a></div>
                </form>
            </div>
        </div>
    </div>
    
    
	<script type="text/javascript">
		const form = document.getElementById('form');
		const username = document.getElementById('username');
		const email = document.getElementById('email');
		const pass = document.getElementById('pass');
		const errorElement = document.getElementById('error');
		const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

		form.addEventListener('submit',(e) =>{
			let messages = [];
			if (username.value === '' || username.value == null) {
				messages.push('Name is required');
			}

			if (email.value === '' || email.value == null) {
				messages.push('Email is required');
			} else{

				if (email.value.match(pattern)) {

				} else{
					messages.push('Your Email is Invalid');
				}				
			}


			if (pass.value === '' || pass.value == null) {
				messages.push('Password is required');
			}

			if (messages.length > 0) {
				e.preventDefault();
				errorElement.innerText = messages.join(', ');
			}
		});
	</script>
</body>
</html>