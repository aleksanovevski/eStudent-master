<?php
include "inicijalizacija.php";

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
            <a class="navbar-brand" href="grafik.php">Grafik</a>
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
              <div class="col-md-12">
                  <div class="card card-user">
                      <div class="card-header">
                          <h5 class="card-title">Grafik po prijavama - ocene</h5>
                      </div>
                      <div class="card-body">
                          <div id="piechart" style="width: 900px; height: 500px;"></div>
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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(postaviGrafik);
            
            function postaviGrafik() {
                $.ajax({
                    url: 'http://localhost/studentskasluzba/api/grafik',
                    success: function (data) {
                        let niz = [];
                        niz.push(['Ocena','Broj Prijava']);
                        let nizSaServera = data;
                        var i;
                        for (i = 0; i < nizSaServera.length; i++) {
                            niz.push([nizSaServera[i].ocena,parseInt(nizSaServera[i].brojPrijava)]);
                        }
                        drawChart(niz);
                    }
                })
            }

            function drawChart(niz) {

                var data = google.visualization.arrayToDataTable(niz);

                var options = {
                    title: 'Broj prijava po ocenama'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
</body>

</html>
