<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else if ($_SESSION['role'] == 'student') {
  header('location:../dashboard.php');
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
          <a class="custom col-md-3 col-sm-3 col-xs-6" href="manage-books.php">
            <div class="alert alert-success back-widget-set text-center">
              <i class="fa fa-book fa-5x"></i>
              <?php
              $sql = "SELECT id from tblbooks ";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listdbooks = $query->rowCount();
              ?>
              <h3><?php echo htmlentities($listdbooks); ?></h3>
              Listed Books
            </div>
          </a>

          <a class="custom col-md-3 col-sm-3 col-xs-6" href="manage-issued-books.php">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-bars fa-5x"></i>
              <?php
              $sql1 = "SELECT id from tblissuedbookdetails ";
              $query1 = $dbh->prepare($sql1);
              $query1->execute();
              $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
              $issuedbooks = $query1->rowCount();
              ?>
              <h3><?php echo htmlentities($issuedbooks); ?> </h3>
              Books Issued
            </div>
          </a>

          <a class="custom col-md-3 col-sm-3 col-xs-6" href="manage-issued-books.php">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-recycle fa-5x"></i>
              <?php
              $status = 1;
              $sql2 = "SELECT id from tblissuedbookdetails where RetrunStatus=:status";
              $query2 = $dbh->prepare($sql2);
              $query2->bindParam(':status', $status, PDO::PARAM_STR);
              $query2->execute();
              $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
              $returnedbooks = $query2->rowCount();
              ?>
              <h3><?php echo htmlentities($returnedbooks); ?></h3>
              Books Returned
            </div>
          </a>

          <a class="custom col-md-3 col-sm-3 col-xs-6" href="reg-students.php">
            <div class="alert alert-danger back-widget-set text-center">
              <i class="fa fa-users fa-5x"></i>
              <?php
              $sql3 = "SELECT id from tblstudents ";
              $query3 = $dbh->prepare($sql1);
              $query3->execute();
              $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
              $regstds = $query3->rowCount();
              ?>
              <h3><?php echo htmlentities($regstds); ?></h3>
              Registered Users
            </div>
            <<<<<<< HEAD </div>
              =======
          </a>
          >>>>>>> origin/develop
        </div>

        <div class="row">
          <a class="custom col-md-3 col-sm-3 col-xs-6" href="manage-authors.php">
            <div class="alert alert-success back-widget-set text-center">
              <i class="fa fa-user fa-5x"></i>
              <?php
              $sq4 = "SELECT id from tblauthors ";
              $query4 = $dbh->prepare($sql);
              $query4->execute();
              $results4 = $query4->fetchAll(PDO::FETCH_OBJ);
              $listdathrs = $query4->rowCount();
              ?>
              <h3><?php echo htmlentities($listdathrs); ?></h3>
              Listed Authors
            </div>
          </a>

          <a class="custom col-md-3 col-sm-3 col-xs-6" href="manage-categories.php">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-file-archive-o fa-5x"></i>
              <?php
              $sql5 = "SELECT id from tblcategory ";
              $query5 = $dbh->prepare($sql1);
              $query5->execute();
              $results5 = $query5->fetchAll(PDO::FETCH_OBJ);
              $listdcats = $query5->rowCount();
              ?>
              <h3><?php echo htmlentities($listdcats); ?> </h3>
              Listed Categories
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
  </body>

  </html>
<?php } ?>