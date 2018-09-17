

<div class="wh_taxo_display <?= $indiceCheck ?> ">
    <p hidden class="wh_taxonomyCheck"><?= $filtre_taxo_objet->getTab_taxos()[0]->taxonomy ; ?></p>
    <?php foreach ($filtre_taxo_objet->getTab_taxos() as $taxos) : ?>

        <div class="wh_checkbox" >  
            <input type="checkbox" name="terms" value="<?= $taxos->slug ?>" class="wh_check" > <p> <?= $taxos->name ?> </p>
        </div>

    <?php endforeach; ?>
</div>