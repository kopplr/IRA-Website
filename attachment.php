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
                    <h1><?php echo $post->post_title ?></h1>
                    <ul>
                        <?php foreach ( $post_attachments as $post_attachment ) {
                            echo '<li>' . wp_get_attachment_link( $post_attachment->ID, '', true, false ) . '</li>';
                        } ?>
                    </ul>

                <?php endwhile;
                else :
                    echo '<p>NO content found</p>';
            endif;?>

        </div>
        <div>
            <iframe src="<?php echo wp_get_attachment_url($post->ID) ?>" frameborder="0" width="100%" height="1000px"></iframe>
        </div>
    </div>
</div>



<?php

get_footer();

?>
