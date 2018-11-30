<div class = "wrap">
<form method="post" action="<?= admin_url( 'admin.php' ); ?>?page=wh_taxonomie">
  <div class="tablenav" style="margin-bottom: 10px">
    <div class="alignleft">
      <label for="postytes_choise">Choix du Custom Post Type</label>
      <select id="postytes_choise" class="postytes_choise" name="postes_choix">
        <?php foreach ( $postetypes as $postetype ) { ?>

          <option value="<?= $postetype->getId() ?>"><?= $postetype->getNom_post() ?></option>

        <?php } ?>
      </select>
    </div>
    <br class="clear">
    <div class="alignleft">
      <label for="taxo_choise">Nombre de taxonomie à ajouter</label>
      <select id="taxo_choise" class="taxo_choise" name="numbre_taxo">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
      <input type="submit" class="button action" value="Valider">
    </div>

  </div>

</form>
</div>
