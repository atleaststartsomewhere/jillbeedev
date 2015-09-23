<!DOCTYPE html>
<html>
	<head>
		<!-- META-->
		<meta name="description" content="META:DESCRIPTION">
		<meta name="author" content="Andy Pyle">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="og:title" content="OPENGRAPH:TITLE">
		<!--meta(name='og:image', content='OPENGRAPH:IMAGE')-->
		<meta name="og:description" content="OPENGRAPH:DESCRIPTION">
		<title>PAGE TITLE</title>
		<!-- STYLESHEETS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//brick.a.ssl.fastly.net/Open+Sans:300,400,700,900">
		<link rel="stylesheet" href="<?php echo $react_url; ?>/styles/style.min.css">
	</head>
	<body>
		<main id="main" class="js_simple simple">
		</main>
		<div class="isVisible"></div>
		<!-- SCRIPTS-->
		<script type="text/javascript">
			localStorage.setItem(<?php echo('"'.$storedClientKey.'"');?>,<?php echo('"'.$storedClientValue.'"');?>);
		</script>
		<script src="<?php echo $react_url; ?>/js/scripts.min.js"></script>
	</body>
</html>