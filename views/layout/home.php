<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/home.php';
?>
    <section id="hero">
        <h1><?php echo $block->subtitle; ?></h1>
        <figure>
            <img src="../../images/golden-watch1.png" alt="">
        </figure>
    </section>

    <section id="product-description">
        <article>
            <?php echo $block->content; ?>
            <div class="button-bar">
                <a class="button two" href="">Specificaties</a>
                <a class="button one" href="<?php echo $cBlock->getPath(3); ?>">Bekijk alle horloges</a>
            </div>
        </article>
    </section>

    <section id="about">
        <article>
            <?php echo $block->content_2; ?>
        </article>
    </section>

    <figure>
        <img src="../../images/smith.jpg" alt="">
    </figure>