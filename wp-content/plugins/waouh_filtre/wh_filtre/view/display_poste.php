<?php foreach ($posts as $post) :?>
  <?php
  if (wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0] != null) {
      $image_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0];
  } else {

   // $image_src = get_field("image_defaut");
  }


   ?>
    <a href="<?= $post->guid ?>"class="column is-narrow is-half wh_annuaire_element" >
            <div class=" box has-text-primary is-paddingless "  >
                <div class="image is-5by4 " >
                  <img class="wh_image" src="<?= $image_src ?>" >
                </div>
                <div class="wh_poste wh_annuaire_elem_content has-text-centered"
                     <?php if (get_post_meta($post->ID, '_wh_lng', true)): ?>

                         data-lat="<?= get_post_meta($post->ID, '_wh_lat', true); ?>" data-log="<?= get_post_meta($post->ID, '_wh_lng', true); ?>"

                     <?php endif; ?>
                     >

                    <p><?= $post->post_title ?></p> 
                    <?php if (get_post_meta($post->ID, '_ville', true)): ?>

                        <p><?= get_post_meta($post->ID, '_ville', true) ?></p>
                        <?php if (get_post_meta($post->ID, 'wh_prix', true)): ?>
                        <p><?= get_post_meta($post->ID, 'wh_prix', true) ?>€</p>

                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
    </a>
<?php endforeach; ?>
