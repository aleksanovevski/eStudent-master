<?php
include "inicijalizacija.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://pixabay.com/api/?key=14926465-74241bc3696af1ce21b554643&q=student&image_type=photo');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$rez = curl_exec($ch);
$data = json_decode($rez);
var_dump($rez);
curl_close($ch);
$niz = $data->hits;
?>
<div class="row">
<?php
foreach ($niz as $slika){
    ?>
<div class="col-md-6">
    <img src="<?= $slika->largeImageURL ?>" class="img img-thumbnail">
</div>
<?php
}
?>
</div>
