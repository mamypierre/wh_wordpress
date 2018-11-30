

<div  class="wh_taxo_display columns is-multiline" wh_taxonomy="<?= $filtre_taxo_objet->getSlug_taxo();?>" >
    <?php foreach ($filtre_taxo_objet->getTab_taxos() as $taxos) :  ?>

        <div class="wh_checkbox column is-6" >
            <label class="checkbox">
                <input type="checkbox" name="terms" value="<?= $taxos->slug ?>" class="wh_check" ><?= $taxos->name ?>
            </label>
        </div>

    <?php endforeach; ?>
</div>
