

<div class = "wrap">
    <h1 class = "wp-heading-inline"><?=get_admin_page_title();?></h1>
    <hr class = "wp-header-end">


    <ul class = 'subsubsub'>
        <li class = 'all'>Tous </li>
    </ul>


    <table class = "wp-list-table widefat fixed striped pages">
        <thead>
            <tr>
                <th scope = "col" id = 'title' class = 'manage-column column-title column-primary sortable desc'>
                    <span>Titre</span>
                </th>
            </tr>
        </thead>
    <?php if (tab_slug_post_type()) { ?>
        <tbody id = "the-list">
          <?php foreach (tab_slug_post_type() as $slug_post_type) {

              if (get_object_taxonomies($slug_post_type)) { ?>
                <tr>
                    <td>
                        <strong>
                            <a class = "row-title" href = "<?= admin_url('admin.php'); ?>?page=wh_short_filtre&action=taxo&postSlug=<?= $slug_post_type ?>" ><?= $slug_post_type ?>
                            </a>
                        </strong>
                    </td>
                </tr>
          <?php   } } ?>

        </tbody>
    <?php }?>
        <tfoot>

        </tfoot>
    </table>

</div>
