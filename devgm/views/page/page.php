<div class="header_spcr"></div>
<section id="page" class="home">
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
	<div class="page_col">
		<div class="spcr_v px48 dsk_only"></div>
		<div class="spcr_v px96 large_dsk_only"></div>
		<h1 class="page_title"><?php echo $block->title; ?></h1>
		<div class="spcr_v px48"></div>
		<div class="page_txt">
			<?php echo \functions\Misc_front::addReadMore($block->content)?>
		</div>
	</div>
</section>
