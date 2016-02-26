<?php

get_header(); ?>


<div id="clever-vis" >
    This is a clever data visualization. If you think hard enough you'll get it.
</div>
<table style="width:100%;table-layout:fixed" border="1">
    <tr>
        <td rowspan="2">IRA Portals</td>
        <td rowspan="2">Data</td>
        <td rowspan="2">Publications</td>
        <td rowspan="2">Accountability</td>
        <td rowspan="2">Fact Book</td>
        <td>About Us</td>
    </tr>
    <tr>
        <td>Glossary</td>
    </tr>
</table>
<nav class="home-nav">
    <?php

    $args = array(
        'theme_location' => 'home-page',
       // 'container' => 'false',
     //   'items_wrap' => '<tr id="%1$s" class="%2$s">%3$s</tr>',
        'walker' => new my_nav_walker_2,

    );

    wp_nav_menu($args);

    ?>
</nav>
<div id="submit-request">

</div>
<?php
if (have_posts()) :
    while (have_posts()) : the_post(); ?>


    <?php endwhile;

    else :
        echo '<p>NO content found</p>';
endif;

get_footer();

?>
