<div class=""> <a href="<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=edit&id=<?= $taxonomie->getId_taxo() ; ?>" > <?= $taxonomie->getWh_nom_taxo() ?></a> </div>
<div class="" > <a href="<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=pre_delete&id_taxo=<?= $taxonomie->getId_taxo() ; ?>&id_post_taxo=<?= $taxonomie->getId_post() ; ?>">suprimer</a> </div>

