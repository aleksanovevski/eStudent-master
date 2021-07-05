<?php
include "inicijalizacija.php";
$poruka = "";
$klasaPoruke = "alert alert-warning alert-dismissible fade show";
if(isset($_POST['promenaSifre'])){
    $novaSifra = $_POST['novaSifra'];
    $staraSifra = $_POST['staraSifra'];
    $potvrdiSifru = $_POST['potvrdaSifra'];

    if($staraSifra != $_SESSION['student']->password){
        $poruka = "Niste uneli vasu ispravnu staru sifru";
    }
    if($novaSifra != $potvrdiSifru){
        $poruka = "Nove sifre se razlikuju, molimo vas da unesete iste sifre";
    }

    if($poruka == ""){
        $uspesno = $db->promeniSifru($novaSifra,$_SESSION['student']->brojIndeksa);
        $poruka = "Uspesno promenjena sifra";
        $klasaPoruke = "alert alert-success alert-dismissible fade show";
    }
}

if(isset($_POST['upload'])) {
    $dir = "assets/img/";
    $target_file = $dir . basename($_FILES["novaSLika"]["name"]);

    if (move_uploaded_file($_FILES["novaSLika"]["tmp_name"], $target_file)) {
        $db->promeniSliku(basename($_FILES["novaSLika"]["name"]), $_SESSION['student']->brojIndeksa);
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
            <a class="navbar-brand" href="profil.php">Moj profil</a>
          </div>
        </div>
      </nav>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <h3 class="description">Studentski profil - <?php echo $_SESSION['student']->imePrezime ?></h3>
          </div>
        </div>
          <div class="row">
              <div class="col-md-4">
                  <div class="card card-user">
                      <div class="image">
                          <img src="assets/img/knjige.jpg" alt="...">
                      </div>
                      <div class="card-body">
                          <div class="author">
                              <a href="#">
                                  <?php if($_SESSION['student']->slika == '') { ?>
                                      <img class="avatar border-gray" src="assets/img/profil.jpg" alt="...">
                                      <?php
                                  }else{
                                      ?>
                                      <img class="avatar border-gray" src="assets/img/<?php echo $_SESSION['student']->slika ?>" alt="...">
                                      <?php
                                  }
                                  ?>
                                  <h5 class="title"><?php echo $_SESSION['student']->imePrezime ?> (<?php echo $_SESSION['student']->brojIndeksa ?>)</h5>
                              </a>
                              <p class="description">
                                  <?php echo $_SESSION['student']->grad ?>
                              </p>
                          </div>
                          <p class="description text-center">
                             Godina upisa:  <?php echo $_SESSION['student']->godinaUpisa ?>
                          </p>
                          <form method="post" action="" enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Nova slika</label>
                                          <input type="file" class="form-control"  placeholder="Nova slika za profil" name="novaSLika">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="update ml-auto mr-auto">
                                      <button type="submit" name="upload" class="btn btn-primary btn-round">Promeni sliku profila</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-md-8">
                  <div class="card card-user">
                      <div class="card-header">
                          <h5 class="card-title">Promeni sifru</h5>
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
                                          <label>Stara sifra</label>
                                          <input type="password" class="form-control"  placeholder="Stara sifra" name="staraSifra">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Nova sifra</label>
                                          <input type="password" class="form-control"  placeholder="Nova sifra" name="novaSifra">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Potvrdi sifru</label>
                                          <input type="password" class="form-control"  placeholder="Potvrdi sifru" name="potvrdaSifra">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="update ml-auto mr-auto">
                                      <button type="submit" name="promenaSifre" class="btn btn-primary btn-round">Promeni sifru</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
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
</body>

</html>
