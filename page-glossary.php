<?php get_header(); ?>

<div class="site-title">

    <div style="flex: 1;" ></div>
    <div style="flex: 1; order: 99;"></div>
    <div style="flex: 1 1 1000px">
        <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php endwhile; ?>
    </div>

</div>
<div id="main-content">
    <div style="flex: 1;"  ></div>
    <div style="flex: 1; order: 99;"></div>
    <div class="site-content">
        <div class="main-column">
            <?php while ( have_posts() ) : the_post(); ?>


            </article>
            <?php

            $taxonomy = 'alpha';

    // save the terms that have posts in an array as a transient
    if ( false === ( $alphabet = get_transient( 'kia_archive_alphabet' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient
        $terms = get_terms($taxonomy);

        $alphabet = array();

        if($terms){
            foreach ($terms as $term){
                $alphabet[] = $term->slug;
            }
        }

        set_transient( 'kia_archive_alphabet', $alphabet );
    }

    ?>

            <div id="archive-menu" class="menu">

                <ul id="alphabet-menu">
                    <li class="az-char menu-item"><a href="#0-9">0-9</a></li>
                <?php
                foreach(range('a', 'z') as $i) :

                    $current = ($i == get_query_var($taxonomy)) ? "current-menu-item" : "menu-item";

                    if (in_array( $i, $alphabet )){
                        printf( '<li class="az-char %s"><a href="#%s">%s</a></li>', $current, $i, strtoupper($i) );
                    } else {
                        printf( '<li class="az-char %s">%s</li>', $current, strtoupper($i) );
                    }

                endforeach;

                ?>
                </ul>

            </div>



            <?php
            $glossary_posts = get_posts( array(
                'post_type' => 'glossary',
                'posts_per_page' => -1, // Unlimited posts
                'orderby' => 'title', // Order alphabetically by name
                'order' => 'ASC'
            ));

            if ( $glossary_posts ):
            ?>
            <!--
                <section style="height:500px;">
                    <h2 id="a">A</h2>
                    <dl>
                        <dt>Academic Load</dt>
                        <dd>Formerly 'Registration Status'; refers to whether a student is classified as full-time or part-time, as reported by the Office of the Registrar. In most cases a student is classified as full-time if they are registered in 24 units in the Fall and Winter sessions. For more information please visit the website of the Office of the Registrar.</dd>
                        <dt>Akron</dt>
                        <dd>Home of Lebron</dd>
                    </dl>
                </section>
        -->
            <?php
            $previousletter = null;
            $counter = 0;
            foreach ( $glossary_posts as $post ):
                setup_postdata($post);

                // Get the title of the post
                $title = strtolower( $post->post_name );

                // The next few lines remove A, An, or The from the start of the title
                $splitTitle = explode(" ", $title);
                $blacklist = array("an","the");
                $splitTitle[0] = str_replace($blacklist,"",strtolower($splitTitle[0]));
                $title = implode(" ", $splitTitle);

                // Get the first letter of the title
                $letter = substr( $title, 0, 1 );

                // Set to 0-9 if it's a number
                if ( is_numeric( $letter ) ) {
                    $letter = '0-9';
                }
                echo (($letter != $previousletter && $counter != 0)?'</section>':'') .
                    (($letter != $previousletter)?'<section><h2 id="' . $letter . '">' . strtoupper($letter) . '</h2>':'') .
                    '<dl>' .
                    '<dt>' . $post->post_title . '</dt>' .
                    '<dd>' . $post->post_content . '</dd>' .
                    '</dl>';
                ?>



            <?php
                $previousletter = $letter;
                $counter++;
                endforeach;
                endif;
                endwhile;
            ?>

        </div>

    </div>
</div>
<?php get_footer(); ?>

