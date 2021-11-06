<?php get_header(); ?>

<?php the_post(); ?>

    <section class="content-blk">
        <div class="content-txt">

            <div class="content-back"><a href="/news">Back to news</a></div>

            <article class="news-post">

                <h1 class="entry-title"><?php the_title(); ?></h1>
                <time class="entry-date"><?php the_date(); ?></time>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

            </article>

        </div>
    </section>

<?php get_footer();
