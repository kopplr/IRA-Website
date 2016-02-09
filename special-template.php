<?php

/*
Template Name: Special Layout
*/

get_header();
?>

<div class="site-content clearfix">
    <div class="secondary-column">
        <ul>
            <?php wp_list_categories('orderby=name&title_li=&child_of=2'); ?>
        </ul>
    </div>

    <div class="main-column">
        <?php
        query_posts('cat=2'); // Category 2 is Publications
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>

            <article class="post">
                <h1><?php the_title() ?></h1>
                <?php the_content()?>
            </article>

            <?php endwhile;

            else :
                echo '<p>NO content found</p>';
        endif;?>
    </div>
</div>



<?php
get_footer();
?>
