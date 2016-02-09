<?php
get_header();
?>


<div class="site-content clearfix">
    <div class="sidebar-column">
        <ul>
            <li>Show All</li>
            <?php wp_list_categories('orderby=name&title_li=&child_of=2'); ?> <!-- Get all child categories of Publications and sort alphabetically-->
        </ul>
    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>
    <div class="main-column">
        <?php
        query_posts('cat=2&orderby=title&order=asc'); // Category 2 is Publications, order alphabetically
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>

            <?php // Get the most recent attachment
                global $wpdb;
                $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1");
            ?>

            <a href="<?php echo get_attachment_link($attachment_id); ?>">
                <article class="post">
                    <h1><?php the_title() ?></h1>
                    <?php the_content()?>

                </article>
            </a>

            <?php endwhile;

            else :
                echo '<p>NO content found</p>';
        endif;?>
    </div>

</div>



<?php
get_footer();
?>
