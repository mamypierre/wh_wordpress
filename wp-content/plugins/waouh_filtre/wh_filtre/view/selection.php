<div class="wh_taxo_Selects" wh_taxonomySelects="<?= $filtre_taxo_objet->getSlug_taxo(); ?>" >

    <select class="wh_Selects" name="terms" multiple  style="width:100% " >
        <?php foreach ($filtre_taxo_objet->getTab_taxos() as $taxos) : ?>

            <option value="<?= $taxos->slug ?>" > <?= $taxos->name ?> </option>

        <?php endforeach; ?>
    </select>
</div>

