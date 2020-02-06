<div id="wapp_trggr_dsk" class="trans_bg">
    <div class="text txt_c_wh dsp_inl"><?php echo $tags['whatsapp_button'][$langID]; ?></div>
    <div class="icon_hldr dsp_inl">
        <div class="icon small wapp wh std_bg"></div>
    </div>
</div>
<div id="wapp_hldr">
    <div id="wapp_overlay"></div>
    <div id="wapp">
        <div id="wapp_header">
            <div id="wapp_user_profile"></div>
            <div id="wapp_user_name"><?php echo $tags['whatsapp_username'][$langID]; ?></div>
            <div id="wapp_user_note"><?php echo $tags['whatsapp_usernote'][$langID]; ?></div>
            <div id="wapp_status">online</div>
            <div id="wapp_close">
                <div class="icon small back wh std_bg"></div>
            </div>
        </div>
        <div id="wapp_msg_box">
            <div id="wapp_msg">
                <div id="wapp_msg_content">
                    <div id="wapp_msg_txt">
                        <?php echo $tags['whatsapp_startbericht'][$langID]; ?>
                        <span id="wapp_msg_info">
							<div id="wapp_msg_time"><?php echo date("H:i"); ?></div>
							<div id="wapp_msg_icon"></div>
						</span>
                    </div>
                </div>
            </div>
        </div>
        <div id="wapp_send_box">
            <div id="wapp_send_btn">
                <div id="wapp_send_icon"></div>
            </div>
            <div id="wapp_send_msg">
                <input id="wapp_indtfr" type="hidden" value="<?php echo base64_encode('https://api.whatsapp.com/send?phone='.$tags['whatsapp_nummer'][$langID].'&abid='.$tags['whatsapp_nummer'][$langID].'&text='); ?>"/>
                <input id="wapp_inp_msg" type="text" placeholder="Typ een bericht" />
            </div>
        </div>
    </div>
</div>