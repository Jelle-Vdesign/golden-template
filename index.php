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
		
		<!-- <nav> -->
		<!-- </nav> -->
		<header class="">
			<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/header.php'); ?>
		</header>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/nav.php'); ?>

		<main>
<!--			--><?php //include_once($_SERVER['DOCUMENT_ROOT'].'/views/page/home.php'); ?>
<!--			--><?php //include_once($_SERVER['DOCUMENT_ROOT'].'/views/page/products.php'); ?>
<!--			--><?php //include_once($_SERVER['DOCUMENT_ROOT'].'/views/page/info.php'); ?>
<!--			--><?php //include_once($_SERVER['DOCUMENT_ROOT'].'/views/page/single-product.php'); ?>
<!--			--><?php //include_once($_SERVER['DOCUMENT_ROOT'].'/views/page/contact.php'); ?>

			<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/layout/'.$layout.'.php'); ?>
		</main>
		<!-- <div class="spcr_v px120"></div> -->
		<footer>
			<?php include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/footer.php'); ?>
		</footer>
		<?php //include_once($_SERVER['DOCUMENT_ROOT'].'/views/components/whatsapp.php'); ?>

        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/meta/js.php'; ?>
        <?php //include_once($_SERVER['DOCUMENT_ROOT'].'/meta/css.php'); ?>
	</body>
</html>