<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else if ($_SESSION['role'] == 'admin') {
  header('location:admin/dashboard.php');
} else {
  if (isset($_POST['update'])) {
    $student_id = $_SESSION['stdid'];
    $fullname = $_POST['fullname'];
    $mobileno = $_POST['mobileno'];

    $sql = "update tblstudents set FullName=$fullname, MobileNumber=$mobileno where StudentId=$student_id";
    $query = $dbh->prepare($sql);
    $query->execute();

    echo '<script>alert("Your profile has been updated")</script>';
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h4 class="header-line">My Profile</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9 col-md-offset-1">
            <div class="panel ">
              <div class="panel-heading tts"> Edit Profile Form </div>
              <div class="panel-body">
                <form name="signup" method="post">
                  <?php
                  $sid = $_SESSION['stdid'];
                  $sql = "SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents  where StudentId=:sid ";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                    foreach ($results as $result) {               ?>
                      <div class="form-group tts">
                        <label>Student ID &emsp;&nbsp;: </label>
                        <?php echo htmlentities($result->StudentId); ?>
                      </div>

                      <div class="form-group tts">
                        <label>Register Date : </label>
                        <?php echo htmlentities($result->RegDate); ?>
                      </div>

                      <?php if ($result->UpdationDate != "") { ?>
                        <div class="form-group tts">
                          <label>Last Update &nbsp;&nbsp;: </label>
                          <?php echo htmlentities($result->UpdationDate); ?>
                        </div>
                      <?php } ?>

                      <div class="form-group tts">
                        <label>Profile Status : </label>
                        <?php if ($result->Status == 1) { ?>
                          <span style="color: green">Active</span>
                        <?php } else { ?>
                          <span style="color: red">Blocked</span>
                        <?php } ?>
                      </div>

                      <div class="form-group">
                        <label class="tts">Enter Full Name</label>
                        <input class="form-control input-tts" type="text" name="fullname" placeholder="Enter your full name" value="<?php echo htmlentities($result->FullName); ?>" autocomplete="off" required />
                      </div>

                      <div class="form-group">
                        <label class="tts">Enter Mobile Number</label>
                        <input class="form-control input-tts" type="text" name="mobileno" minlength="10" maxlength="11" placeholder="Enter your mobile number" value="<?php echo htmlentities($result->MobileNumber); ?>" autocomplete="off" required />
                      </div>

                      <div class="form-group">
                        <label class="tts">Email</label>
                        <input class="form-control input-tts" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId); ?>" autocomplete="off" required readonly />
                      </div>
                  <?php }
                  } ?>

                  <button type="submit" name="update" class="btn btn-primary btn-tts" id="submit">Update Profile</button>
                </form>
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

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=2iYwTISH"></script>
    <script src="assets/js/speaker.js"></script>
  </body>

  </html>
<?php } ?>