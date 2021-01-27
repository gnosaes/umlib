<?php
require_once("includes/config.php");
if (isset($_GET["bookid"])) {
    $bookid = $_GET["bookid"];
    $sql = "SELECT Quantity FROM tblbooks WHERE (ISBNNumber=:bookid)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    if ($query > 0) {
        echo "<span style='color:red'>The book is not available to be issued</span>";
        echo "<script>$('#issue').prop('disabled',true);</script>";
    } else {
        echo "<script>$('#issue').prop('disabled',false);</script>";
    }
}
