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
	
	<div id="wrapper" class="active-for">