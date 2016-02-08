<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>

    <article class="post">
        <?php the_content()?>
    </article>
    <div>
        <iframe src="<?php echo wp_get_attachment_url($post->ID) ?>" frameborder="0" width="100%" height="1000px"></iframe>
    </div>
    <?php endwhile;

    else :
        echo '<p>ZERO content found</p>';
endif;

get_footer();

?>
