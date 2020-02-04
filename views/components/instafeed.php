<?php
$it = 0;
if(!empty($getInstaItems)) {
    for($i=0;$i<4;$i++) {
        foreach($getInstaItems as $instaItem) {
            $it++;
            switch($instaItem->typeName) {

                default:
                    $instaIcon = 'img';
                    break;

                case 'GraphVideo':
                    $instaIcon = 'vid';
                    break;

                case 'GraphSidecar':
                    $instaIcon = 'car';
                    break;
            }

            try {
                $eventSubDate = new DateTime($instaItem->feedDate);
                $timeStamp = $eventSubDate->getTimestamp();
                $date = strftime("%a %e %b &#39;%y", $timeStamp);
            } catch(Exception $e) {
                e_print($e->getMessage());
            }

            if($it == 5) {
                ?>
                <article class="insta_item large">
                    <div class="content txt_a_c_mob">
                        <div class="spcr_v px12 mob_only small_tab_only"></div>
                        <h1 class="page_title"><?php echo $block->title; ?></h1>
                        <div class="spcr_v px12 mob_only small_tab_only"></div>
                    </div>
                </article>
                <article class="insta_item large  txt_a_c">
                    <div class="content txt_a_c">
                        <a target="_blank" rel="noopener" href="<?php echo $tags['social_instagram'][$langID]; ?>">
                            <div class="icon instagram std_bg dsp_inl dsp_v_m"></div>
                            <div class="spcr_h px12 dsp_inl"></div>
                            <p class="txt_s_m dsp_inl dsp_v_m">@<?php echo $instaItem->username; ?></p>
                        </a>
                    </div>
                </article>
                <?php
            }
            ?>
            <article class="insta_item">
                <figure>
                    <div class="img ll" data-original="<?php echo $instaItem->link; ?>media?size=l"
                         style="background-image: url()"></div>
                </figure>
                <div class="overlay trans_all">
                    <div class="date"><?php echo $date; ?></div>
                    <div class="spcr_v px12"></div>
                    <div class="comment">
                        <div class="tab_only dsk_only large_dsk_only"><?php echo $instaItem->caption; ?></div>
                        <a href="<?php echo $instaItem->link; ?>" target="_blank" rel="noopener"><p>
                                @<?php echo $instaItem->username; ?></p></a>
                    </div>
                    <div class="labels">
                        <div class="label">
                            <div class="icon small std_bg insta_likes wh dsp_inl dsp_v_m"></div>
                            <div class="text dsp_inl dsp_v_m"><?php echo $instaItem->likes ?></div>
                        </div>
                        <div class="label">
                            <div class="icon small std_bg insta_comments wh dsp_inl dsp_v_m"></div>
                            <div class="text dsp_inl dsp_v_m"><?php echo \functions\Textual::leesverderwords($instaItem->comments, 200); ?></div>
                        </div>
                        <div class="label">
                            <div class="icon small std_bg insta_<?php echo $instaIcon; ?> wh dsp_inl dsp_v_m"></div>
                        </div>
                        <div class="label">
                            <a href="<?php echo $instaItem->link; ?>" target="_blank" rel="noopener">
                                <div class="icon small std_bg insta_link wh dsp_inl dsp_v_m"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <?php
        }
    }
}
?>