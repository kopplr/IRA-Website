<?php

get_header(); ?>
<div id="front-page-container">
    <div id="background-pic" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/Arch_700.jpeg')">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                    <iframe src="<?php echo get_template_directory_uri(); ?>/html/d3-transfer.html" scrolling="no" width="100%"height="500px" frameborder="0" tabindex="-1" allowfullscreen></iframe>
                    </li>
                    <li>
                    <iframe src="<?php echo get_template_directory_uri(); ?>/html/d3-bubble.html" scrolling="no" width="100%"height="500px" frameborder="0" tabindex="-1" allowfullscreen></iframe>
                    </li>
                </ul>
             </div>

    </div>

    <div id="home-menu">
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
