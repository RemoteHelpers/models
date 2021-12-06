<?php
add_action('addStyle', function() {
    wp_register_style('my-style', get_template_directory_uri().'/css/cv.css', '', '0.01', false);
    wp_enqueue_style('my-style');
});
do_action( 'addStyle');

get_header() ;


$path = get_template_directory_uri();

$id = get_the_ID();

    $thumb_id = get_post_thumbnail_id($id);
    $image = wp_get_attachment_image_src($thumb_id,'slideBig');//  thumbnail, medium, large или full
    $imageThumb = $image[0];

    $imageSm = wp_get_attachment_image_src($thumb_id,'slideSmall');//  thumbnail, medium, large или full
    $imageThumbSm = $imageSm[0];

    $height = get_post_meta($id, 'height', true );
    $bust = get_post_meta($id, 'bust', true );
    $waist = get_post_meta($id, 'waist', true );
    $hips = get_post_meta($id, 'hips', true );
    $hair = get_post_meta($id, 'hair', true );
    $eyes = get_post_meta($id, 'eyes', true );
    $age = get_post_meta($id, 'age', true );

    $post = get_post( $id );

    $categories = get_terms( 'category' , [
    'orderby'           => 'name',
    'order'             => 'ASC',
    'hide_empty'        => false,
    'exclude'           => array(),
    'exclude_tree'      => array(),
    'include'           => array(),
    'fields'            => 'all',
    'slug'              => '',
    'parent'            => null,
    'hierarchical'      => false,
    'childless'         => false,
    'get'               => '',
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false,
    'offset'            => '',
    'search'            => '',
    'cache_domain'      => 'core'
] );

    $categoriesModel = wp_get_post_categories( $id );

    if ( get_post_meta( get_the_ID(), 'photos', false ) ){ //images название вашего произвольного поля
        $image_array = get_post_meta( get_the_ID(), 'photos', false ); //images название вашего произвольного поля
    }


?>

<div class="model-wr">

    <section class="model">
        <div class="madel-info-back"><a href="/catalog">Back to models</a></div>
        <div class="madel-info-tit mobile">
            <h1><?= stristr($post->post_title, '-', true)?></h1>  
        </div>
        <ul class="madel-info-cat mobile">
                <?php foreach ($categories as $category) : ?>

                <?php
                    if($category->term_id == 1 || $category->slug == 'nude' || $category->slug == 'topless') continue;

                    $isCat = false;
                    if (in_array($category->term_id, $categoriesModel)) {
                        $isCat = true;
                    }
                    ?>
<!--                    --><?php //$categoryLink = get_category_link($category->term_id) ?>
                    <?php $class = $isCat ? 'class="active-cat"': '' ?>
                    <li <?=$class?>><?=$category->name?></li>
                <?php endforeach; ?>

            </ul>
        <div class="model-video">
            <?php
            if ( $image_array ) {

                foreach ( $image_array as $image ) {

                    $fullimg = pods_image_url( $image['ID'], 'slideBig');

                    ?>
                    <video src="<?=$fullimg?>" autoplay controls class='video-player'></video>
            <?php
                }
            }
            ?>
        </div>
        
        <div class="madel-info">

            <div class="madel-info-tit">
                <h1 data-desc="Proffile"><?= stristr($post->post_title, '-', true)?>
                </h1>
            </div>
            <ul class="madel-info-cat">

                <?php foreach ($categories as $category) : ?>

                <?php
                    if($category->term_id == 1 || $category->slug == 'nude' || $category->slug == 'topless') continue;

                    $isCat = false;
                    if (in_array($category->term_id, $categoriesModel)) {
                        $isCat = true;
                    }
                    ?>
                    <?php $class = $isCat ? 'class="active-cat"': '' ?>
                    <li <?=$class?>><?=$category->name?></li>
                <?php endforeach; ?>
                <div class="madel-slide second_adaptive">
                    <?php
                    if ( $image_array ) {

                        foreach ( $image_array as $image ) {

                            $fullimg = pods_image_url( $image['ID'], 'slideBig');

                            ?>
                            <div><img src="<?=$fullimg?>" alt=""></div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </ul>
            <ul class="madel-info-list">
                <li><dl><dt>Height:</dt><dd><?=$height?>cm</dd></dl></li>
                <li><dl><dt>Bust:</dt><dd><?=$bust?>cm</dd></dl></li>
                <li><dl><dt>Waist:</dt><dd><?=$waist?>cm</dd></dl></li>
                <li><dl><dt>Hips:</dt><dd><?=$hips?>cm</dd></dl></li>
                <li><dl><dt>Hair:</dt><dd><?=$hair?></dd></dl></li>
                <li><dl><dt>Eyes:</dt><dd><?=$eyes?></dd></dl></li>
                <li><dl><dt>Age:</dt><dd><?=$age?></dd></dl></li>

            </ul>
            <div class="model__buttons">
                <a id="js-selected" data-id="<?=$id?>" href="#" class='model__btn add cart-button blue '>Add to list</a>
                <a id="orderNow" data-id="<?=$id?>" href="#" class='model__btn order cart-button'>Order now</a>
            </div>
        </div>
        
    </section>

    <section class="models-similar">
        <div class="models-similar-tit">
            <h2 data-desc="See also">Similar Models</h2>
        </div>
        <ul class="models-similar-list">
            <?php
            $related_tax = 'category';

            // получаем ID всех элементов (категорий, меток или таксономий), к которым принадлежит текущий пост
            $cats_tags_or_taxes = wp_get_object_terms( $id, $related_tax, array( 'fields' => 'ids' ) );

            // массив параметров для WP_Query
            $args = array(
                'posts_per_page' => 4, // сколько похожих постов нужно вывести,
                'post_type' => 'models', // тип записи "посты"
                'post_status' => 'publish',
                'post__not_in' => array( get_the_ID() ),
                'tax_query' => array(
                    array(
                        'taxonomy' => $related_tax,
                        'field' => 'id',
                        'include_children' => false, // нужно ли включать посты дочерних рубрик
                        'terms' => $cats_tags_or_taxes,
                        'operator' => 'IN' // если пост принадлежит хотя бы одной рубрике текущего поста, он будет отображаться в похожих записях, укажите значение AND и тогда похожие посты будут только те, которые принадлежат каждой рубрике текущего поста
                    )
                )
            );
            $misha_query = new WP_Query( $args );

            // если посты, удовлетворяющие нашим условиям, найдены
            if( $misha_query->have_posts() ) :

                // запускаем цикл
                while( $misha_query->have_posts() ) : $misha_query->the_post();
                    // в данном случае посты выводятся просто в виде ссылок

                    $idSimilar = get_the_ID();
                    $title = get_the_title();
                    $link = get_the_permalink();

                    $thumb_id = get_post_thumbnail_id($idSimilar);
                    $image = wp_get_attachment_image_src($thumb_id, 'similar');//
                    $image = $image[0];


                    ?>
                    <li class="models-similar-item">
                        <a href="<?=$link?>">
                            <div>
                                <img src="<?=$image?>" alt="<?=$title ?> ">
                                <h3 data-desc="view profile"><?=stristr($title, '-', true)?></h3>
                            </div>
                        </a>
                    </li>
                <?php
                endwhile;
            endif;

            // не забудьте про эту функцию, её отсутствие может повлиять на другие циклы на странице
            wp_reset_postdata();

            ?>

        </ul>
    </section>



</div>

<script src="<?=$path?>/js/slick.min.js"></script>
<script src="<?=$path?>/js/jquery.notifyBar.js"></script>
<?php
    get_footer();
?>


