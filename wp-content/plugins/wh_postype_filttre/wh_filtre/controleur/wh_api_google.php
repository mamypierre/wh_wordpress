
<?php 
if(isset($_POST['ajout_api']) && $_POST['ajout_api']){

     update_option(WH_GOOGLE, esc_html($_POST['ajout_api']));
}
$api_google = get_option(WH_GOOGLE);?>

<div>
    <div class="ajout_api_titre">
        <h4> collez votre api google </h4>
    </div>
    <div class="ajout_api">
        <form action="" method="post" >
            <input value="<?= $api_google ?>" name="ajout_api"  >
            <?php submit_button('ok') ?>
        </form>
    </div>
</div>
