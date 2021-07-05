<?php
include "inicijalizacija.php";
$poruka = "";
$porukaOcena = "";
$klasaPoruke = "alert alert-warning alert-dismissible fade show";
if(isset($_POST['izmenaOcene'])){
    $prijava = $_POST['prijava'];
    $ocena = $_POST['ocena'];

    $uspesno = $db->promeniOcenu($prijava,$ocena);

    $porukaOcena = "Uspesno promenjena ocena";
    $klasaPoruke = "alert alert-success alert-dismissible fade show";
}

if(isset($_POST['unosStudenta'])){
    $brojIndeksa = $_POST['brojIndeksa'];
    $imePrezime = $_POST['imePrezime'];
    $godina = $_POST['godina'];
    $grad = $_POST['grad'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $uspesno = $db->unseiStudenta($brojIndeksa,$imePrezime,$godina,$grad,$username,$password);

    $poruka = "Uspesno unet student";
    $klasaPoruke = "alert alert-success alert-dismissible fade show";
}

$curl = curl_init("http://localhost/studentskasluzba/api/prijaveNI");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$jsonOdgovor = curl_exec($curl);
$prijave = json_decode($jsonOdgovor);
curl_close($curl);
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
            <a class="navbar-brand" href="profil.php">Administracija</a>
          </div>
        </div>
      </nav>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <h3 class="description">Ulogovani korisnik - <?php echo $_SESSION['korisnik']->imePrezimeKorisnika ?></h3>
          </div>
        </div>
          <div class="row">
              <div class="col-md-6">
                  <div class="card card-user">
                      <div class="card-header">
                          <h5 class="card-title">Unesi ocenu</h5>
                      </div>
                      <div class="card-body">
                          <?php
                          if($porukaOcena != ''){
                              ?>
                              <div class="<?php echo $klasaPoruke ?>">
                                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                      <i class="nc-icon nc-simple-remove"></i>
                                  </button>
                                  <span><?php echo $porukaOcena; ?></span>
                              </div>
                              <?php
                          }
                          ?>
                          <form method="post" action="">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Izaberi prijavu</label>
                                          <select name="prijava" class="form-control">
                                              <?php
                                              foreach ($prijave as $prijava){
                                                  ?>
                                                  <option value="<?= $prijava->id ?>"><?= $prijava->nazivRoka . " " . $prijava->imePrezime . " " . $prijava->nazivPredmeta ?></option>
                                                  <?php
                                              }
                                              ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Ocena</label>
                                          <select name="ocena" class="form-control">
                                              <option value="5">5</option>
                                              <option value="6">6</option>
                                              <option value="7">7</option>
                                              <option value="8">8</option>
                                              <option value="9">9</option>
                                              <option value="10">10</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="update ml-auto mr-auto">
                                      <button type="submit" name="izmenaOcene" class="btn btn-primary btn-round">Promeni ocenu</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="card card-user">
                      <div class="card-header">
                          <h5 class="card-title">Unos studenta</h5>
                      </div>
                      <div class="card-body">
                          <?php
                          if($poruka != ''){
                              ?>
                              <div class="<?php echo $klasaPoruke ?>">
                                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                      <i class="nc-icon nc-simple-remove"></i>
                                  </button>
                                  <span><?php echo $poruka; ?></span>
                              </div>
                              <?php
                          }
                          ?>
                          <form method="post" action="">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Broj indeksa</label>
                                          <input type="text" class="form-control"  placeholder="Broj indeksa" name="brojIndeksa">
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Ime i prezime</label>
                                          <input type="text" class="form-control"  placeholder="Ime i prezime studenta" name="imePrezime">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Godina upisa</label>
                                          <input type="number" class="form-control"  placeholder="Godina upisa" name="godina">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Grad</label>
                                          <input type="text" class="form-control"  placeholder="Grad" name="grad">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Username</label>
                                          <input type="text" class="form-control"  placeholder="Username" name="username">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Password</label>
                                          <input type="password" class="form-control"  placeholder="Password" name="password">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="update ml-auto mr-auto">
                                      <button type="submit" name="unosStudenta" class="btn btn-primary btn-round">Unesi studenta</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
      </div>
          <div id="vebStudenti" class="row">
          </div>
      </div>

        <?php include 'footer.php'?>
  </div>

  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>

    <script>
        $.ajax({
            url: 'webServisStudent.php',
            success: function (data) {
                $("#vebStudenti").html(data);
            }
        });
    </script>
</body>

</html>
