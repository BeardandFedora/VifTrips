<?php
/**
 * The Header
 *
 * @package VifTrips
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8" />
  		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title( ' - ', true, 'right' ); ?></title>

		<meta name="viewport" content="width=device-width">
		<meta name="author" content="Beard & Fedora">

		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>?v="<?php echo VIF_THEME_VERSION; ?>>

		<?php vif_the_css_for_custom_colors(); ?>

		<!-- <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico?v="<?php echo VIF_THEME_VERSION; ?> /> -->
  
		<?php /* For iPhone 4 with high-resolution Retina display */ ?>
		<!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png"> -->
		<?php /* For first-generation iPad */ ?>
		<!-- <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png"> -->
		<?php /* For non-Retina iPhone, iPod Touch, and Android 2.1+ devices */ ?>
		<!-- <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png"> -->

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!--[if lt IE 9]>
			<script src="<?php echo VIF_URL_JS; ?>/html5shiv.js" type="text/javascript"></script>
		<![endif]-->

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<!--[if lt IE 8]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

		<div id="page" class="hfeed site">

			<?php do_action( 'before' ); ?>

			<header id="masthead" class="site-header" role="banner">

				<div>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span><?php bloginfo( 'name' ); ?></span></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'lang_viftrips' ); ?></h3>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'lang_viftrips' ); ?>"><?php _e( 'Skip to content', 'lang_viftrips' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'clearfix', 'menu_class' => 'nav-menu clearfix' ) ); ?>
				</nav>

				<?php vif_the_social_icons_buttons(); ?>				

			</header>

			<div id="main" class="site-main clearfix">

				<?php vif_the_trips_list_nav(); ?>

				<div id="wrap-main-content">
					<div id="main-content-inner" class="clearfix">
