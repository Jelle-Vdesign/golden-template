<section id="page">
	<div class="content_width">
		<div class="page_main_title bg_c_1">
			<div class="dsp_inl dsp_v_m">
				<h1 class="txt_c_wh">Pagina niet gevonden</h1>
			</div>
		</div>
	</div>
	<div class="spcr_v px24"></div>
	<div class="spcr_v px24 tab_only dsk_only large_dsk_only"></div>
	<div class="content_width sw_side">
		<div class="content_col mob_no_pad rel_pages">
		</div>
		<div class="spcr_v px24 mob_only small_tab_only"></div>
		<div class="content_col txt_c_wh content_block cvr bl">
			<div class="spcr_v px24 mob_only small_tab_only"></div>
			<div class="spcr_v px24"></div>
			<?php echo \functions\Misc_front::addReadMore($block->content); ?>
		</div>
		
	</div>
</section>
<?php
	if(isset($subBlocks) && count($subBlocks)>0){
?>
		<section class="content_width content_pad">
			<?php
				if(count($pageImgs) > 0 || count($pageVids) > 0){
			?>
					<div class="spcr_v px48"></div>
					<div class="page_title bg_c_wh txt_c_1 rounded"><p><strong>Media</strong></p></div>
					<div class="spcr_v px12"></div>
			<?php
					foreach($pageVids as $vid){
			?>
						<div class="thumb dsp_inl page_vid_hldr"><iframe class="page_vid" src="https://www.youtube.com/embed/<?php echo $vid->name; ?>?autohide=1&modestbranding=1&rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
			<?php
					}
					foreach($pageImgs as $img){
			?>
						<figure class="thumb dsp_inl">
							<div class="img" data-lightbox="<?=$block->title?>" data-img="<?=$img->src?>" style="background-image: url(<?=$img->src_t?>)"></div>
						</figure>
			<?php
					}
				}
			?>
		</section>
<?php
	}
?>
<div class="spcr_v px96"></div>