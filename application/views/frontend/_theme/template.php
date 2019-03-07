<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex, nofollow">

    <title>VStore - [CMS 1.0.0]</title>

	<link href="<?php echo $path_asset_theme_global; ?>/css/fonts/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $path_asset_theme_global; ?>/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $path_asset_theme_frontend; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $path_asset_theme_frontend; ?>/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $path_asset_theme_frontend; ?>/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $path_asset_theme_frontend; ?>/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $path_asset_theme_frontend; ?>/css/colors.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $path_asset_theme_frontend; ?>/css/custom.css" rel="stylesheet" type="text/css">

	<script src="<?php echo $path_asset_theme_global; ?>/js/main/jquery.min.js"></script>
	<script src="<?php echo $path_asset_theme_global; ?>/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $path_asset_theme_global; ?>/js/plugins/loaders/blockui.min.js"></script>
	<script src="<?php echo $path_asset_theme_global; ?>/js/plugins/notifications/sweet_alert.min.js"></script>
	<script src="<?php echo $path_asset_theme_global; ?>/js/plugins/number/jquery.number.min.js"></script>
	<script src="<?php echo $path_asset_theme_frontend; ?>/js/app.js"></script>
	<script src="<?php echo $path_asset_theme_frontend; ?>/js/custom.js"></script>

	<script>
		window.url_base_frontend = '<?php echo $url_base_frontend; ?>';
		window.path_asset_theme_global = '<?php echo $path_asset_theme_global; ?>';
	    window.path_asset_theme_frontend = '<?php echo $path_asset_theme_frontend; ?>';
	    window.private_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';
		window.text_loading = '<?php echo $this->lang->line('text_loading'); ?>';
	</script>
</head>
<body class="navbar-top">
	<div class="page-content">
		<div class="content-wrapper">
			<div class="content">
				<?php echo $view_content; ?>
			</div>
		</div>
	</div>
</body>
</html>