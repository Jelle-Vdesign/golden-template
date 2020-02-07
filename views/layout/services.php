<?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/services.php';?>

<section id="services">

    <h2><?php echo $block->title; ?></h2>
    <article>
    <?php if($subBlocks):
       foreach($subBlocks as $subBlock): ?>

        <a href="/">
            <img class="circle" src="../../images/smith.jpg" alt="">
            <?php echo $subBlock->title; ?>
        </a>

        <?php endforeach;
    endif; ?>

    </article>
</section>
