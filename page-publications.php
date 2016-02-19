<?php
get_header();
?>


<div class="site-content clearfix">
    <div class="sidebar-column">
<!--
        <div class="button-group filter-button-group">
        <ul style="list-style-type:none">
            <li><button data-filter="*">show all</button></li>
            <li><button data-filter=".fact-sheets">fact sheets</button></li>
            <li><button data-filter=".fact-book">fact book</button></li>
            <li><button data-filter=".surveys">surveys</button></li>

        </ul>

        </div>
-->

        <nav>
            <?php

            $walker = new my_nav_walker;

            $args = array(
                'theme_location' => 'sidebar',
                'container_class' => 'button-group filter-button-group',
                'walker' => $walker
            );

            ?>

            <?php
            wp_nav_menu($args)

            ?>
        </nav>

    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>
    <div class="main-column">

        <div class="grid">
            <?php
            query_posts('cat=2&orderby=title&order=asc'); // Category 2 is Publications, order alphabetically
            if (have_posts()) :
                while (have_posts()) : the_post();
            ?>

                <?php // Get the most recent attachment
                    global $wpdb;
                    $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_title DESC LIMIT 1");
                ?>
                <div class="element-item <?php $cats = get_the_category(); foreach ($cats as $cat){ echo $cat->slug . ' ';} ?>"> <!-- Add in categories as classes to be able to filter in Isotope -->

                    <a href="<?php echo get_attachment_link($attachment_id); ?>"> <!-- Link to most recent attachment -->
                        <article class="post">
                            <h1><?php the_title() ?></h1>
                            <?php the_content()?>
                        </article>
                    </a>
                </div>

                <?php endwhile;


                else :
                    echo '<p>NO content found</p>';
            endif;
            wp_reset_query();
            ?>
        </div>
    </div>

</div>



<?php
get_footer();
?>
