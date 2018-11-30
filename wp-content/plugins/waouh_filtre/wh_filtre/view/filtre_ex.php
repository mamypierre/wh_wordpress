


    <?php foreach ($tab_tax_query as $filtre_ex) : ?>
      <?php if ($filtre_ex!='AND'): ?>
        <div hidden class="wh_taxo_display" wh_taxonomy="<?= $filtre_ex['taxonomy'];?>" >
                <div hidden class="wh_checkbox" >
                    <label hidden class="checkbox">
                        <input hidden checked type="checkbox" name="terms" value="<?= $filtre_ex['terms'][0] ?>" class="wh_check ex" >
                    </label>
                </div>
        </div>
      <?php endif; ?>

  <?php endforeach; ?>
