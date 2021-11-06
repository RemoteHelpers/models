<?php

get_header() ;

$category = get_queried_object();


?>

<section class="catalog">
    <div class="catalog-tit">
        <h1 data-desc="Our best models"><?=$category->name?></h1>
    </div>
    <ul class="catalog-list">
<?php

$arg_posts =  array(
    'orderby'      => 'name', // сортировка по имени
    'order'        => 'ASC', // от меньшего к большему
    'numberposts' => 9, // по три поста
    'post_type' => 'models', // тип записи "посты"
    'post_status' => 'publish', // опубликованные посты
    'cat' => $category->term_id, // получаем id рубрик
);
$query = new WP_Query($arg_posts);

if ( $query->have_posts() ) {

    while ( $query->have_posts() ) {
        $query->the_post();

        $id = get_the_ID();
        $title = get_the_title();
        $link = get_the_permalink();

        $thumb_id = get_post_thumbnail_id($id);
        $image = wp_get_attachment_image_src($thumb_id,'catalog');//
        $image = $image[0];

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
                    <img src="<?=$image?>" alt="<?=stristr($title, '-', true)?>">
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
                <p><?=stristr($title, '-', true)?></p>
            </a>
        </li>
        <?php }//while ?>

<?php
} else {

   echo "<h3>There are currently no models in this category. You can <a href='/catalog'>choose from currently available</a> or <a href='#'>contact us</a> to help you find the options that are right for you.</h3>";
}
//?>
</ul>


</section>
<?php get_footer() ?>


