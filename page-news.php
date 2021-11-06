<?php get_header(); ?>

    <section class="content-blk">
        <div class="content-tit">
            <h1 data-desc="Popular events">News</h1>
        </div>
        <div class="content-txt">

            <?php
            $perpageposts = 10;
            $args = array( 'posts_per_page' => $perpageposts );
            $lastposts = get_posts( $args );

            foreach( $lastposts as $post ){
                setup_postdata($post);
                ?>

                <article class="news-item">
                    <?php
                    if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
                        ?>
                        <figure class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                            </a>
                        </figure>
                        <?php
                    }
                    ?>
                    <div class="post-content">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <time class="entry-date"><?php the_date(); ?></time>
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="entry-link">
                            <a href="<?php the_permalink(); ?>">More</a>
                        </div>
                    </div>
                </article>

                <?php
            }
            wp_reset_postdata();
            ?>

        </div>

        <?php
        if ( count($lastposts) == $perpageposts ) {
            ?>
            <nav class="pagination">
                <a id="more-news" href="#">More news</a>
            </nav>
            <?php
        }
        ?>

    </section>

<?php get_footer();
