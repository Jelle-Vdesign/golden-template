<div class="header_spcr"></div>
<section>
	<div class="spcr_v px24 mob_only small_tab_only tab_only"></div>
	<div class="content_width content_pad txt_a_c insta_items">
        <?php if($setInsta == true) {
            include_once $_SERVER['DOCUMENT_ROOT'] . '/views/components/instafeed.php';
        }?>
	</div>
</section>
<section id="page" class="home">
	<div class="spcr_v px48"></div>
	<div class="spcr_v px24 dsk_only large_dsk_only"></div>
	<div class="page_col">
		<div class="page_img_hldr txt_a_c">
			<div class="slidr">
			<?php
				foreach($pageImgs as $pageImg){
			?>
					<figure class="page_img">
						<div class="img" data-original-medium="<?php echo $pageImg->src; ?>" data-original-large="<?php echo $pageImg->src_l; ?>" style="background-image: url(<?php echo $pageImg->src_t; ?>)"></div>
					</figure>
			<?php
				}
			?>
			</div>
		</div>
	</div>
	<div class="page_col std">
		<div class="spcr_v px48 dsk_only"></div>
		<div class="spcr_v px96 large_dsk_only"></div>
		<div class="page_txt">
			<?php echo \functions\Misc_front::addReadMore($block->content)?>
		</div>
		<div class="spcr_v px48 dsk_only"></div>
		<div class="spcr_v px96 large_dsk_only"></div>
	</div>
</section>