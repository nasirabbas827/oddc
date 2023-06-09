<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
          <style>
        /* Background color for the jumbotron */
        .jumbotron {
            background-image: url(https://images.unsplash.com/photo-1631816285219-c6af3851e360?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=876&q=80);
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .jumbotron::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }

        .jumbotron-content {
            color: white;
            z-index: 1;
        }
      .jumbotron h1{
        font-size: 50px;
      }
      .jumbotron p{
        font-size: 20px;
      }

        /* Add a background color and border to the "Book Appointment" button */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Change the color of the "Book Appointment" button on hover */
        .btn-primary:hover {
            background-color: #0062cc;
            border-color: #0062cc;
        }
        .navbar {
background-color: #343a40; /* dark grey */
}

.navbar-brand {
font-size: 1.5rem;
font-weight: bold;
}

.nav-link {
font-size: 1.2rem;
margin-right: 10px;
}

.nav-link:hover {
color: #17a2b8; /* light blue */
}

.navbar-toggler {
border-color: #17a2b8;
}

.navbar-toggler-icon {
background-color: #fff; /* white */
}
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    nav{
        padding-left: 100px!important;
        padding-right: 100px!important;
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    }
    nav a.navbar-brand{
        color: #fff;
        font-size: 30px!important;
        font-weight: 500;
    }
    button a{
        color: #6665ee;
        font-weight: 500;
    }
    button a:hover{
        text-decoration: none;
    }

    </style>
</head>
<body>
<nav class="navbar">
    <a class="navbar-brand" href="#">Online Diagnostic Center</a>
    <a class="nav-link" href="./admin/adminlogin.php">Admin Login</a>
    <a class="nav-link" href="contact-us.html">Contact Us</a>
    <a class="nav-link" href="about-us.html">About Us</a>
</nav>

    <!--Jumbotron-->
<section class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-6 jumbotron-content">
                <h1>Welcome to the Online Diagnostic Center</h1>

                <hr class="my-4">
            <p>Take the first step towards better health.</p>
            <a class="btn btn-success btn-lg mr-3" href="./manager/manager_register.php" role="button">Register as Manger</a>
            <a class="btn btn-success btn-lg mr-3" href="./manager/manager_login.php" role="button">Login as Manger</a>
            <a class="btn btn-primary btn-lg mr-3" href="register.php" role="button">Register Now</a>
            <a class="btn btn-secondary btn-lg" href="login.php" role="button">Login</a>
        </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <?php
include 'footer.php';
?>

</body>
</html>