<?php
$message = '';

if(isset($_POST['username'])){
	
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$contact=$_POST['contact'];
	
	$conn = mysqli_connect('localhost', 'root', '', 'oddc');

if (!$conn) {
	die("Connection failed");}
	
	
//securing data
$username=preg_replace("#[^0-9a-z]#i","","$username");
$password=mysqli_real_escape_string($conn,$_POST['password']);	
$email=mysqli_real_escape_string($conn,$_POST['email']);
$contact=mysqli_real_escape_string($conn,$_POST['contact']);
	
//check for duplicates
	
$user_query=mysqli_query($conn,"SELECT username FROM members WHERE username='$username'LIMIT 1")or die("Could not check username");
$count_username=mysqli_num_rows($user_query);
	
$email_query=mysqli_query($conn,"SELECT email FROM members WHERE email='$email'LIMIT 1")or die("Could not check Email");
$count_email=mysqli_num_rows($email_query);

$contact_query=mysqli_query($conn,"SELECT contactno FROM members WHERE contactno='$contact'LIMIT 1")or die("Could not check your contact");
$count_contact=mysqli_num_rows($contact_query);


	
if($count_username>0){
	$message='Your username is already taken';
}elseif($count_email>0){
	$message='Your email is already in use';
}elseif($count_contact>0){
	$message='Your contact is already in use';
}else{
	
//insert the members
$query=mysqli_query($conn,"INSERT INTO members (Username,Email,contactno,Password)VALUES('$username','$email','$contact','$password')") or die("Could not insert your information");

header("Location:login.php");
	
}
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
    <!-- Link Bootstrap CSS -->
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
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form name="frm" id="form" action="register.php" method="POST">
                    <h2 class="text-center">Registeration Form</h2>
                    <p class="text-center">It's quick and easy.</p>

                    <div id="error" class="text-center"><?php echo $message;?></div>

                    <div class="form-group">
                        <input class="form-control" type="text" name="username" id="username" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="contact" id="contact" placeholder="Phone Number">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name="register" id="submit">Register</button>
                    </div>
                    <div class="text-center">Already a member? <a href="login.php">Login here</a></div>
                    <div class="link login-link text-center"><a href="index.php">Go to Home Page</a></div>
                
                </form>
            </div>
        </div>
    </div>
    <!-- Add jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    
	<script type="text/javascript">
		const form = document.getElementById('form');
		const username = document.getElementById('username');
		const email = document.getElementById('email');
		const contact = document.getElementById('contact');
		const password = document.getElementById('password');
		const errorElement = document.getElementById('error');
		const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

		form.addEventListener('submit',(e) =>{
			let messages = [];
			if (username.value === '' || username.value == null) {
				messages.push('Name is required');
			}

			if (contact.value === '' || contact.value == null) {
				messages.push('Phone Number is required');
			}

			if (email.value === '' || email.value == null) {
				messages.push('Email is required');
			} else{

				if (email.value.match(pattern)) {
					
				} else{
					messages.push('Your Email is Invalid');
				}				
			}


			if (password.value === '' || password.value == null) {
				messages.push('Password is required');
			}

			else{
					if (cpassword.value === '' || cpassword.value == null) {
					messages.push('Confirmation password is required');
				} else{
					if (password.value === cpassword.value) {}
						else{
							messages.push('Your Password Fields Do Not Match')
						}
				}
			}

			

			if (messages.length > 0) {
				e.preventDefault();
				errorElement.innerText = messages.join(', ');
			}
		});
	</script>	
</body>
</html>