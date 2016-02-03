
            <!-- site-footer -->
            <footer class="site-footer">

                <nav class="site-nav">
                    <?php

                    $args = array(
                        'theme_location' => 'footer'
                    );

                    ?>

                    <?php wp_nav_menu( $args ); ?>
                </nav>
                <div id="mcmaster-footer">
                    <p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?> </p>
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/mcmaster_logo.jpg" alt="McMaster Logo" style="width:250px;height:136px">
                </div>

            </footer><!-- /site-footer -->

        </div><!-- /container -->

        <?php wp_footer(); ?>
    </body>
</html>
