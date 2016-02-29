<!--
<iframe src="https://drive.google.com/file/d/0BzgCDxb26EkfR3RvVjk1cVRCNmM/preview" width="640" height="800" frameborder="0"></iframe>

<div><a href="https://drive.google.com/uc?export=download&id=0BzgCDxb26EkfR3RvVjk1cVRCNmM">Download Fact Book PDF</a></div>
-->
<!--
<a href="https://docs.google.com/spreadsheets/d/0BzgCDxb26Ekfcm9VdE5QX2RsUUU/export?format=xlsx">Download Headcount Excel</a>
<a href="https://docs.google.com/spreadsheets/d/0BzgCDxb26Ekfcm9VdE5QX2RsUUU/export?format=pdf">Download Headcount PDF</a>
-->



<?php
get_header();
global $wpdb
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

                  <?php
                    $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_title DESC LIMIT 1"); // Get the most recent attachment
                    $myCurrentYear = get_post($attachment_id)->post_title;
                    // get post attachments (Different years)
                    $post_attachments = get_posts( array (
                        'post_type' => 'attachment',
                        'orderby' => 'title',
                        'post_parent' => $post->ID
                    ));
                    ?>
                    <ul class="dropdown-list">

                        <li id="category-selection">
                            <p class="item-selected"><?php the_title(); ?><span class="fa fa-caret-down fa-fw fa-border fa-pull-right"></span></p>
                            <ul class="dropdown-options">
                                <?php
                                    $categories = get_the_category();
                                    $last_category = $categories[0];

                                    foreach($categories as $i => $category)
                                    {
                                        if($category->parent == $last_category->cat_ID)
                                        {
                                            $last_category = $category; // Find most sub category (last child category)
                                        }
                                    }
                                    $posts_array = get_posts(array(
                                        'cat' => $last_category->term_id,
                                        'order' => 'ASC',
                                        'orderby' => 'title',
                                        'numberposts' => -1
                                    ));
                                    foreach($posts_array as $one_post){
                                        echo '<li' . (($one_post->ID == $post->ID)?' class = "selected"':"") . '>' . '<a href="' . get_permalink($one_post->ID) . '">' . $one_post->post_title . '</a></li>';
                                    }
                                ?>
                            </ul>
                        </li>

                        <li id="year-selection">
                            <p class="item-selected"><?php echo $myCurrentYear; ?><span class="fa fa-caret-down fa-fw fa-border"></span></p>
                            <ul class="dropdown-options">
                            <?php
                                $myYearsSelected = array();
                                foreach ( $post_attachments as $post_attachment ) {
                                    $myYear = wp_get_attachment_link( $post_attachment->ID, '', true, false );
                                    $myYearSelected = $post_attachment->post_title;
                                    $attachmentPath = wp_get_attachment_url($post_attachment->ID);

                                    if (wp_check_filetype($attachmentPath)['ext'] == 'pdf'){ // Checks for pdf so does not duplicate list
                                        echo '<li data-id="' . $post_attachment->ID . '"' . (($myCurrentYear == $myYearSelected)?' class = "selected"':"") . '>' . $post_attachment->post_title . '</li>'; // Highlights the selected year
                                    }
                                }
                            ?>
                            </ul>
                        </li>
                        <li id="downloads">
                            <ul id="download-options">
                                <li id="download-pdf">
                                    <a target="_blank" href="<?php echo wp_get_attachment_url($attachment_id) ?>"><i class="fa fa-file-pdf-o fa-fw fa-border"></i></a>
                                </li>
                                <li id="download-excel"
                                <?php
                                    $title_exists = $wpdb->get_results( // looks for other attachments with same name (ie. excel files)
                                        $wpdb->prepare(
                                            "SELECT ID FROM wp_posts
                                            WHERE post_title = %s
                                            AND post_type = 'attachment'
                                            AND post_parent = %s", $myCurrentYear, $post->ID
                                        )
                                    );
                                    $foo = true;
                                    foreach ($title_exists as $title_exist){ // checks to see if the file is an excel file and then adds an icon
                                        $attachmentPathExcel = wp_get_attachment_url($title_exist->ID);
                                        if (wp_check_filetype($attachmentPathExcel)['ext'] == 'xlsx'|| wp_check_filetype($attachmentPathExcel)['ext'] == 'xls') {
                                            echo '><a href="' . $attachmentPathExcel . '"><i class="fa fa-file-excel-o fa-fw fa-border"></i></a></li>';
                                            $foo = false;
                                        }
                                    }
                                   if ($foo){
                                        echo 'style="display:none"></li>';
                                   }
                                ?>

                            </ul>
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
            <iframe src="<?php echo wp_get_attachment_url($attachment_id) ?>" frameborder="0" width="100%" height="1000px"></iframe>
        </div>
    </div>
</div>



<?php

get_footer();

?>

