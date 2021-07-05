<?php
include 'inicijalizacija.php';
$brojIndeksa = $_GET['brojIndeksa'];
$rokID = $_GET['rokID'];

$prijave = $db->vratiPrijavePretraga($brojIndeksa,$rokID);

?>


<div class="table-responsive">
    <table class="table">
        <thead class=" text-primary">
        <th>
            Student
        </th>
        <th>
            Predmet
        </th>
        <th>
            Rok
        </th>
        <th class="text-right">
            Ocena
        </th>
        </thead>
        <tbody>
        <?php
            foreach ($prijave as $prijava) {
                ?>
                <tr>
                    <td>
                        <?php echo $prijava->imePrezime ?>
                    </td>
                    <td>
                        <?php echo $prijava->nazivPredmeta ?>
                    </td>
                    <td>
                        <?php echo $prijava->nazivRoka ?>
                    </td>
                    <td class="text-right">
                        <?php echo $prijava->ocena ?>
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
</div>
