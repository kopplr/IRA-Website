<?php

get_header(); ?>

<div id="vis-group">
    <div id="clever-vis">
        <iframe src="http://localhost/wordpress/wp-content/uploads/2016/03/d3-html.html" style="border: 0px; width:100%; height:100% min-height:100%;" scrolling="no" width="100%" height="100%"></iframe>


    </div>
    <div class="carousel-home" style="flex: 0 1 165px; order: -1;">
        <i class="fa fa-angle-left"></i>
    </div>
    <div class="carousel-home" style="flex: 0 1 165px;">
        <i class="fa fa-angle-right"></i>
    </div>
</div>
<!--
<div id="carousel-vis-group" style="">
    <div style="height: 510px">
        <iframe src="http://localhost/wordpress/wp-content/uploads/2016/03/d3-html.html" style="border: 0px; width:100%; height:100% min-height:100%;" scrolling="no" width="100%" height="100%"></iframe>
    </div>
    <div style="height: 100%;">
        <img src="http://localhost/wordpress/wp-content/uploads/2016/03/jacy.png">
    </div>
</div>
-->

<div id="home-menu" style="">
    <a  class="home-column" href="http://localhost/wordpress/category/ira-portals/"><div  >IRA PORTALS<i class="fa fa-external-link"></i></div></a>

    <a  class="home-column" href="http://localhost/wordpress/category/data/"><div >DATA<i class="fa fa-bar-chart"></i></div></a>

    <a class="home-column" href="http://localhost/wordpress/category/publications/"><div >PUBLICATIONS<i class="fa fa-newspaper-o"></i></div></a>

    <a  class="home-column" href="http://localhost/wordpress/category/accountability/"><div >ACCOUNTABILITY<i class="fa fa-check-square-o"></i></div></a>

    <a  class="home-column" href="http://localhost/wordpress/fact-book/"><div >FACT BOOK<i class="fa fa-book"></i></div></a>
    <div class="home-column home-split-column">
        <a  href="http://localhost/wordpress/about-us/"><div><i class="fa fa-info-circle fa-fw"></i>ABOUT US</div></a>
        <a  href="http://localhost/wordpress/glossary/"><div><i class="fa fa-question-circle fa-fw"></i>GLOSSARY</div></a>
    </div>

</div>
</div> <!-- container --!>
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
            <h2>Can't find what you're looking for?</h2>
            <a href="http://localhost/wordpress/submit-request"><h3>SUBMIT A REQUEST</h3></a>
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
