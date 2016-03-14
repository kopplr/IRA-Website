<?php

get_header(); ?>


<div id="clever-vis">
    <iframe src="http://localhost/wordpress/wp-content/uploads/2016/03/d3-html.html" style="border: 0px; margin: 0 auto; display: block" scrolling="no" width="100%" height="100%"></iframe>
</div>
<div style="background-image: url('http://localhost/wordpress/wp-content/themes/IRA Website/images/arch_skinny.jpeg'); background-repeat:no=repeat;"><!-- background-attachment:fixed;-->
    <table border="1">
        <tr>
            <td rowspan="2" ><a id="col1" href="http://localhost/wordpress/ira-portals/">IRA Portals<i class="fa fa-external-link"></i></a></td>

            <td rowspan="2"><a id="col2" href="http://localhost/wordpress/category/data/">Data<i class="fa fa-bar-chart"></i></a></td>

            <td rowspan="2"><a id="col3" href="http://localhost/wordpress/category/publications/">Publications<i class="fa fa-newspaper-o"></i></a></td>

            <td rowspan="2"><a id="col4" href="http://localhost/wordpress/ira-portals/">Accountability<i class="fa fa-check-square-o"></i></a></td>

            <td rowspan="2"><a id="col5" href="http://localhost/wordpress/fact-book/">Fact Book<i class="fa fa-book"></i></a></td>

            <td><a id="col6_1" href="http://localhost/wordpress/about-us/"><i class="fa fa-info-circle fa-fw"></i>About Us</a></td>
        </tr>
        <tr>
            <td><a id="col6_2" href="http://localhost/wordpress/glossary/"><i class="fa fa-question-circle fa-fw"></i>Glossary</a></td>
        </tr>
    </table>

    <nav class="home-nav" style="display:none">
        <?php

        $args = array(
            'theme_location' => 'home-page',
            'container' => 'false',
            'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',
            'walker' => new my_nav_walker_2,

        );

        wp_nav_menu($args);

        ?>
    </nav>
    <div id="submit-request">
        <div class="inner-div">
            <div style="display:table-cell;vertical-align:middle;text-align:center;"><h2>Can't find what you're looking for?</h2></div>
            <div style="display:table-cell;vertical-align:middle;text-align:center;"><a href="http://localhost/wordpress/submit-request"><h3>Submit a Request</h3></a></div>
        </div>

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
