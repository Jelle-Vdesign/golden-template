<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/views/content/nav.php';
?>
<nav class="type1-menu">
    <ul class="visible-menu ">

        <?php foreach($menuBlockItems as $mainItem) : ?>

            <li><a href="/<?php echo $mainItem->blockUrl; ?>"><span class="icon"><img src="/images/icons2/watch-icon.svg" alt=""></span><span><?php echo $mainItem->menuTitle; ?></span> </a></li>


<!--            <li><a href=""><span class="icon"><img src="../../images/icons2/watch-icon.svg" alt=""></span><span>Horloges</span> </a></li>-->
<!--            <li><a href=""><span class="icon"><img src="../../images/icons2/watch-icon.svg" alt=""></span>item 1</a></li>-->
<!--            <li><a href=""><span class="icon"><img src="../../images/icons2/watch-icon.svg" alt=""></span>item 1</a></li>-->
<!--            <li><a href=""><span class="icon"><img src="../../images/icons2/watch-icon.svg" alt=""></span>item 1</a></li>-->
<!--            <li><a href=""><span class="icon"><img src="../../images/icons2/watch-icon.svg" alt=""></span>item 1</a></li>-->
<!--            <li><a href=""><span class="icon"><img src="../../images/icons2/watch-icon.svg" alt=""></span>item 1</a></li>-->

        <?php endforeach; ?>
      
        <button type="button" class="check-toggle" data-text-swap='
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" viewBox="0 0 25 25"><defs><clipPath id="b"><rect width="25" height="25"/></clipPath></defs><g id="a" clip-path="url(#b)"><rect width="25" height="25" fill="#fff"/><g transform="translate(1084 653)"><circle cx="3.5" cy="3.5" r="3.5" transform="translate(-1084 -644)" fill="#6e6e6e"/><circle cx="3.5" cy="3.5" r="3.5" transform="translate(-1075 -644)" fill="#6e6e6e"/><circle cx="3.5" cy="3.5" r="3.5" transform="translate(-1066 -644)" fill="#6e6e6e"/></g></g></svg>
            minder'    
             style="display:none">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" viewBox="0 0 25 25"><defs><clipPath id="b"><rect width="25" height="25"/></clipPath></defs><g id="a" clip-path="url(#b)"><rect width="25" height="25" fill="#fff"/><g transform="translate(1084 653)"><circle cx="3.5" cy="3.5" r="3.5" transform="translate(-1084 -644)" fill="#6e6e6e"/><circle cx="3.5" cy="3.5" r="3.5" transform="translate(-1075 -644)" fill="#6e6e6e"/><circle cx="3.5" cy="3.5" r="3.5" transform="translate(-1066 -644)" fill="#6e6e6e"/></g></g></svg>
            meer
        </button>

    </ul>
    <ul class="hidden-menu" style="display:none;"></ul>
</nav>

<!--<script src="../../js/collapsing-menu2.js" >-->
<!-- verplaatst naar meta/js.php -->
<!---->
<!--</script>-->