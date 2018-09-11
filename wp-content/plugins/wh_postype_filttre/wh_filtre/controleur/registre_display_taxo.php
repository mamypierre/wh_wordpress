<?php

$tabTaxoNames = explode(',', $_POST['taxoNames']);

foreach ($tabTaxoNames as $taxoName) {


    //enregistrement des option des des taxo
    update_option($taxoName, $_POST[$taxoName]);
}

echo 'bien enregister <br>';
