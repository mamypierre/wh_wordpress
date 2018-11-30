<?php

$tabTaxoNames = explode(',', $_POST['taxoNames']);

foreach ($tabTaxoNames as $taxoName) {


    //enregistrement des option des des taxo
    update_option($taxoName, $_POST[$taxoName]);
} ?>

<div id="message" class="updated notice is-dismissible">
  <p>Bien enregisté</p>
  <button type="button" class="notice-dismiss">
      <span class="screen-reader-text">Ne pas tenir compte de ce message.</span>
  </button>
</div>
