<?php

get_header(); ?>



<!--
<iframe src="https://drive.google.com/file/d/0BzgCDxb26EkfR3RvVjk1cVRCNmM/preview" width="640" height="800" frameborder="0"></iframe>

<div><a href="https://drive.google.com/uc?export=download&id=0BzgCDxb26EkfR3RvVjk1cVRCNmM">Download Fact Book PDF</a></div>
-->
<!--
<a href="https://docs.google.com/spreadsheets/d/0BzgCDxb26Ekfcm9VdE5QX2RsUUU/export?format=xlsx">Download Headcount Excel</a>
<a href="https://docs.google.com/spreadsheets/d/0BzgCDxb26Ekfcm9VdE5QX2RsUUU/export?format=pdf">Download Headcount PDF</a>
-->


<nav class="nav-sidebar">
    <?php

    $args = array(
        'theme_location' => 'sidebar'
    );

    ?>
    <?php wp_nav_menu( $args ); ?>

</nav>

<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>

    <article class="post">
        <h2><?php the_title(); ?></h2>
        <?php the_content()?>
        <iframe src="https://drive.google.com/file/d/0BzgCDxb26EkfR3RvVjk1cVRCNmM/preview" width="100%" height="2500px" frameborder="0"></iframe>
        <div><a href="https://drive.google.com/uc?export=download&id=0BzgCDxb26EkfR3RvVjk1cVRCNmM">Download Fact Book PDF</a></div>
    </article>

    <?php endwhile;

    else :
        echo '<p>NO content found</p>';
endif;

get_footer();

?>
