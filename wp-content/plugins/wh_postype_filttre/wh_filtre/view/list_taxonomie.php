
<form method="post" action="<?= admin_url('admin.php'); ?>?page=wh_short_filtre&action=register" id="display_filtre" >

    <div> <h4 > liste des taxonomie </h4> </div>

    <input type="hidden" name="taxoNames" value="<?= $name_taxo; ?>">
    <input type="hidden" name="postName" value="<?= $postName; ?>">
    <?php foreach ($taxos as $taxo) :   ?>
        <?php /* recuper le Taxonomie */ $taxo_exist = get_taxonomy($taxo) ?>
    
        <label for="taxoList"> <p> <?= $taxo_exist->label ?> </p> </label>
        <select name="<?= $taxo ?>" id="taxoList" form="display_filtre" >
            <option value="">none</option>
            <option value="checkbox">checkbox</option>
            <option value="select">select</option>
            <option value="champ_recherche">champ de recherche</option>
        </select>
    <?php endforeach; ?>
    <div class="wh_button_valid"> <?php submit_button('valider'); ?> </div>