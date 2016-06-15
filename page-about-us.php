<?php
get_header();
?>

<div class="site-title" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/arch_skinny.jpeg);">

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
            <div class="position" id="avp-ea">
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h4><?php the_title(); ?></h4>
                    <p><i class="fa fa-user fa-fw" aria-hidden="true"></i><?php the_field('position') ?></p>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
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
            <?php
            foreach ( $team_posts as $post ):
            setup_postdata($post);
            ?>
            <article class="profile">
                <div class="profile-picture">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h4><?php the_title(); ?></h4>
                    <p><i class="fa fa-user fa-fw" aria-hidden="true"></i><?php the_field('position') ?></p>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
            </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- ALL OTHERS **************************************************************************************************** -->
        <div id="all-positions">
        <?php
        add_filter( 'posts_orderby' , 'posts_orderby_lastname' );
        $loop = new WP_Query(
        array (
            'post_type' => 'team',
            'posts_per_page' => -1, // Unlimited posts
            'orderby' => 'title', // Order alphabetically by name
            'meta_query' => array(array('key' => 'position',
                                        'value' => array('Executive Assistant', 'Associate Vice President'),
                                        'compare' => 'NOT IN'))
            )
        );
        while ($loop->have_posts()){
            $loop->the_post();
            $meta = get_post_meta(get_the_id()); ?>
            <article class="profile">
                <div class="profile-picture">
                    <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>, <?php the_field('position'); ?>" class="img-circle">
                </div>

                <div class="profile-content">
                    <h4><?php the_title(); ?></h4>
                    <p><i class="fa fa-user fa-fw" aria-hidden="true"></i><?php the_field('position') ?></p>
                    <p><a href="tel:+19055259140p<?php the_field('extension'); ?>"><i class="fa fa-phone fa-fw" aria-hidden="true"></i>905-525-9140 x<?php the_field('extension'); ?></a></p>
                    <p><a href="mailto:<?php echo antispambot( get_field('email') ); ?>"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i><?php the_field('email'); ?></a></p>
                </div>
            </article><!-- /.profile -->
        <?php
        }
        remove_filter( 'posts_orderby' , 'posts_orderby_lastname' );
        ?>

        </div>

                </div>

                <div id="tab2" class="tab">
                    <div id="map" style="width:100%; height: 500px"></div>

                </div>

                <div id="tab3" class="tab">
                    <div id="tab3-content">
                        <img id="our-community-full"
                             src="<?php echo get_template_directory_uri(); ?>/images/Our-Community-full.svg"
                             onerror="this.src='<?php echo get_template_directory_uri(); ?>/images/OUAC-our-community.png'"
                             alt="IRA-connections-to-organizations">
                        <img id="our-community-small"
                             src="<?php echo get_template_directory_uri(); ?>/images/Our-Community-small.svg"
                             onerror="this.src='<?php echo get_template_directory_uri(); ?>/images/OUAC-our-community-small.png'"
                             alt="IRA-connections-to-organizations-small">
                        <div id="community-text">
                            <div style="display:flex;">
                                <i class="fa fa-quote-left fa-3x fa-pull-left" aria-hidden="true"></i>
                                <h4><?php
                                    $page = get_page_by_title('About Us');
                                    echo get_post_meta($page->ID, 'quotation', true); ?> <br>
                                    <span>- <?php echo get_post_meta($page->ID, 'quotation-person', true); ?></span>
                                </h4>
                                <i class="fa fa-quote-right fa-3x fa-pull-right" aria-hidden="true"></i>
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
