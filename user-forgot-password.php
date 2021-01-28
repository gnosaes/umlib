<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) > 0) {
  $_SESSION['role'] == 'admin' ? header('location:admin/dashboard.php') : header('location:dashboard.php');
} else {
  if (isset($_POST['change'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT EmailId FROM tblstudents WHERE EmailId=:email and MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update tblstudents set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('Your Password succesfully changed');</script>";
    } else {
      echo "<script>alert('Email id or Mobile no is invalid');</script>";
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
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>

<body>
  <!------MENU SECTION START-->
  <?php include('includes/header.php'); ?>
  <!-- MENU SECTION END-->
  <div class="content-wrapper">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">Password Recovery</h4>
        </div>
      </div>

      <!--LOGIN PANEL START-->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <div class="panel">
            <div class="panel-heading tts">PASSWORD RECOVERY FORM</div>
            <div class="panel-body">
              <form role="form" name="chngpwd" method="post" onSubmit="return valid();">

                <div class="form-group">
                  <label class="tts">Enter Your Email</label>
                  <input class="form-control" type="email" name="email" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label class="tts">Enter Your Mobile Number</label>
                  <input class="form-control" type="text" name="mobile" required autocomplete="off" />
                </div>

                <div class="row justify-content-center">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="tts">Enter New Password</label>
                      <div class="input-group" id="showNew">
                        <input class="form-control" type="password" name="newpassword" autocomplete="off" required />
                        <div class="input-group-addon">
                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row justify-content-center">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="tts">Confirm Password </label>
                      <div class="input-group" id="showRepeat">
                        <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                        <div class="input-group-addon">
                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="submit" name="change" class="btn btn-info btn-tts">SUBMIT</button> | <a href="index.php" class="tts">Back to login</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!---LOGIN PABNEL END-->
    </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php'); ?>
  <!-- FOOTER SECTION END-->
  <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <!-- BOOTSTRAP SCRIPTS  -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>

  <script src="https://code.responsivevoice.org/responsivevoice.js?key=2iYwTISH"></script>
  <script src="assets/js/speaker.js"></script>
</body>

</html>