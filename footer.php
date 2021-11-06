<?php
$path = get_template_directory_uri();

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
?>
<div class="btn-float float-b">
    <div class="btn-float-iwr">
        <a id="js-order" title="Favorites" href="#"><i class="i-star"></i></a>
        <a id="js-top" href="#"><i class="i-up"></i></a>
    </div>
</div>
<footer class="foot">
    <div class="foot-social">
        <h3>Follow Us</h3>
        <ul>
            <li><a href="<?php the_field('instagram', option); ?>"><img src="<?=$path?>/img/soc-ig-b.svg" alt=""></a></li>
                    <li><a href="<?php the_field('telegram', option); ?>"><img src="<?=$path?>/img/soc-tg-b.svg" alt=""></a></li>
                    <li><a href="viber://chat?number=+<?php the_field('viber', option); ?>"><img src="<?=$path?>/img/soc-vb-b.svg" alt=""></a></li>
        </ul>
    </div>
    <p class="foot-copy">Copyright © MDLUA 2019</p>
</footer>

<div class="shading shade-menu"></div>
<div class="shading shade-rights"></div>
<div class="shading shade-filter"></div>
<div class="shading shade-starred"></div>
<div class="shading shade-conditions"></div>

<?php if(is_category() || is_page('catalog')):?>
    <div class="catalog-filter">
        <div class="filter-tit">Filter model parameters</div>
        <div class="filter-body">
            <form id="catalog-filter-form" action="#">
                <ul class="filter-list">
                    <li>
                        <label for="filter-height">Height: <span class="label-from">120-</span><span class="label-to">200cm</span></label>
                        <div id="filter-height"></div>
                        <input class="range-from" id="filter-height-from" name="filter-height-from" type="hidden">
                        <input class="range-to" id="filter-height-to" name="filter-height-to" type="hidden">
                    </li>
                    <li>
                        <label for="filter-bust">Bust: <span class="label-from">60-</span><span class="label-to">120cm</span></label>
                        <div id="filter-bust"></div>
                        <input class="range-from" id="filter-bust-from" name="filter-bust-from" type="hidden">
                        <input class="range-to" id="filter-bust-to" name="filter-bust-to" type="hidden">
                    </li>
                    <li>
                        <label for="filter-waist">Waist: <span class="label-from">40-</span><span class="label-to">80cm</span></label>
                        <div id="filter-waist"></div>
                        <input class="range-from" id="filter-waist-from" name="filter-waist-from" type="hidden">
                        <input class="range-to" id="filter-waist-to" name="filter-waist-to" type="hidden">
                    </li>
                    <li>
                        <label for="filter-hips">Hips: <span class="label-from">60-</span><span class="label-to">120cm</span></label>
                        <div id="filter-hips"></div>
                        <input class="range-from" id="filter-hips-from" name="filter-hips-from" type="hidden">
                        <input class="range-to" id="filter-hips-to" name="filter-hips-to" type="hidden">
                    </li>
                    <li>
                        <label for="filter-hair">Hair</label>
                        <select id="filter-hair" name="filter-hair">
                            <option value=""></option>
                            <option value="Brunet">Brunet</option>
                            <option value="Red">Red</option>
                            <option value="Blond">Blond</option>
                            <option value="Brown">Brown</option>
                            <option value="Gray">Gray</option>
                            <option value="Other">Other</option>
                        </select>
                    </li>
                    <li>
                        <label for="filter-eyes">Eyes</label>
                        <select id="filter-eyes" name="filter-eyes">
                            <option value=""></option>
                            <option value="Brown">Brown</option>
                            <option value="Blue">Blue</option>
                            <option value="Green">Green</option>
                            <option value="Yellow">Yellow</option>
                            <option value="Black">Black</option>
                            <option value="Grey">Grey</option>
                            <option value="Other">Other</option>
                        </select>
                    </li>
                </ul>
                <div class="filter-tit-sub">Categories</div>
                <ul class="filter-cat">

                    <?php foreach ($categories as $category) : ?>

                        <?php
                        if($category->term_id == 1 || $category->slug == 'nude' || $category->slug == 'topless') continue; ?>

                        <li><label><input data-idcat="<?=$category->term_id?>" name="filter-category" type="checkbox"><?=$category->name?></label></li>
                    <?php endforeach; ?>
                </ul>
                <div class="filter-btn">
                    <input id="catalog-filter-submit" type="submit" value="Filter">
					<input id="catalog-filter-reset" type="reset" value="Reset">
                </div>
            </form>
        </div>
    </div>

    <script src="<?=$path?>/js/nouislider.min.js"></script>

<?php endif; ?>

<div class="starred">
    <div class="starred-tit">Starred models</div>
    <div class="starred-body">
        <div class="starred-txt">You can add to favorites the models you would like to work with and contact them later.</div>
        <form id="starred-form" action="#">
            <ul class="starred-models">
            </ul>
            <ul class="starred-client" style="display: none;">
                <li>
                    <input id="starred-name" name="starred-name" type="text" placeholder="Name" required>
                </li>
                <li>
                    <input id="starred-phone" name="starred-phone" type="tel" placeholder="Phone" required>
                </li>
                <li>
                    <input id="starred-mail" name="starred-mail" type="email" placeholder="E-mail" required>
                </li>
            </ul>
            <div class="starred-btn" style="display: none;">
                <input id="starred-submit" type="submit" value="Schedule a shoot">
            </div>
        </form>
        <div class="starred-wait" id="starred-wait">
            <div class="starred-wait-iwr">
                <img class="starred-wait-logo" src="<?=$path?>/img/logo.svg" alt="">
                <div class="starred-wait-txt">Please wait a few seconds, your data is being processed...</div>
            </div>
        </div>
        <div class="starred-thanks" id="starred-thanks">
            <div class="starred-thanks-iwr">
                <img class="starred-thanks-logo" src="<?=$path?>/img/logo.svg" alt="">
                <div class="starred-thanks-txt">Thanks for your order.<br>Very soon, our managers will contact you, stay in touch and have a nice day!</div>
            </div>
        </div>
    </div>
</div>

</body>

