<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else if ($_SESSION['role'] == 'student') {
  header('location:../dashboard.php');
} else {
  if (isset($_POST['issue'])) {
    $studentid = strtoupper($_POST['studentid']);
    $bookid = $_POST['bookid'];
    $sql = "INSERT INTO  tblissuedbookdetails(StudentID,BookId) VALUES(:studentid,:bookid); UPDATE tblbooks SET Available_Qty=Available_Qty-1 WHERE tblbooks.id=:bookid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
      $_SESSION['msg'] = "Book issued successfully";
      header('location:manage-issued-books.php');
    } else {
      $_SESSION['error'] = "Something went wrong. Please try again";
      header('location:manage-issued-books.php');
    }
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

    <style type="text/css">
      .others {
        color: red;
      }
    </style>
  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class=" content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">Issue a New Book</h4>
          </div>

        </div>
        <div class="row">
          <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
            <div class=" panel panel-info">
              <div class="panel-heading"> Issue a New Book </div>
              <div class="panel-body">
                <form role="form" method="post">
                  <div class="form-group">
                    <label>Student<span style="color:red;">*</span></label>
                    <select class="form-control" name="studentid" required="required">
                      <option value=""> Select a student </option>
                      <?php
                      $sql = "SELECT * from tblstudents where Status=1";

                      $query = $dbh->prepare($sql);
                      $query->execute();

                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                          $student_id = htmlentities($result->StudentId);
                          $student_name = htmlentities($result->FullName); ?>
                          <option value="<?php echo $student_id; ?>"><?php echo $student_id . ": " . $student_name; ?></option>
                      <?php }
                      } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Select Book Title</label>
                    <select class="form-control" name="bookid" required=" required">
                      <option value=""> Select a student </option>
                      <?php
                      $sql = "SELECT * from tblbooks where Available_Qty>0";
                      $query = $dbh->prepare($sql);
                      $query->bindParam(':status', $status, PDO::PARAM_STR);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                          $book_id = htmlentities($result->id);
                          $book_name = htmlentities($result->BookName);
                          $book_isbn = htmlentities($result->ISBNNumber); ?>
                          <option value="<?php echo $book_id; ?>"><?php echo $book_isbn . ": " . $book_name; ?></option>
                      <?php }
                      } ?>
                    </select>
                  </div>

                  <button id="issue" type="submit" name="issue" id="submit" class="btn btn-info"> Issue Book </button>
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