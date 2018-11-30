
<div class = "wrap">
    <h1 class = "wp-heading-inline"><?= get_admin_page_title() ?></h1>

    <a href = "<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=ajout_taxo_choix" class = "page-title-action">Ajouter</a>
    <hr class = "wp-header-end">


    <ul class = 'subsubsub'>
        <li class = 'all'>Tous </li>
    </ul>


    <table class = "wp-list-table widefat fixed striped pages">
        <thead>
            <tr>
                <th>
                    <span>Titre</span>
                </th>
            </tr>
        </thead>

        <tbody id = "the-list">
            <?php
            if (getTabTaxos()) {
                foreach (getTabTaxos() as $taxonomies) {
                    //taxonomies ajouter
                    foreach ($taxonomies as $taxonomie) {
                        ?>


                        <tr>
                            <td>
                                <strong>
                                    <a class = "row-title" href = "<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=edit&id=<?= $taxonomie->getId_taxo(); ?>" ><?= $taxonomie->getWh_nom_taxo() ?>
                                    </a>
                                </strong>

                                <div class = "row-actions">

                                    <a href = "<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=edit&id=<?= $taxonomie->getId_taxo(); ?>">
                                        Modifier
                                    </a>
                                    <a href = "<?= admin_url('admin.php'); ?>?page=wh_taxonomie&action=pre_delete&id_taxo=<?= $taxonomie->getId_taxo(); ?>&id_post_taxo=<?= $taxonomie->getId_post(); ?>">
                                        Supprimer
                                    </a>

                                </div>
                            </td>

                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>
