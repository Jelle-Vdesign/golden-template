<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/products.php';

foreach($products as $product) {
?>

<section class="product">

    <article>
        <figure>
            <img src="../../images/seiko-astron.png" alt="">
        </figure>
        <aside>
            <h2><?php echo $product->subtitle; ?> <?php echo $product->title; ?></h2>
            <?php echo $product->description; ?>
            <a class="button one" href="/product/<?php echo $product->url; ?>"> Bekijk </a>
        </aside>
    </article>
</section>

<?php } ?>