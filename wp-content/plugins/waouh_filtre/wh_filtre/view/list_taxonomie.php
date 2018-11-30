
<div class = "wrap">
<form method="post" action="<?= admin_url('admin.php'); ?>?page=wh_short_filtre&action=register" id="display_filtre" >
<div class="tablenav">
    <div> <h1 class = "wp-heading-inline">Liste des taxonomies</h1> </div>
    <hr class = "wp-header-end">

    <input type="hidden" name="taxoNames" value="<?= $name_taxo; ?>">
    <input type="hidden" name="postName" value="<?= $postName; ?>">
    <?php foreach ($taxos as $taxo) :   ?>
        <?php /* recuper le Taxonomie */ $taxo_exist = get_taxonomy($taxo) ?>
        <div class="alignleft">
        <label for="taxoList"> <p> <?= $taxo_exist->label ?> </p> </label>
        <select name="<?= $taxo ?>" id="taxoList" form="display_filtre" >
            <option  value="">Aucun</option>
            <option <?php if (get_option($taxo)=='checkbox') :?> selected <?php endif ?> value="checkbox">Checkbox</option>
            <option <?php if (get_option($taxo)=='select') :?> selected <?php endif ?> value="select">Menu déroulant à choix multiple</option>
            <option <?php if (get_option($taxo)=='champ_recherche') :?> selected <?php endif ?>  value="champ_recherche">Champ de recherche</option>
        </select>
        </div>
    <?php endforeach; ?>
    <br class="clear">
    <br class="clear">
    <input type="submit" class="button action" value="Valider">
  </form>
</div>
