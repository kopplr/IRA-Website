<?php
get_header();
$cat_id = get_cat_ID(single_cat_title("", false)); // Get the current category id
$curr_cat = get_category($cat_id);
?>


<div class="site-content clearfix" style="display:table;">
    <div class="sidebar-column">
<!--
        <div class="button-group filter-button-group">
        <ul>
            <li><button data-filter="*">show all</button></li>
            <li><button data-filter=".fact-sheets">fact sheets</button></li>
            <li><button data-filter=".fact-book">fact book</button></li>
            <li><button data-filter=".surveys">surveys</button></li>

        </ul>

        </div>
-->

        <nav>
            <?php

            $walker = new my_nav_walker;

            $args = array(
                'theme_location' => 'sidebar',
                'container_class' => 'button-group filter-button-group',
                'walker' => $walker
            );

            ?>

            <?php
            wp_nav_menu($args)

            ?>
        </nav>
        <nav>
            <div class="button-group filter-button-group">
                <ul>
                    <li><button class="is-checked" data-filter=".<?php echo $curr_cat->slug; ?>">Show All</button></li>
                    <?php
                        $categories = get_categories(array('child_of' => $cat_id));
                        foreach($categories as $category){
                            echo '<li><button data-filter=".' . $category->slug . '" class="' . ($category->category_parent != $cat_id ? "child-category" : "") . '">' . $category->name . '</button></li>';
                            if($category->category_parent != $cat_id){
                               // var_dump($category);
                            }
                        }
                    ?>
                </ul>
            </div>
        </nav>

    </div>
    <div class="main-column">
        <?php


//            echo '<pre>';
//            print_r($category);
//            echo '</pre>';
        ?>
        <div class="grid">
            <?php

            query_posts(array(
                'cat' => $cat_id,
                'orderby' => 'title', // Order alphabetically
                'order' => 'ASC',
                'posts_per_page' => -1 // Display all posts of the category
            ));

            if (have_posts()) :
                while (have_posts()) : the_post();
            ?>


                <div class="element-item <?php $cats = get_the_category(); foreach ($cats as $cat){ echo $cat->slug . ' ';} ?>"> <!-- Add in categories as classes to be able to filter in Isotope -->

                    <a href="<?php echo get_permalink(); ?>"> <!-- Link to post -->
                        <article class="post">
                            <h1><?php the_title() ?></h1>
                            <?php the_content()?>
                        </article>
                    </a>
                </div>

                <?php endwhile;


                else :
                    echo '<p>NO content found</p>';
            endif;
            wp_reset_query();
            ?>
        </div>
    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>

</div>



<?php
get_footer();
?>
