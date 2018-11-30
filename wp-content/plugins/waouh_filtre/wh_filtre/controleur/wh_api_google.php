
<?php
if(isset($_POST['ajout_api']) && $_POST['ajout_api']){

     update_option(WH_GOOGLE, esc_html($_POST['ajout_api']));
}
$api_google = get_option(WH_GOOGLE);?>

<div class="wrap">
        <h1 class="wp-heading-inline"><?=get_admin_page_title()?></h1>
    <div class="ajout_api">
        <form action="" method="post" >
            <input class="regular-text"  value="<?= $api_google ?>" name="ajout_api"  >
            <?php submit_button('Valider') ?>
        </form>
    </div>
</div>
