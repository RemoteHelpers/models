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
    $about = get_post_meta($id, 'about', true );

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

            <div class="madel-info">
            <div class="madel-info-back"><a href="/catalog">Back to models</a></div>
            <div class="madel-info-tit">
                <h1 data-desc="Proffile"><?= stristr($post->post_title, '-', true)?>
                </h1>
                <a id="js-selected" data-id="<?=$id?>" href="#" class='add_to_list_heart'>
                <svg width="46" height="41" viewBox="0 0 46 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M44.8871 8.40214C44.1734 6.75794 43.1442 5.26798 41.8573 4.01567C40.5695 2.75962 39.051 1.76146 37.3846 1.07546C35.6566 0.361301 33.8033 -0.00424759 31.9321 3.72366e-05C29.3071 3.72366e-05 26.7459 0.715222 24.5202 2.06613C23.9877 2.38928 23.4819 2.74423 23.0026 3.13096C22.5234 2.74423 22.0176 2.38928 21.4851 2.06613C19.2594 0.715222 16.6982 3.72366e-05 14.0731 3.72366e-05C12.1829 3.72366e-05 10.3512 0.360279 8.62066 1.07546C6.94871 1.76416 5.44183 2.75482 4.14793 4.01567C2.85934 5.26656 1.82998 6.75688 1.11818 8.40214C0.378053 10.1133 0 11.9304 0 13.8005C0 15.5646 0.362079 17.4029 1.08091 19.2729C1.6826 20.8358 2.5452 22.4568 3.64741 24.0938C5.3939 26.6844 7.79534 29.3862 10.7772 32.1251C15.7185 36.6652 20.6119 39.8014 20.8195 39.9285L22.0815 40.7338C22.6406 41.0887 23.3594 41.0887 23.9185 40.7338L25.1804 39.9285C25.3881 39.7961 30.2762 36.6652 35.2228 32.1251C38.2046 29.3862 40.606 26.6844 42.3525 24.0938C43.4547 22.4568 44.3227 20.8358 44.919 19.2729C45.6379 17.4029 45.9999 15.5646 45.9999 13.8005C46.0053 11.9304 45.6272 10.1133 44.8871 8.40214Z" fill="#F02424"/>
                </svg>


                </a>
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
<div class="mdl__descriotion">
    <p><?=$about?></p>
</div>
<ul class="mdl__spec_info">
    <li class="li">
        <div>Height:</div>
        &nbsp;
        <p><?=$height?>cm</p>
    </li>
    <li class="li">
        <div>Bust:</div>
        &nbsp;
        <p><?=$bust?>cm</p>
    </li>
    <li class="li">
        <div>Waist:</div>
        &nbsp;
        <p><?=$waist?>cm</p>
    </li>
    <li class="li">
        <div>Hips:</div>
        &nbsp;
        <p><?=$hips?>cm</p>
    </li>
    <li class="li">
        <div>Age:</div>
        &nbsp;
        <p><?=$age?>cm</p>
    </li>
</ul>
<!-- <ul class="madel-info-list">
    <li><dl><dt>Height:</dt><dd><?=$height?>cm</dd></dl></li>
    <li><dl><dt>Bust:</dt><dd><?=$bust?>cm</dd></dl></li>
    <li><dl><dt>Waist:</dt><dd><?=$waist?>cm</dd></dl></li>
    <li><dl><dt>Hips:</dt><dd><?=$hips?>cm</dd></dl></li>
    <li><dl><dt>Hair:</dt><dd><?=$hair?></dd></dl></li>
    <li><dl><dt>Eyes:</dt><dd><?=$eyes?></dd></dl></li>
    <li><dl><dt>Age:</dt><dd><?=$age?></dd></dl></li>

</ul> -->
<div class="model__buttons">
    <!-- <a id="orderNow" data-id="<?=$id?>" href="#" class='model__btn order cart-button'>Order now</a> -->
    <a id="orderNow" data-id="<?=$id?>" href="#" class='add_to_list_order'>
        <span class="plus"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M28.8 0H1.2C0.53625 0 0 0.53625 0 1.2V28.8C0 29.4638 0.53625 30 1.2 30H28.8C29.4638 30 30 29.4638 30 28.8V1.2C30 0.53625 29.4638 0 28.8 0ZM22.2 15.9C22.2 16.065 22.065 16.2 21.9 16.2H16.2V21.9C16.2 22.065 16.065 22.2 15.9 22.2H14.1C13.935 22.2 13.8 22.065 13.8 21.9V16.2H8.1C7.935 16.2 7.8 16.065 7.8 15.9V14.1C7.8 13.935 7.935 13.8 8.1 13.8H13.8V8.1C13.8 7.935 13.935 7.8 14.1 7.8H15.9C16.065 7.8 16.2 7.935 16.2 8.1V13.8H21.9C22.065 13.8 22.2 13.935 22.2 14.1V15.9Z" fill="#FFB300"/>
        </svg>
        </span>
        Order model
    </a>
</div>
</div>
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


