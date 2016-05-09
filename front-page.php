<?php

get_header(); ?>
<div id="front-page-container">
    <div id="background-pic">
            <div class="flexslider" style="width: 80%">
                <ul class="slides">
                    <li>
                    <iframe src="<?php echo get_template_directory_uri(); ?>/html/d3-transfer.html" style="border: 0px; min-height: 100%" scrolling="no" width="100%"height="500px" frameborder="0" allowfullscreen></iframe>
                    </li>
                    <li>
                    <iframe  src="<?php echo get_template_directory_uri(); ?>/html/d3-bubble.html" style="border: 0px; min-height: 100%" scrolling="no" width="100%"height="500px" frameborder="0" allowfullscreen></iframe>
                    </li>
                </ul>
             </div>

<!--
        <div class="carousel-home" style="flex: 0 1 165px; order: -1;">
            <i class="fa fa-angle-left vis-arrow arrow-prev"></i>
        </div>
        <div class="carousel-home" style="flex: 0 1 165px;">
            <i class="fa fa-angle-right vis-arrow arrow-next"></i>
        </div>
-->

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
        <a  class="home-column" href="<?php echo bloginfo('url'); ?>/category/ira-portals/"><div  >IRA PORTALS<i class="fa fa-external-link" aria-hidden="true"></i></div></a>

        <a  class="home-column" href="<?php echo bloginfo('url'); ?>/category/data/"><div >DATA<i class="fa fa-bar-chart" aria-hidden="true"></i></div></a>

        <a class="home-column" href="<?php echo bloginfo('url'); ?>/category/publications/"><div >PUBLICATIONS<i class="fa fa-newspaper-o" aria-hidden="true"></i></div></a>

        <a  class="home-column" href="<?php echo bloginfo('url'); ?>/category/accountability/"><div >ACCOUNTABILITY<i class="fa fa-check-square-o" aria-hidden="true"></i></div></a>

        <a  class="home-column" href="<?php echo bloginfo('url'); ?>/fact-book/"><div >FACT BOOK<i class="fa fa-book" aria-hidden="true"></i></div></a>
        <div class="home-column home-split-column">
            <a  href="<?php echo bloginfo('url'); ?>/about-us/"><div><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>ABOUT US</div></a>
            <a  href="<?php echo bloginfo('url'); ?>/glossary/"><div><i class="fa fa-question-circle fa-fw" aria-hidden="true"></i>GLOSSARY</div></a>
        </div>

    </div>
</div>
<nav class="home-nav" style="display:none;">
    <?php

    $args = array(
        'theme_location' => 'home-page',
        'container' => 'false',
        'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',
        //'walker' => new my_nav_walker_2,

    );

    wp_nav_menu($args);

    ?>
</nav>

<?php
get_footer();
?>
