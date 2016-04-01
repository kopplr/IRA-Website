<?php

get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>

    <article class="post">
        <h2><a href="<?php the_permalink()?>"> <?php the_title(); ?></a></h2>
        <?php the_content()?>
    </article>

    <?php endwhile;

    else :
        echo '<div style="height:500px; display:flex; align-items:center; justify-content:center;"><h1>OOPS! Sorry. This page does not exist.</h1></div>';
endif;

get_footer();

?>
