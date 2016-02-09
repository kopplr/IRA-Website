<?php
get_header();
?>

<div class="site-content clearfix">
    <div class="sidebar-column">
        <ul>
            <?php wp_list_categories('orderby=name&title_li=&child_of=2'); ?> <!-- Get all child categories of Publications and sort alphabetically-->
        </ul>
    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>
    <div class="main-column">
        <?php
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
        ?>
    </div>
</div>



<?php

get_footer();

?>
