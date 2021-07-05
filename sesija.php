<?php

session_start();

if(!isset($_SESSION['student'])){
    $_SESSION['student'] = null;
}
if(!isset($_SESSION['korisnik'])){
    $_SESSION['korisnik'] = null;
}