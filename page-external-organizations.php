<?php get_header(); ?>

<div class="site-title">
    <?php while ( have_posts() ) : the_post(); ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
        </article>



        <?php endwhile; ?>
</div>
<div class="site-content">
    <div class="sidebar-column">
        <nav>
            <div class="button-group filter-button-group">
                <ul>
                    <li><button class="is-checked" data-filter="*">Show All</button></li>
                    <?php
                        $categories = get_terms('ext_cats', array(
                            'orderby' => 'parent',
                         //   'order' => 'DESC'
                        ));
                        foreach($categories as $category){
                            echo '<li><button data-filter=".' . $category->slug . '">' . $category->name . ' ' . $category->category_parent . '</button></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main-column">
        <div class="grid">
        <?php
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
            ); ?>

            <div class="element-item
                        <?php echo $category->slug ?>
                        <?php //echo ($category->slug == 'institutional-research-offices')?'inline-layout':''?>
                        "> <!-- Add in categories as classes to be able to filter in Isotope -->

            <?php
            $posts = get_posts($args);
            if($posts) {
                echo '<h2><a id="' . $category->slug .'">' . $category->name.'</a> </h2> ';
                foreach($posts as $post) {
                  setup_postdata($post); ?>





                    <a href="<?php the_field('external_link_url'); ?>" target="_blank"> <!-- Link to post -->
                        <article class="post">
                            <?php
                                echo '<h1>' . $post->post_title . '</h1>';
                            ?>

                        </article>
                    </a>


                <?php } ?>
            <?php } ?>
            </div> <!-- End of element-item-->
        <?php } ?>
        </div> <!-- End of grid-->





    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>
</div>

<?php get_footer(); ?>
