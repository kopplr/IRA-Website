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

        <?php
        endwhile;

        $categories = get_terms('ext_cats', array(
            'orderby' => 'term_id',
            'order' => 'DESC'
        ));
        foreach ($categories as $category) {
            $args = array(
                'post_type' => 'external',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'ext_cats',
                        'field' => 'term_id',
                        'terms' => array($category->term_id)
                )),
                'posts_per_page' => -1, // Unlimited posts
                'orderby' => 'title', // Order alphabetically by name
                'order' => 'ASC'
            );
            $posts = get_posts($args);
            if($posts) {
                echo '<h2>Category: <a id="' . $category->slug .'" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </h2> ';
                foreach($posts as $post) {
                  setup_postdata($post); ?>
                  <p><a href="<?php the_field('external_link_url'); ?>" target="_blank" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
                  <?php
                }
            }

        }

        ?>




    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>
</div>

<?php get_footer(); ?>
