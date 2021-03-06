<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else if ($_SESSION['role'] == 'admin') {
  header('location:admin/dashboard.php');
} else {
  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "delete from tblbooks  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['delmsg'] = "Category deleted scuccessfully ";
    header('location:manage-books.php');
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
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
            <h4 class="header-line">Manage Issued Books</h4>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-heading tts"> List of Issued Books </div>

                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="tts">Book Title</th>
                          <th>ISBN </th>
                          <th class="tts">Issued Date</th>
                          <th class="tts">Return Date</th>
                          <th class="tts">Fine</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sid = $_SESSION['stdid'];
                        $sql = "SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $result) {
                        ?>
                            <tr class="odd gradeX">
                              <td class="center"> <?php echo htmlentities($cnt++); ?> </td>
                              <td class="center tts"> <?php echo htmlentities($result->BookName); ?> </td>
                              <td class="center"> <?php echo htmlentities($result->ISBNNumber); ?> </td>
                              <td class="center tts"> <?php echo htmlentities($result->IssuesDate); ?> </td>
                              <td class="center td-tts" alt="Returned date">
                                <?php if ($result->ReturnDate == "") { ?>
                                  <span style="color:red">
                                    <?php echo htmlentities("Books has not return Yet"); ?>
                                  </span>
                                <?php
                                } else {
                                  echo htmlentities($result->ReturnDate);
                                } ?>
                              </td>
                              <td class="center tts"> <?php echo htmlentities($result->fine); ?> </td>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=2iYwTISH"></script>
    <script src="assets/js/speaker.js"></script>
  </body>

  </html>
<?php } ?>