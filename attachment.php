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
        <div><?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>

                  <?php // get post attachments
                    $post_attachments = get_posts( array (
                        'post_type' => 'attachment',
                        'orderby' => 'title',
                        'post_parent' => get_post($post->post_parent)->ID
                    ));
                    ?>
                    <ul class="dropdown-list">

                        <li id="category-selection">
                            <p class="item-selected">Fact Book<span class="fa fa-caret-down fa-fw fa-border fa-pull-right"></span></p>
                            <ul class="dropdown-options">
                                <?php wp_list_categories('orderby=name&title_li=&child_of=2'); ?> <!-- Get all child categories of Publications and sort alphabetically-->
                            </ul>
                        </li>

                        <li id="year-selection">
                            <p class="item-selected"><?php echo $post->post_title ?>&nbsp;<span class="fa fa-caret-down fa-fw fa-border"></span></p>
                            <ul class="dropdown-options">
                            <?php
                                $myCurrentYear = $post->post_title;
                                $myYearsSelected = array();
                                foreach ( $post_attachments as $post_attachment ) {
                                    $myYear = wp_get_attachment_link( $post_attachment->ID, '', true, false );
                                    $myYearSelected = $post_attachment->post_title;
                                    echo '<li' . (($myCurrentYear == $myYearSelected)?' class = "selected"':"") . '>' . $myYear . '</li>';
                                }
                            ?>
                            </ul>
                        </li>
                        <li id="downloads">
                            <a href="<?php echo wp_get_attachment_url($post->ID) ?>"><i class="fa fa-file-pdf-o fa-fw fa-border"></i></a>
                        </li>

                    </ul>

                <?php endwhile;
                else :
                    echo '<p>NO content found</p>';
            endif;
            wp_reset_postdata();
            ?>

        </div>
        <div>
            <iframe src="<?php echo wp_get_attachment_url($post->ID) ?>" frameborder="0" width="100%" height="1000px"></iframe>
        </div>
    </div>
</div>



<?php

get_footer();

?>
