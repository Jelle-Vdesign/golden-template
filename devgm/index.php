<?php
session_start();

require_once realpath(__DIR__).'/init.php';

/* GET CONTENT */
include_once($_SERVER['DOCUMENT_ROOT'].'/views/getinfo.php');

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
	<head>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/meta/tags.php'); ?>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/meta/crit_css.php'); ?>
		<link rel="stylesheet" type="text/css" href="./stylesheets/css/main.min.css">

	</head>
	<body>
		
		<nav>
		kanarie23
			<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/nav.php'); ?>
		</nav>
		<header class="">
			<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/header.php'); ?>
		</header>
		<main>
			<?php // include_once($_SERVER['DOCUMENT_ROOT'].'/views/page/'.$page.'.php'); ?>
		</main>
		<div class="spcr_v px120"></div>
		<footer>
			<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/footer.php'); ?>
		</footer>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/whatsapp.php'); ?>

        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/meta/js.php'); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT'].'/meta/css.php'); ?>
	</body>
</html>