<div class="header_spcr"></div>
<section id="page" class="home">
    <div class="page_col">
        <div class="page_img_hldr txt_a_c">
            <div class="slidr">
                <?php
                if(!empty($pageImgs)) {
                    foreach($pageImgs as $pageImg) {
                        ?>
                        <figure class="page_img">
                            <div class="img" data-original-medium="<?php echo $pageImg->src; ?>" data-original-large="<?php echo $pageImg->src_l; ?>" style="background-image: url(<?php echo $pageImg->src_t; ?>)"></div>
                        </figure>
                        <?php
                    }
                }
                    ?>
            </div>
        </div>
    </div>
    <div class="page_col">
        <div class="spcr_v px48 dsk_only"></div>
        <div class="spcr_v px96 large_dsk_only"></div>
        <h1 class="page_title"><?php echo $block->title; ?></h1>
        <div class="spcr_v px48"></div>
        <div class="page_txt">
            <?php echo \functions\Misc_front::addReadMore($block->content); ?>
        </div>
        <div class="spcr_v px24"></div>
        <div class="button_w_subs dsp_inl">
            <div class="button bg_c_1 bg_c_bl_hv txt_c_wh dsp_inl trans_all">
                <div class="content">
                    <div class="text">Menukaart</div>
                </div>
            </div>
            <div class="button_subs trans_all">
                <?php
                if( !empty($mainmenu) && isset($mainmenu[1]) && isset($mainmenu[1]['subs']) ) {
                    foreach($mainmenu[1]['subs'] as $item) {
                        ?>
                        <a href="<?php echo $item['url']; ?>">
                            <div class="button bg_c_1 bg_c_bl_hv txt_c_wh dsp_inl">
                                <div class="content">
                                    <div class="text"><?php echo $item['title']; ?></div>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>