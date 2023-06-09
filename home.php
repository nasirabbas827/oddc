<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Diagnostic Center - Home Page</title>
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
        
    </style>
</head>
<body>
<?php
include('navbar.php');
?>

<!--Jumbotron-->
<section class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-6 jumbotron-content">
                <h1>Welcome to the Online Diagnostic Center</h1>
                <p class="lead">We offer a wide range of medical tests and screenings to help diagnose various health
                    conditions. Our experienced staff and state-of-the-art equipment ensure accurate and reliable
                    results.</p>
                <hr class="my-4">
                <p>Book an appointment today and take the first step towards better health.</p>
                <a class="btn btn-primary btn-lg" href="test_requests.php" role="button">Make Test Request</a>
            </div>
        </div>
    </div>
</section>
<section class="container my-5">
  <div class="row">
    <div class="col-md-8">
      <h2 class="mb-4">Our Services</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="card mb-4">
            <img src="https://images.unsplash.com/photo-1542884841-9f546e727bca?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Blood Tests</h5>
              <p class="card-text">We offer a variety of blood tests to help diagnose a range of health conditions.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card mb-4">
            <img src="https://images.unsplash.com/photo-1619691249147-c5689d88016b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Diagnostic Imaging</h5>
              <p class="card-text">Our state-of-the-art imaging equipment provides clear and accurate images to aid in diagnosis.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card mb-4">
            <img src="https://images.unsplash.com/photo-1576671414121-aa0c81c869e1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTR8fFNjcmVlbmluZ3N8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Health Screenings</h5>
              <p class="card-text">Our health screenings can help detect potential health issues before they become more serious.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card mb-4">
            <img src="https://images.unsplash.com/photo-1578496481449-cf2e845cc00c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Physical Exams</h5>
              <p class="card-text">Our experienced medical professionals can perform thorough physical exams to assess your overall health.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <h2 class="mb-4">About Us</h2>
      <p>We are committed to providing the highest quality diagnostic services to our patients. Our experienced staff and state-of-the-art equipment ensure accurate and reliable results. Contact us today to learn more.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Contact Us</a>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <?php
include('footer.php');
?>
</body>
</html>

