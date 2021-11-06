<?php
get_header() ;

?>

<section class="catalog">
    <div class="catalog-tit">
        <h1 data-desc="Our best models">Aviable Models</h1>
    </div>
    <ul class="catalog-list">
        <?php
                $models = get_posts([
                    'numberposts' => 20,
                    'post_type' => 'models',
                    'post_status' => 'publish'
                ]);

        ?>

        <?php foreach ($models as $model) : ?>

            <?php
            $id = $model->ID;

            $thumb_id = get_post_thumbnail_id($model->ID);
            $image = wp_get_attachment_image_src($thumb_id,'catalog');//
            $image = $image[0];

            $link = get_permalink($id);

            $height = get_post_meta($id, 'height', true );
            $bust = get_post_meta($id, 'bust', true );
            $waist = get_post_meta($id, 'waist', true );
            $hips = get_post_meta($id, 'hips', true );
            $hair = get_post_meta($id, 'hair', true );
            $eyes = get_post_meta($id, 'eyes', true );
            $age = get_post_meta($id, 'age', true );

            ?>

            <li class="catalog-item">
                <a href="<?=$link?>">
                    <div>
                        <img src="<?=$image?>" alt="<?= stristr($model->post_title, '-', true)?>">
                        <ul>
                            <li><dl><dt>Height:</dt><dd><?=$height?>cm</dd></dl></li>
                            <li><dl><dt>Bust:</dt><dd><?=$bust?>cm</dd></dl></li>
                            <li><dl><dt>Waist:</dt><dd><?=$waist?>cm</dd></dl></li>
                            <li><dl><dt>Hips:</dt><dd><?=$hips?>cm</dd></dl></li>
                            <li><dl><dt>Hair:</dt><dd><?=$hair?></dd></dl></li>
                            <li><dl><dt>Eyes:</dt><dd><?=$eyes?></dd></dl></li>
                            <li><dl><dt>Age:</dt><dd><?=$age?></dd></dl></li>
                        </ul>
                    </div>
                    <p><?= stristr($model->post_title, '-', true)?> <span>ID:<?=$id?></span></p>
                </a>
            </li>

        <?php endforeach; ?>

    </ul>
    <nav class="pagination">
        <a id="more-catalog" href="#">More models</a>
    </nav>
</section>

<?php
get_footer();