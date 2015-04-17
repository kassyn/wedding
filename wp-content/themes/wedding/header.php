<?php if ( ! function_exists( 'add_action' ) ) exit; ?>
<?php
/**
 * The header template file.
 *
 * @package WordPress
 * @subpackage Theme
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php w_the_page_title(); ?></title>
	<link rel="stylesheet" href="<?php echo w_get_stylesheet_uri(); ?>">
	<link rel="shortcut icon" href="<?php w_the_image( 'favicon.png' ); ?>" type="image/x-icon" />
	<meta property="og:locale" content="pt_BR" />	
	<meta property="og:site_name" content="<?php w_the_page_title(); ?>" />
	<meta property="og:title" content="<?php w_the_page_title(); ?>" />
	<meta property="og:description" content="Confira os detalhes do casório e não esqueça de confirmar sua presença!" />
	<meta property="og:url" content="<?php echo site_url(); ?>" />	
	<meta property="og:image" content="<?php w_the_image( 'branding-400x400.png' ); ?>" />
	<?php wp_head(); ?>
</head>
<body data-route="home">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-61978519-1', 'auto');
		ga('send', 'pageview');
	</script>
	
	<div id="wrapper">