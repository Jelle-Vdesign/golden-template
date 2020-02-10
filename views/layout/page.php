<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/page.php';
?>

<section <?php if($block->blockID == 4): ?>id="services"<?php endif; ?>>
    <article>
        <h2><?php echo $block->title; ?></h2>
        <?php echo $block->content; ?>
    </article>
</section>

<?php if($block->blockID == 3) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/views/layout/products.php';
} ?>

<?php if($block->blockID == 4) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/views/layout/services.php';
} ?>
