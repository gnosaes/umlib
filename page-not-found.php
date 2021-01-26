<?php
$error = $_SERVER["REDIRECT_STATUS"];
$error = 404;
$error_title = '';
$error_mesasge = '';

if ($error == 500) {
    $error_title = "Well, this is unexpected...";
    $error_mesasge = "An error has occured and we're working to fix the problem!";
} else {
    $error_title = "Uh-oh, page not found...";
    $error_mesasge = "We can't seem to find the page you're looking for.<br>Try going back to the previous page or click the button below.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library Management System</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />

    <style>
        .wrapper {
            width: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            padding: 16px;
        }

        .wrapper img {
            max-width: 400px;
            width: 100%;
        }

        .wrapper button {
            border-radius: 40px;
            padding: 8px 20px;
            outline: none;
        }

        .wrapper h1 {
            margin: 20px 0;
            font-weight: 700;
        }
    </style>


</head>

<body>
    <div class="container">
        <div class="wrapper">
            <img src="./assets/img/undraw_Taken_re_yn20.svg">
            <h1> <?php echo $error_title ?> </h1>
            <h4> <?php echo $error_mesasge ?> </h4>

            <?php if ($error != 500) { ?>
                <button type="button" class="btn btn-info">Back to Home</button>
            <?php } ?>
        </div>
    </div>

    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

    <script>
        $('button').click(function() {
            document.location = 'index.php';
        });
    </script>
</body>

</html>