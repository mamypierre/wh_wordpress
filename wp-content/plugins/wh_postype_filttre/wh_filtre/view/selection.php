<div class="wh_taxo_Selects <?= $indiceSelects ?>">
    <p hidden class="wh_taxonomySelects"><?= $filtre_taxo_objet->getTab_taxos()[0]->taxonomy; ?></p>
    <select id="wh_Selects" name="terms" multiple >
        <?php foreach ($filtre_taxo_objet->getTab_taxos() as $taxos) : ?>

            <option value="<?= $taxos->slug ?>" > <?= $taxos->name ?> </option>

        <?php endforeach; ?>
    </select>
</div>

