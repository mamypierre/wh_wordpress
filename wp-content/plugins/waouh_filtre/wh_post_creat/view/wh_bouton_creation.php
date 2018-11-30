
<div class="wrap">

  <form method="post" action="<?= admin_url(); ?>?page=wh_custom_post">
    <h1 class="wp-heading-inline"><?=get_admin_page_title()?></h1>
        <input type="hidden" name="creation" value="button"/>
        <button type="submit" class = "page-title-action" >Ajouter un Custom Post Type</button>
    </form>
  <ul class = 'subsubsub'>
    <li class = 'all'>Tous </li>
  </ul>
  <table class = "wp-list-table widefat fixed striped pages">
        <thead>
            <tr>
                <th >
                    <span>Titre</span>
                </th>
            </tr>
        </thead>

        <tbody id = "the-list">

          <?php
          if (getPostypes()) {
              foreach (getPostypes() as $postetype) {
                  include plugin_dir_path(__FILE__) . 'lien.php';
              }
          }
          ?>

        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>
