<form method="post" action="">
    <div class="creation_choise_taxo">
        <div class="postytes_choise_bloc">
            <label for="postytes_choise"> choix de custom poste </label>
            <select id="postytes_choise"class="postytes_choise" name="postes_choix">
                <?php foreach ($postetypes as $postetype) { ?>

                    <option> <?= $postetype->getId(), ' '.$postetype->getNom_post() ?> </option>

                <?php } ?>
            </select>
        </div>
        <div class="taxo_choise_bloc">
            <label for="taxo_choise"> nombre de taxo a cree </label>
            <select id="taxo_choise" class="taxo_choise" name="numbre_taxo">
                <option> 1 </option>
                <option> 2 </option>
                <option> 3 </option>
            </select>
            <?php submit_button('ajouter un custom taxo'); ?>
        </div>
    </div>
</form>


