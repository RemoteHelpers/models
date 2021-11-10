<?php
/*
Template Name: Contacts
Template Post Type: page
*/
?>
<?php 
add_action('addStyle', function() {
    wp_register_style('my-style', get_template_directory_uri().'/css/contacts.css', '', '0.01', false);
    wp_enqueue_style('my-style');
});
do_action( 'addStyle');
get_header(); ?>

    <section class="content-blk">
        <div class="content-tit">
            <h1 data-desc="Open for new">Contacts</h1>
        </div>
    </section>
    <section class="contacts__wrapper">
        <div class="contacts__block">
            <div class="contacts__link contacts__phone">
                <div>
                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="15" cy="15.1196" r="15" fill="#424242"/>
                <path d="M23.0297 19.1205V21.5423C23.0307 21.7672 22.9846 21.9897 22.8945 22.1957C22.8045 22.4017 22.6724 22.5866 22.5067 22.7386C22.341 22.8906 22.1454 23.0063 21.9325 23.0783C21.7195 23.1504 21.4938 23.1771 21.2699 23.1569C18.7858 22.887 16.3996 22.0381 14.3031 20.6785C12.3526 19.4391 10.6989 17.7854 9.45949 15.8349C8.09518 13.7289 7.24614 11.3311 6.98116 8.83586C6.96099 8.61262 6.98752 8.38763 7.05906 8.17521C7.13061 7.96279 7.2456 7.76759 7.39672 7.60204C7.54784 7.4365 7.73177 7.30423 7.9368 7.21366C8.14184 7.1231 8.36349 7.07622 8.58763 7.07601H11.0095C11.4012 7.07215 11.781 7.21088 12.0781 7.46635C12.3751 7.72181 12.5692 8.07658 12.624 8.46451C12.7262 9.23955 12.9158 10.0005 13.1891 10.733C13.2977 11.0219 13.3212 11.3359 13.2568 11.6378C13.1924 11.9397 13.0429 12.2168 12.8258 12.4363L11.8006 13.4615C12.9498 15.4826 14.6232 17.156 16.6442 18.3052L17.6695 17.2799C17.8889 17.0629 18.166 16.9133 18.4679 16.8489C18.7698 16.7845 19.0839 16.808 19.3728 16.9167C20.1052 17.19 20.8662 17.3795 21.6412 17.4817C22.0334 17.5371 22.3915 17.7346 22.6475 18.0367C22.9035 18.3389 23.0396 18.7246 23.0297 19.1205Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </div>
                <a href="<?php the_field("contact_phone"); ?>">
                    <?php the_field("contact_phone"); ?>
                </a>
            </div>
            <div class="contacts__link contacts__email">
                <div>
                    <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15.7202" r="15" fill="#424242"/>
                    <path d="M8.12662 8.84717H21.8726C22.8176 8.84717 23.5908 9.62038 23.5908 10.5654V20.8749C23.5908 21.8199 22.8176 22.5931 21.8726 22.5931H8.12662C7.18158 22.5931 6.40837 21.8199 6.40837 20.8749V10.5654C6.40837 9.62038 7.18158 8.84717 8.12662 8.84717Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M23.5907 10.5651L14.9994 16.5789L6.4082 10.5651" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <a href="<?php the_field("contact_email"); ?>">
                    <?php the_field("contact_email"); ?>
                </a>
            </div>
        </div>
        <div class="contacts__title"><?php the_field("contacts_title"); ?></div>
        <div class="contacts__subtitle"><?php the_field("contacts_subtitle"); ?></div>
        <div class="contacts__form">
            <?php echo do_shortcode('[contact-form-7 id="2252" title="Contact form 1"]'); ?> 
        </div>
    </section>

<?php get_footer();
