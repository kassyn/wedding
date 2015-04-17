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