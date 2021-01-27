<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else if ($_SESSION['role'] == 'student') {
  header('location:../dashboard.php');
} else {
  if (isset($_POST['change'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $username = $_SESSION['login'];
    $sql = "SELECT Password FROM admin where UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update admin set Password=:newpassword where UserName=:username";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg = "Your Password succesfully changed";
    } else {
      $error = "Your current password is wrong";
    }
  }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Online Library Management System </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }

      .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }
    </style>
  </head>
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

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">Change Password</h4>
          </div>
        </div>
        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

        <!--LOGIN PANEL START-->
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="panel ">
              <div class="panel-heading"> Change Password </div>
              <div class="panel-body">
                <form role="form" method="post" onSubmit="return valid();" name="chngpwd">

                  <div class="row justify-content-center">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Enter Current Password</label>
                        <div class="input-group" id="showOld">
                          <input class="form-control" type="password" name="password" autocomplete="off" required />
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
                        <label>Enter New Password</label>
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
                        <label>Confirm New Password </label>
                        <div class="input-group" id="showRepeat">
                          <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                          <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <button type="submit" name="change" class="btn btn-info"> Submit </button>
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
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $("#showOld a").on('click', function(event) {
          event.preventDefault();
          if ($('#showOld input').attr("type") == "text") {
            $('#showOld input').attr('type', 'password');
            $('#showOld i').addClass("fa-eye-slash");
            $('#showOld i').removeClass("fa-eye");
          } else if ($('#showOld input').attr("type") == "password") {
            $('#showOld input').attr('type', 'text');
            $('#showOld i').removeClass("fa-eye-slash");
            $('#showOld i').addClass("fa-eye");
          }
        });

        $("#showNew a").on('click', function(event) {
          event.preventDefault();
          if ($('#showNew input').attr("type") == "text") {
            $('#showNew input').attr('type', 'password');
            $('#showNew i').addClass("fa-eye-slash");
            $('#showNew i').removeClass("fa-eye");
          } else if ($('#showNew input').attr("type") == "password") {
            $('#showNew input').attr('type', 'text');
            $('#showNew i').removeClass("fa-eye-slash");
            $('#showNew i').addClass("fa-eye");
          }
        });

        $("#showRepeat a").on('click', function(event) {
          event.preventDefault();
          if ($('#showRepeat input').attr("type") == "text") {
            $('#showRepeat input').attr('type', 'password');
            $('#showRepeat i').addClass("fa-eye-slash");
            $('#showRepeat i').removeClass("fa-eye");
          } else if ($('#showRepeat input').attr("type") == "password") {
            $('#showRepeat input').attr('type', 'text');
            $('#showRepeat i').removeClass("fa-eye-slash");
            $('#showRepeat i').addClass("fa-eye");
          }
        });
      });
    </script>
  </body>

  </html>
<?php } ?>