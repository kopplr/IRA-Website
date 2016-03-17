<?php get_header(); ?>


<div class="site-content clearfix" style="display:table;">
    <div class="sidebar-column">
    </div>
    <div class="main-column">

        <?php while ( have_posts() ) : the_post(); ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
        </article>



        <?php endwhile; ?>


    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>
</div>

<?php get_footer(); ?>
