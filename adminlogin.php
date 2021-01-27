<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) > 0) {
  $_SESSION['role'] == 'admin' ? header('location:admin/dashboard.php') : header('location:dashboard.php');
} else {
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName, Password FROM admin WHERE UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $_SESSION['login'] = $_POST['username'];
      $_SESSION['role'] = "admin";
      echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
    } else {
      echo "<script>alert('Invalid Details');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Online Library Management System</title>
  <!-- BOOTSTRAP CORE STYLE  -->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONT AWESOME STYLE  -->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLE  -->
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- GOOGLE FONT -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>

<body>
  <!------MENU SECTION START-->
  <?php include('includes/header.php'); ?>
  <!-- MENU SECTION END-->
  <div class="content-wrapper">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">ADMIN LOGIN</h4>
        </div>
      </div>
      <!--LOGIN PANEL START-->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <div class="panel ">
            <div class="panel-heading"> LOGIN </div>
            <div class="panel-body">
              <form role="form" method="post">
                <div class="form-group">
                  <label>Enter Username</label>
                  <input class="form-control" name="username" autocomplete="off" required />
                </div>

                <div class="row justify-content-center">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Password</label>
                      <div class="input-group" id="showPassword">
                        <input class="form-control" type="password" name="password" autocomplete="off" required />
                        <div class="input-group-addon">
                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" name="login" class="btn btn-info"> LOGIN </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php'); ?>
  <!-- FOOTER SECTION END-->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS  -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#showPassword a").on('click', function(event) {
        event.preventDefault();
        if ($('#showPassword input').attr("type") == "text") {
          $('#showPassword input').attr('type', 'password');
          $('#showPassword i').addClass("fa-eye-slash");
          $('#showPassword i').removeClass("fa-eye");
        } else if ($('#showPassword input').attr("type") == "password") {
          $('#showPassword input').attr('type', 'text');
          $('#showPassword i').removeClass("fa-eye-slash");
          $('#showPassword i').addClass("fa-eye");
        }
      });
    });
  </script>
</body>

</html>