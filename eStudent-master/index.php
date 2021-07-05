<?php
include "inicijalizacija.php";
$prikaziPorukuGreske = false;
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $uspesno = $db->login($username,$password);
    if($uspesno){
        if($_SESSION['student'] != null){
            header("Location: profil.php");
        }
        if($_SESSION['korisnik'] != null){
            header("Location: administracija.php");
        }
    }else{
        $prikaziPorukuGreske = true;
    }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Studentska sluzba
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
          Studentska sluzba
        </a>
      </div>
    <?php include 'glavniMeni.php'; ?>

    <div class="main-panel" style="height: 100vh;">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="index.php">Logovanje</a>
          </div>
        </div>
      </nav>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <h3 class="description">Logovanje</h3>
          </div>
        </div>
          <div class="card-body">
              <?php
                if($prikaziPorukuGreske){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        <span><b> Greska - </b> Neuspesno logovanje, proverite vase podatke</span>
                    </div>
              <?php
                }
              ?>
              <form method="POST" action="">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" placeholder="Username" name="username">
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" placeholder="Password" name="password">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="update ml-auto mr-auto">
                          <button type="submit" name="login" class="btn btn-primary btn-round">Uloguj se</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
      <?php include 'footer.php'?>
    </div>
  </div>

  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>

</html>
