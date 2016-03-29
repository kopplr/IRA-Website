<?php

get_header(); ?>

<div id="clever-vis">
    <iframe src="http://localhost/wordpress/wp-content/uploads/2016/03/d3-html.html" style="border: 0px; align-self: stretch; width:100%; height:100% min-height:100%;" scrolling="no" width="100%" height="100%"></iframe>
</div>

<div id="home-menu" style="">
    <a  class="home-column" href="http://localhost/wordpress/category/ira-portals/"><div  >IRA Portals<i class="fa fa-external-link"></i></div></a>

    <a  class="home-column" href="http://localhost/wordpress/category/data/"><div >Data<i class="fa fa-bar-chart"></i></div></a>

    <a class="home-column" href="http://localhost/wordpress/category/publications/"><div >Publications<i class="fa fa-newspaper-o"></i></div></a>

    <a  class="home-column" href="http://localhost/wordpress/category/accountability/"><div >Accountability<i class="fa fa-check-square-o"></i></div></a>

    <a  class="home-column" href="http://localhost/wordpress/fact-book/"><div >Fact Book<i class="fa fa-book"></i></div></a>
    <div class="home-column home-split-column">
        <a  href="http://localhost/wordpress/about-us/"><div><i class="fa fa-info-circle fa-fw"></i>About Us</div></a>
        <a  href="http://localhost/wordpress/glossary/"><div><i class="fa fa-question-circle fa-fw"></i>Glossary</div></a>
    </div>

</div>
</div>
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
