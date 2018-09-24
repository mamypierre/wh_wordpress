<?php foreach ($posts as $post) : ?>
    <div class="wh_poste" 
         <?php if (get_post_meta($post->ID, '_wh_lng', true)): ?>

             data-lat="<?= get_post_meta($post->ID, '_wh_lat', true); ?>" data-log="<?= get_post_meta($post->ID, '_wh_lng', true); ?>"

         <?php endif; ?>
         >  

        <?= $post->post_content ?> 
        <?php if (get_post_meta($post->ID, '_ville', true)): ?>

            <p><?= get_post_meta($post->ID, '_ville', true) ?></p>

    <?php endif; ?>

    </div>
<?php endforeach; ?>

