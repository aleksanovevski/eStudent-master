<?php

if($_SESSION['student'] != null){
    include 'studentMeni.php';
}elseif ($_SESSION['korisnik'] != null){
    include 'korisnikMeni.php';
}else{
    ?>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="active ">
                <a href="index.php">
                    <i class="nc-icon nc-bank"></i>
                    <p>Logovanje</p>
                </a>
            </li>
        </ul>
    </div>
    </div>
<?php
}