<head>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <link href="assets/css/style.css" rel="stylesheet" />
  <script src="assets/js/sidebar.js"></script>
  <script src="assets/js/toggle.js"></script>
</head>

<body>
  <b class="screen-overlay"></b>

  <aside class="offcanvas offcanvas-right" id="my_offcanvas2">
    <header class="p-4 bg-light border-bottom">
      <button class="btn btn-default btn-close" style="padding:10px; margin-top:10px"> &times Close </button>
      <h6 class="mb-0" style="font-size: medium;font-weight:bold; padding:20px; ">Toggle Voice Assistance</h6>
    </header>
    <div class="alert alert-success" style="margin:20px">
      <a href="#" class="alert-link">enable toggle voice assistance here</a>
    </div>

    <div class="row text-center">
      <div class="col-12">
        <form method="post" id="toggleForm">
          <fieldset>
            <legend>On/Off Voice Assistance</legend>
            <div class="form-group">
              <div class="custom-control custom-switch ">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name='machine_state'>
                <label class="custom-control-label" id="statusText" for="customSwitch1"></label>
              </div>
            </div>
          </fieldset>
        </form>
        <p class="text-center" id="updatedAt">Last updated at: </p>
      </div>
    </div>
  </aside>

  <button data-trigger="#my_offcanvas2" class="btn btn-primary tts-toggle-button" type="button">
    <i class="fa fa-wheelchair" style="font-size:30px; margin:5px; "></i>
  </button>

  <div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand">
          <img src="assets/img/logo_white.png" />
        </a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
    </div>
  </div>
  <!-- LOGO HEADER END-->
  <?php if (strlen($_SESSION['login']) > 0) { ?>
    <section class="menu-section">
      <div class="container">
        <div class="row ">
          <div class="col-md-12">
            <div class="navbar-collapse collapse ">
              <ul id="menu-top" class="nav navbar-nav navbar-right">
                <li><a href="dashboard.php" class="menu-top-active a-tts">Dashboard</a></li>
                <li><a href="issued-books.php" class="menu-top-active a-tts">Issued Book</a></li>
                <li><a href="my-profile.php" class="menu-top-active a-tts">Profile</a></li>
                <li><a href="change-password.php" class="menu-top-active a-tts">Change Password</a></li>
                <li><a href="logout.php" class="btn-tts">Log out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } else { ?>
    <section class="menu-section">
      <div class="container">
        <div class="row ">
          <div class="col-md-12">
            <div class="navbar-collapse collapse ">
              <ul id="menu-top" class="nav navbar-nav navbar-right">
                <li><a href="adminlogin.php">Admin Login</a></li>
                <li><a href="signup.php" class="a-tts"> Signup </a></li>
                <li><a href="index.php" class="a-tts"> Login </a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>