<?php

get_header();

/**
 * Template Name: Team
 */

the_post(); ?>

	<div class="intro" style="margin-left: 10px;">
		<h2>Meet The Team</h2>
		<p class="lead">&ldquo;Individuals can and do make a difference, but it takes a team<br>to really mess things up.&rdquo;</p>
	</div>

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
            <div id="map" style="width:1000px; height: 500px"></div>

        </div>

        <div id="tab3" class="tab">
            <img src="http://localhost/wordpress/wp-content/uploads/2016/03/Our-Community-e1457451367803.png">
        </div>

    </div>
</div>


<?php
get_footer();

?>
