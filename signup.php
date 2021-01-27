<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['signup'])) {
  $fullname = $_POST['fullanme'];
  $mobileno = $_POST['mobileno'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $status = 1;

  $sql = "INSERT INTO tblstudents(FullName,MobileNumber,EmailId,Password,Status) VALUES(:fullname,:mobileno,:email,:password,:status)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
  $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->bindParam(':status', $status, PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();

  $student_id = "SID" . sprintf('%03d', $lastInsertId);
  $sql = "UPDATE tblstudents SET StudentId=:studentId WHERE id=:id";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentId', $student_id, PDO::PARAM_STR);
  $query->bindParam(':id', $lastInsertId, PDO::PARAM_STR);
  $query->execute();

  if ($lastInsertId) {
    echo '<script>alert("Your Registration successfull and your student id is  "+"' . $student_id . '")</script>';
  } else {
    echo "<script>alert('Something went wrong. Please try again');</script>";
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
  <script type="text/javascript">
    function valid() {
      if (document.signup.password.value != document.signup.confirmpassword.value) {
        alert("Password and Confirm Password Field do not match  !!");
        document.signup.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
  <script>
    function checkAvailability() {
      $("#loaderIcon").show();
      jQuery.ajax({
        url: "check_availability.php",
        data: 'emailid=' + $("#emailid").val(),
        type: "POST",
        success: function(data) {
          $("#user-availability-status").html(data);
          $("#loaderIcon").hide();
        },
        error: function() {}
      });
    }
  </script>

</head>

<body>
  <!------MENU SECTION START-->
  <?php include('includes/header.php'); ?>
  <!-- MENU SECTION END-->
  <div class="content-wrapper">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">User Signup</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9 col-md-offset-1">
          <div class="panel panel-danger">
            <div class="panel-heading"> SINGUP FORM </div>
            <div class="panel-body">
              <form name="signup" method="post" onSubmit="return valid();">
                <div class="form-group">
                  <label>Enter Full Name</label>
                  <input class="form-control" type="name" name="fullanme" autocomplete="off" required />
                </div>

                <div class="form-group">
                  <label>Mobile Number :</label>
                  <input class="form-control" type="text" name="mobileno" maxlength="11" minlength="10" autocomplete="off" required />
                </div>

                <div class="form-group">
                  <label>Enter Email</label>
                  <input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()" autocomplete="off" required />
                  <span id="user-availability-status" style="font-size:12px;"></span>
                </div>

                <div class="row justify-content-center">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Enter Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input class="form-control" type="password" name="password">
                        <div class="input-group-addon">
                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Confirm Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input class="form-control" type="password" name="confirmpassword">
                        <div class="input-group-addon">
                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>
              </form>
            </div>

            <button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php'); ?>
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS  -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("fa-eye-slash");
          $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("fa-eye-slash");
          $('#show_hide_password i').addClass("fa-eye");
        }
      });
    });
  </script>
</body>

</html>