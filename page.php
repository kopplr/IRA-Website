<?php get_header(); ?>
<div class="site-title" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/arch_skinny.jpeg);">

    <div style="flex: 1;" ></div>
    <div style="flex: 1; order: 99;"></div>
    <div style="flex: 1 1 1000px">
        <?php while ( have_posts() ) : the_post(); ?>
        <h2><?php the_title(); ?></h2>

    </div>

</div>
<div id="main-content">
    <div style="flex: 1;"  ></div>
    <div style="flex: 1; order: 99;"></div>
    <div class="site-content">
        <div class="main-column">
            <?php the_content(); ?>

        </div>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
