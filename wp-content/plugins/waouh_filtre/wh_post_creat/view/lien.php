

    <tr>
        <td>
            <strong>
                <a class = "row-title" href = "<?= admin_url(); ?>?page=wh_custom_post&action=edit&id=<?= $postetype->getId() ?>" ><?= $postetype->getNom_post() ?>
                </a>
            </strong>

            <div class = "row-actions">

                <a href = "<?= admin_url(); ?>?page=wh_custom_post&action=edit&id=<?= $postetype->getId() ?>">
                    Modifier
                </a>
                <a href = "<?= admin_url(); ?>?page=wh_custom_post&action=pre_delete&id=<?= $postetype->getId() ?>">
                    Supprimer
                </a>

            </div>
        </td>

    </tr>
