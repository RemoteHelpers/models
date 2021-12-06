<?php get_header(); ?>

<?php
$path = get_template_directory_uri();

$texts = get_posts([
    'numberposts' => -1,
    'post_type' => 'textHome'
]);
?>
    <div class="home">
        <section class="home-about row">
            <a class="home-link" href="/catalog"><span>Models</span></a>
            <div class="home-txt cell">
                <img class="home-logo" src="<?=$path?>/img/logo.svg" alt="Models of Ukraine">
                <p><?=$texts[4]->post_content ?></p>
                <ul class="home-social">
                    <li><a href="<?php the_field('instagram', option); ?>"><img src="<?=$path?>/img/soc-ig-b.svg" alt=""></a></li>
                    <li><a href="<?php the_field('telegram', option); ?>"><img src="<?=$path?>/img/soc-tg-b.svg" alt=""></a></li>
                    <li><a href="viber://chat?number=+<?php the_field('viber', option); ?>"><img src="<?=$path?>/img/soc-vb-b.svg" alt=""></a></li>
                </ul>
            </div>
            <div class="home-img cell"></div>
        </section>
        <section class="home-models row">
            <a class="home-link" href="/catalog"><span>Models</span></a>
            <div class="home-txt cell">
                <?php $subtitle = get_post_meta($texts[3]->ID, 'subTitle', true ); ?>
                <h2 data-desc="<?=$subtitle?>"><?=$texts[3]->post_title?></h2>
                <p><?=$texts[3]->post_content?></p>
            </div>
            <div class="home-img cell"></div>
        </section>
        <section class="home-services row">
            <a class="home-link" href="/services"><span>Services</span></a>
            <div class="home-txt cell">
                <?php $subtitle = get_post_meta($texts[2]->ID, 'subTitle', true ); ?>
                <h2 data-desc="<?=$subtitle?>"><?=$texts[2]->post_title?></h2>
                <p><?=$texts[2]->post_content?></p>
            </div>
            <div class="home-img cell"></div>
        </section>
        <section class="home-news row">
            <a class="home-link" href="/news"><span>News</span></a>
            <div class="home-txt cell">
                <?php $subtitle = get_post_meta($texts[1]->ID, 'subTitle', true ); ?>
                <h2 data-desc="<?=$subtitle?>"><?=$texts[1]->post_title?></h2>
                <p><?=$texts[1]->post_content?></p>
            </div>
            <div class="home-img cell"></div>
        </section>
        <section class="home-contact row">
            <div class="home-txt cell">
                <?php
                $subtitle = get_post_meta($texts[0]->ID, 'subTitle', true );
                $email = get_post_meta($texts[0]->ID, 'email', true );
                $tel = get_post_meta($texts[0]->ID, 'tel', true );
                ?>
                <h2 data-desc="<?=$subtitle?>"><?=$texts[0]->post_title?></h2>
                <ul class="home-dest">
                    <li class="phone"><a href="tel:<?=$tel?>"><?=$tel?></a></li>
                    <li class="email"><a href="mailto:<?=$email?>"><?=$email?></a></li>
                </ul>
                <div class="home-form">
                    <form id="home-form" action="#">
                        <div class="home-client">
                            <ul>
                                <li>
                                    <input id="home-name" name="home-name" type="text" placeholder="Name" required>
                                </li>
                                <li>
                                    <input id="home-phone" name="home-phone" type="tel" placeholder="Phone" required>
                                </li>
                                <li>
                                    <input id="home-mail" name="home-mail" type="email" placeholder="Email" required>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <textarea id="home-about" name="home-about" placeholder="Drop a line..." required></textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="home-agree">
                            <label><input name="home-agree" id="home-agree" type="checkbox" required>I accept the data processing <a id="home-agree-link" href="#">conditions</a></label>
                        </div>
                        <div class="home-btn">
                            <input id="home-submit" type="submit" value="Send">
                        </div>
                    </form>
                    <div class="home-wait" id="home-wait">
                        <div class="home-wait-iwr">
                            <img class="home-wait-logo" src="<?=$path?>/img/logo.svg" alt="">
                            <div class="home-wait-txt">Please wait a few seconds, your data is being processed...</div>
                        </div>
                    </div>
                    <div class="home-thanks" id="home-thanks">
                        <div class="home-thanks-iwr">
                            <img class="home-thanks-logo" src="<?=$path?>/img/logo.svg" alt="">
                            <div class="home-thanks-txt">Thanks for your message.<br>Very soon, our managers will contact you, stay in touch and have a nice day!</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-img cell"></div>
        </section>
    </div>
    <div class="home-conditions">
        <div class="home-conditions-txt">
            <?php the_field('terms', option); ?>
        </div>
    </div>
<?php get_footer();
