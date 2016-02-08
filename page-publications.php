<?php

get_header();
?>
<ul>
        <?php wp_list_categories('orderby=name&title_li=&child_of=4'); ?>
    </ul>

<?php
query_posts('cat=4'); // Category 4 is Publications
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

    <article class="post">
        <h1><?php the_title() ?></h1>
        <?php the_content()?>
    </article>

    <?php endwhile;

    else :
        echo '<p>NO content found</p>';
endif;

get_footer();

?>
