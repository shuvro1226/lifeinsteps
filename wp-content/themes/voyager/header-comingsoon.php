<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?php cstheme_favicon(); ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script type="text/javascript">
        var cstheme_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

		<div id="page-wrap">