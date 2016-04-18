<?php
get_header();
?>

<div class="site-title">

    <div style="flex: 1;" ></div>
    <div style="flex: 1; order: 99;"></div>
    <div style="flex: 1 1 1000px">
        <?php while ( have_posts() ) : the_post(); ?>
        <h2><?php the_title(); ?></h2>
        <?php endwhile; ?>
    </div>

</div>
<div id="main-content">
    <div style="flex: 1;"  ></div>
    <div style="flex: 1; order: 99;"></div>
    <div class="site-content">
        <div class="main-column" style="">
            <?php
            the_post();
            the_content();
            ?>



        <div class="tabs">
            <ul class="tab-links">
                <li class="active"><a href="#tab1"><h3>OUR STAFF</h3></a></li>
                <li><a href="#tab2"><h3>OUR LOCATIONS</h3></a></li>
                <li><a href="#tab3"><h3>OUR COMMUNITY</h3></a></li>
            </ul>

            <div class="tab-content">
                <div id="tab1" class="tab active">
        <!-- ASSOCIATE VICE PRESIDENT **************************************************************************************************** -->
        <?php
        $team_posts = get_posts( array(
            'post_type' => 'team',
            'posts_per_page' => -1, // Unlimited posts
            'orderby' => 'title', // Order alphabetically by name
            'meta_query' => array(array(
                'key' => 'position',
                'value' => 'Associate Vice President',))
        ) );

        if ( $team_posts ):
        ?>
            <div class="position" id="avp">
            <h3>Associate Vice President</h3>
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture" style="float:left;">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h3><?php the_title(); ?></h3>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- EXECUTIVE ASSISTANT **************************************************************************************************** -->
        <?php
        $team_posts = get_posts( array(
            'post_type' => 'team',
            'posts_per_page' => -1, // Unlimited posts
            'orderby' => 'title', // Order alphabetically by name
            'meta_query' => array(array('key' => 'position', 'value' => 'Executive Assistant',))
        ) );

        if ( $team_posts ):
        ?>
        <div class="position" id="executive-assistant">
            <h3 style="">Executive Assistant</h3>
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture" style="float:left;">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h3><?php the_title(); ?></h3>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
            </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- SENIOR PROJECT ANALYSTS **************************************************************************************************** -->
        <?php
        $team_posts = get_posts( array(
            'post_type' => 'team',
            'posts_per_page' => -1, // Unlimited posts
            'orderby' => 'title', // Order alphabetically by name
            'meta_query' => array(array('key' => 'position', 'value' => 'Senior Project Analyst',))
        ) );

        if ( $team_posts ):
        ?>
            <h3>Senior Project Analysts</h3>
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture" style="float:left;">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h3><?php the_title(); ?></h3>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- STATISTICIAN AND PROGRAMMERS ************************************************************************************************ -->
        <?php
        $team_posts = get_posts( array(
            'post_type' => 'team',
            'posts_per_page' => -1, // Unlimited posts
            'orderby' => 'title', // Order alphabetically by name
            'meta_query' => array(array('key' => 'position', 'value' => 'Statistician and Programmer',))
        ) );

        if ( $team_posts ):
        ?>
            <h3>Statistician and Programmers</h3>
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture" style="float:left;">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h3><?php the_title(); ?></h3>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- INFORMATION AND DATA ANALYSTS *********************************************************************************************** -->
        <?php
        $team_posts = get_posts( array(
            'post_type' => 'team',
            'posts_per_page' => -1, // Unlimited posts
            'orderby' => 'title', // Order alphabetically by name
            'meta_query' => array(array('key' => 'position', 'value' => 'Information and Data Analyst',))
        ) );

        if ( $team_posts ):
        ?>
            <h3>Information and Data Analysts</h3>
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture" style="float:left;">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h3><?php the_title(); ?></h3>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- JUNIOR ANALYSTS **************************************************************************************************** -->
        <?php
        $team_posts = get_posts( array(
            'post_type' => 'team',
            'posts_per_page' => -1, // Unlimited posts
            'orderby' => 'title', // Order alphabetically by name
            'meta_query' => array(array('key' => 'position', 'value' => 'Junior Analyst',))
        ) );

        if ( $team_posts ):
        ?>
            <h3>Junior Analysts</h3>
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture" style="float:left;">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h3><?php the_title(); ?></h3>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
            <?php endforeach; ?>
        <?php endif; ?>
                </div>

                <div id="tab2" class="tab">
                    <div id="map" style="width:100%; height: 500px"></div>

                </div>

                <div id="tab3" class="tab">
                    <div id="tab3-content">
                        <img src="http://localhost/wordpress/wp-content/uploads/2016/03/OUAC-our-community-e1459431507321.png">
                        <div id="community-text">
                            <div style="display:flex;">
                                <i class="fa fa-quote-left fa-3x fa-pull-left" aria-hidden="true"></i>
                                <h3><?php
                                    $page = get_page_by_title('About Us');
                                    echo get_post_meta($page->ID, 'quotation', true); ?> <br>
                                    <span>- <?php echo get_post_meta($page->ID, 'quotation-person', true); ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div> <!-- site-content -->
</div> <!-- main-content -->
<?php
get_footer();

?>
