<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else if ($_SESSION['role'] == 'admin') {
  header('location:admin/dashboard.php');
} else { ?>
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
    <style>
      a.custom {
        text-decoration: none;
      }

      a.custom:hover div.alert {
        box-shadow: 0 4px 16px 0 rgba(0, 0, 0, 0.16);
      }
    </style>
  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">ADMIN DASHBOARD</h4>
          </div>
        </div>
        <div class="row">
          <a class="custom col-md-3 col-sm-3 col-xs-6 menu-tts" href="issued-books.php" alt="Issued book">
            <div class="alert alert-info back-widget-set text-center" style="background: indigo;">
              <i class="fa fa-bars fa-5x"></i>
              <?php
              $sid = $_SESSION['stdid'];
              $sql1 = "SELECT id from tblissuedbookdetails where StudentID=:sid";
              $query1 = $dbh->prepare($sql1);
              $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query1->execute();
              $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
              $issuedbooks = $query1->rowCount();
              ?>
              <h3><?php echo htmlentities($issuedbooks); ?> </h3>
              Books Issued
            </div>
          </a>
          <a class="custom col-md-3 col-sm-3 col-xs-6 menu-tts" href="issued-books.php" alt="Issued book">
            <div class="alert alert-warning back-widget-set text-center" style="background: #ffc31d;">
              <i class="fa fa-recycle fa-5x"></i>
              <?php
              $rsts = 0;
              $sql2 = "SELECT id from tblissuedbookdetails where StudentID=:sid and RetrunStatus=:rsts";
              $query2 = $dbh->prepare($sql2);
              $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
              $query2->execute();
              $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
              $returnedbooks = $query2->rowCount();
              ?>
              <h3><?php echo htmlentities($returnedbooks); ?></h3>
              Books Not Returned Yet
            </div>
          </a>
        </div>
        <?php include('includes/slideshow.php'); ?>
      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
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