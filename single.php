<?php
get_header();
global $wpdb
?>
<div class="site-title" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/arch_skinny.jpeg);">

    <div style="flex: 1;" ></div>
    <div style="flex: 1; order: 99;"></div>
    <div style="flex: 1 1 1000px">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
            $isFactBook = ($post->post_name == 'fact-book');
            $categories = get_the_category();
        ?>
        <h2><?php echo ($isFactBook ? the_title() : pa_category_top_parent_id($categories[0]->cat_ID)); //pa_category_top_parent_id($categories[0]->cat_ID) ?></h2>

    </div>

</div>
<div id="main-content">
    <div style="flex: 1;"  ></div>
    <div style="flex: 1; order: 99;"></div>
    <div class="site-content">
        <div class="main-column">


                      <?php
                        $attachment_id = $wpdb->get_var($wpdb->prepare(
                            "SELECT ID FROM $wpdb->posts WHERE post_parent = %s AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_title DESC LIMIT 1", $post->ID
                        )); // Get the most recent attachment
                        $myCurrentYear = get_post($attachment_id)->post_title;
                        // get post attachments (Different years)
                        $post_attachments = get_posts( array (
                            'post_type' => 'attachment',
                            'orderby' => 'title',
                            'post_parent' => $post->ID,
                            'numberposts' => -1
                        ));
                        ?>
                        <ul class="dropdown-list">

                            <li id="category-selection" style="<?php echo ($isFactBook ? 'display:none;' : '');?>">
                                <div class="item-selected">
                                    <div><?php the_title(); ?></div>
                                    <div><span class="fa fa-caret-down fa-fw"></span></div>
                                </div>
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

                            <li id="year-selection" <?php if (count($post_attachments) <= 1){echo 'style="display:none;"';} ?>>
                                <div class="item-selected">
                                    <div id="current-year"><?php echo $myCurrentYear; ?></div>
                                    <div><span class="fa fa-caret-down fa-fw"></span></div>
                                </div>
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
                                        <a target="_blank" href="<?php echo wp_get_attachment_url($attachment_id) ?>"><i class="fa fa-file-pdf-o fa-fw"></i></a>
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
                                                echo '><a href="' . $attachmentPathExcel . '"><i class="fa fa-file-excel-o fa-fw"></i></a></li>';
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
            <div id="my-container">
                <iframe src="<?php echo wp_get_attachment_url($attachment_id) ?>" frameborder="0" width="100%" height="700px"></iframe>
            </div>
        </div>

    </div>
</div>

<?php
get_footer();
?>

