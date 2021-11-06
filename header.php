<!doctype html>
<html lang="en">
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M5LJ6BH');</script>
<!-- End Google Tag Manager -->
<?php
$path = get_template_directory_uri();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Kaushan+Script|Raleway:300,400,500,600,700&display=swap">

    <?php
    wp_head();
    ?>

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M5LJ6BH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	
<header class="head <?php $class = is_front_page()? 'head-home':''; echo($class)?>">
    <a class="head-logo" href="/">
        <img src="<?=$path?>/img/logo.svg" alt="Models of Ukraine">
    </a>
    <ul class="head-social">
        <li><a href="<?php the_field('instagram', option); ?>"><img src="<?=$path?>/img/soc-ig-b.svg" alt=""></a></li>
        <li><a href="<?php the_field('telegram', option); ?>"><img src="<?=$path?>/img/soc-tg-b.svg" alt=""></a></li>
        <li><a href="viber://chat?number=+<?php the_field('viber', option); ?>"><img src="<?=$path?>/img/soc-vb-b.svg" alt=""></a></li>
    </ul>
    <nav class="head-nav">
        <?php
        wp_nav_menu( array(
            'menu'            => 'Primary Menu',
            'container'       => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 1,
        ) );
        ?>
    </nav>
    <a class="head-nav-tr nav-tr" href="#"><span></span></a>
</header>
<div class="btn-float float-t">
    <div class="btn-float-iwr">
        <a id="js-filter" title="Filter" href="#"><i class="i-filt"></i></a>
    </div>
</div>
