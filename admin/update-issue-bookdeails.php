<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else if ($_SESSION['role'] == 'student') {
  header('location:../dashboard.php');
} else {
  if (isset($_POST['return'])) {
    $rid = intval($_GET['rid']);
    $fine = $_POST['fine'];
    $rstatus = 1;
    $sql = "update tblissuedbookdetails set fine=:fine,RetrunStatus=:rstatus where id=:rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->bindParam(':fine', $fine, PDO::PARAM_STR);
    $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
    $query->execute();

    $_SESSION['msg'] = "Book Returned successfully";
    header('location:manage-issued-books.php');
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
    <script>
      // function for get student name
      function getstudent() {
        $("#loaderIcon").show();
        jQuery.ajax({
          url: "get_student.php",
          data: 'studentid=' + $("#studentid").val(),
          type: "POST",
          success: function(data) {
            $("#get_student_name").html(data);
            $("#loaderIcon").hide();
          },
          error: function() {}
        });
      }

      //function for book details
      function getbook() {
        $("#loaderIcon").show();
        jQuery.ajax({
          url: "get_book.php",
          data: 'bookid=' + $("#bookid").val(),
          type: "POST",
          success: function(data) {
            $("#get_book_name").html(data);
            $("#loaderIcon").hide();
          },
          error: function() {}
        });
      }
    </script>
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
            <h4 class="header-line">Edit Issued Book</h4>
          </div>

        </div>
        <div class="row">
          <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
            <div class=" panel panel-info">
              <div class="panel-heading"> Update Issued Book</div>
              <div class="panel-body">
                <form role="form" method="post">
                  <?php
                  $rid = intval($_GET['rid']);
                  $sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.RetrunStatus from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblissuedbookdetails.id=:rid";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                      <div class="form-group">
                        <label>Student Name &emsp;&emsp;&emsp;:</label>
                        <?php echo htmlentities($result->FullName); ?>
                      </div>

                      <div class="form-group">
                        <label>Book Title &emsp;&emsp;&emsp;&emsp;&emsp;:</label>
                        <?php echo htmlentities($result->BookName); ?>
                      </div>


                      <div class="form-group">
                        <label>ISBN &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:</label>
                        <?php echo htmlentities($result->ISBNNumber); ?>
                      </div>

                      <div class="form-group">
                        <label>Book Issued Date &emsp;&nbsp;&nbsp;:</label>
                        <?php echo htmlentities($result->IssuesDate); ?>
                      </div>


                      <div class="form-group">
                        <label>Book Returned Date :</label>
                        <?php if ($result->ReturnDate == "") {
                          echo htmlentities("Not Return Yet");
                        } else {
                          echo htmlentities($result->ReturnDate);
                        }
                        ?>
                      </div>

                      <div class="form-group">
                        <label>Fine &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:</label>
                        <?php
                        if ($result->fine == "") { ?>
                          <input class="form-control" type="text" name="fine" id="fine" required />
                        <?php } else {
                          echo htmlentities($result->fine);
                        }
                        ?>
                      </div>
                      <?php if ($result->RetrunStatus == 0) { ?>
                        <button type="submit" name="return" id="submit" class="btn btn-info">Update</button>
                  <?php }
                    }
                  } ?>
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