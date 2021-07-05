<?php
include "inicijalizacija.php";
$rokovi = $db->vratiRokove();
$predmeti = $db->vratiPredmete();
$poruka = "";
if(isset($_POST['unos'])){
    $brojIndeksa = $_POST['brojIndeksa'];
    $rokID = $_POST['rok'];
    $predmetID = $_POST['predmet'];

    $uspesno = $db->unesiPrijavu($brojIndeksa,$rokID,$predmetID);

    if($uspesno){
        header("Location: mojePrijave.php");
    }else{
        $poruka = "Neuspesna prijava";
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
            <a class="navbar-brand" href="novaPrijava.php">Nova prijava</a>
          </div>
        </div>
      </nav>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Nova prijava</h4>
                            <?php
                            if($poruka != ''){
                                ?>
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                    </button>
                                    <span><?php echo $poruka; ?></span>
                                </div>
                                <?php
                            }
                            ?>
                            <form method="post" action="">
                                <input type="hidden" value="<?php echo $_SESSION['student']->brojIndeksa; ?>" name="brojIndeksa">

                                <label>Izaberi rok za prijavu</label>
                                <select name="rok" class="form-control">
                                    <?php
                                        foreach ($rokovi as $rok){
                                            ?>
                                        <option value="<?= $rok->rokID ?>"><?= $rok->nazivRoka ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <label>Izaberi predmet za prijavu</label>
                                <select name="predmet" class="form-control">
                                    <?php
                                    foreach ($predmeti as $predmet){
                                        ?>
                                        <option value="<?= $predmet->predmetID ?>"><?= $predmet->nazivPredmeta ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button type="submit" name="unos" class="btn btn-primary btn-round">Unesi prijavu</button>
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

  <script>
      function pretrazi() {
          var rokID = $("#pretraga").val();
          var brojIndeksa = $("#brojIndeksa").val();

          $.ajax({
              url: 'pretragaPrijava.php',
              data: {
                  rokID : rokID,
                  brojIndeksa : brojIndeksa
              },
              success: function (data) {
                  $("#prijave").html(data);
              }
          });
      }
  </script>
</body>

</html>
