<?php foreach ($posts as $post) : ?>
    <a href="<?= $post->guid ?>" >
        <div class="column is-narrow image is-277x220"  >
            <div class=" box has-text-primary is-paddingless " style="width: 277px ; height: 330px;" >
                <div class="image is-277x231 "style="height: 70%;" >
                    <div  ><img class="wh_image" src="<?= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0]; ?>" ></div>
                </div>
                <div class="wh_poste" 
                     <?php if (get_post_meta($post->ID, '_wh_lng', true)): ?>

                         data-lat="<?= get_post_meta($post->ID, '_wh_lat', true); ?>" data-log="<?= get_post_meta($post->ID, '_wh_lng', true); ?>"

                     <?php endif; ?>
                     >  

                    <?= $post->post_title ?> 
                    <?php if (get_post_meta($post->ID, '_ville', true)): ?>

                        <p><?= get_post_meta($post->ID, '_ville', true) ?></p>
                        <p> prix : <?= get_post_meta($post->ID, '_wh_prix', true) ?></p>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </a>
<?php endforeach; ?>