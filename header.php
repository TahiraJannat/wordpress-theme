<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @since 1.0.0
 * @package eMega 
 */
// phpcs:ignore 

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/1 1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'emega'); ?></a>

		<header id="masthead" class="site-header emg-container emg-mx-auto  emg-flex emg-h-20 emg-items-center emg-bg-white emg-justify-between">
			<div class="site-branding emg-basis-1/4 ">
				<?php

				$blog_info    = get_bloginfo('name');
				$description  = get_bloginfo('description', 'display');
				$show_title   = (true === get_theme_mod('display_title_and_tagline', true));
				$header_class = $show_title ? 'site-title' : 'screen-reader-text';

				?>
				<?php if (has_custom_logo() && $show_title) : ?>
					<div class="site-logo"><?php the_custom_logo(); ?></div>
				<?php elseif (!has_custom_logo()) : ?>
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/cyberLogo.png'); ?>" alt="Default Logo" class="emega-logo" width="80" height="50" />
				<?php endif; ?>


				<div class="site-branding">

					<?php if (has_custom_logo() && !$show_title) : ?>
						<div class="site-logo"><?php the_custom_logo(); ?></div>
					<?php endif; ?>

					<?php if ($blog_info) : ?>
						<?php if (is_front_page() && !is_paged()) : ?>
							<h1 class="<?php echo esc_attr($header_class); ?>"><?php echo esc_html($blog_info); ?></h1>
						<?php elseif (is_front_page() && !is_home()) : ?>
							<h1 class="<?php echo esc_attr($header_class); ?>"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($blog_info); ?></a></h1>
						<?php else : ?>
							<p class="<?php echo esc_attr($header_class); ?>"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($blog_info); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ($description && true === get_theme_mod('display_title_and_tagline', true)) : ?>
						<p class="site-description">
							<?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput 
							?>
						</p>
					<?php endif; ?>
				</div><!-- .site-branding -->


			</div><!-- .site-branding -->

			<div class="emg-basis-9/12">
				<nav id="site-navigation" class="emg-main-navigation emg-p-4 emg-flex emg-items-center">
					<button class="emg-menu-toggle emg-hidden" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'emega'); ?></button>

					<?php
					// Nav Menu
					$defaults = array(
						'theme_location'  => 'primary-menu',
						'menu'            => '',
						'container'       => 'ul',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'emg-inline-flex emg-space-x-4 emg-menu  "', // Add a specific class to the ul
						'menu_id'         => 'primary-menu',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id=" %1$s" class="%2$s">%3$s <a class=""></a></ul>',
						'depth'           => 0,
						'walker'          => ''
					);
					wp_nav_menu($defaults);
					?>

				</nav><!-- #site-navigation -->
			</div>
			<header class="page-header">
<h1 class="page-title">
    <?php printf( __( 'Search Results for: %s', 'twentyfifteen' ), get_search_query() ); ?>
</h1>
</header><!-- .page-header -->

		</header><!-- #masthead -->