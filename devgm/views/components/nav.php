<nav>
    <ul id="visible-menu">
        <li>item 1</li>
        <li>item 2</li>
        <li>item 3</li>
    </ul>
    <ul id="hidden-menu" style="display:none;"></ul>
</nav>

<script>

var allContainers = document.getElementsByClassName("checkbox-container");

var breaks = [];

for (var i = 0; i < allContainers.length; i++) {
    breaks[i] = [];
}
console.log(breaks);

function updateList() {

    for (var i = 0; i < allContainers.length; i++) {
        var parent = allContainers[i];
        var btn = parent.getElementsByTagName("button")[0];
        var vlinks = parent.getElementsByTagName("ul")[0];
        var hlinks = parent.getElementsByTagName("ul")[1];
    
        var availableSpace = btn ? parent.offsetWidth : parent.offsetWidth - btn.offsetWidth - 30;

        console.log(breaks);
        if(vlinks.offsetWidth > availableSpace){
       
            breaks[i].push(vlinks.offsetWidth);
            var vlastLi = vlinks.lastElementChild.previousElementSibling;
            hlinks.insertBefore(vlastLi, hlinks.childNodes[0]);

            btn.style.display = "block";
    
        } else if(availableSpace > breaks[i][breaks[i].length-1]){
            console.log("exceeds");

            var hfirstLi = hlinks.firstChild;
            vlinks.insertBefore(hfirstLi, vlinks.lastElementChild);
            breaks[i].pop();

            if(breaks[i].length < 1){
                btn.style.display = "none";
            }
        }
        if(btn.innerHTML !== btn.getAttribute("data-text-swap")){
            btn.innerHTML = "+" + breaks[i].length;
        } 

        if(vlinks.offsetWidth > availableSpace) {
            updateList();
        }
    }

}

// Window listeners

window.addEventListener("resize", updateList);

window.addEventListener("click", function(e){
    if(e.target.classList.contains("check-toggle")){
        // updateList();
        var itsHlist = e.target.parentNode.nextElementSibling;
        if(itsHlist.style.display === "none"){
            this.console.log("gotem");
            itsHlist.style.display = "inline-flex";
            e.target.innerHTML = e.target.getAttribute("data-text-swap");

        } else {
            itsHlist.style.display = "none";
            e.target.innerHTML = "+" + itsHlist.children.length;

        }
        updateList();
    }
    
})

updateList();

</script>









































<div id="nav_inner" class="trans_all_mob">
    <ul id="nav">
        <div class="nav_part">
            <?php
            $currentSub = '';
            $splitMenu = ceil(count($mainmenu) / 2);
            foreach($mainmenu as $menuitem){
            if($splitMenu==$t){
            ?>
        </div>
        <a href="/"><li class="menu_split"></li></a>
        <div class="nav_part right">
            <?php
            }
            $t++;
            /*if($t==3){
    ?>
                <li id="wapp_trggr" class="nav_item_main app">
                    <div class="nav_item_content">
                        <div class="icon small wapp std_bg"></div>
                        <div class="spcr_v px6"></div>
                        <div class="nav_title">App ons</div>
                    </div>
                </li>
    <?php
            }*/
            $show_submenu = false;
            if(isset($menuitem['subs']) && count($menuitem['subs']) > 0){
                $show_submenu = true;
            }

            $current = $curMainMenuID==$menuitem['menuID'] ? 'current' : '';

            ?>
            <li class="nav_item_main <?php echo $menuitem['class']; ?> <?php echo $current?> <?php echo $t>$splitMenu ? 'right_item':''?>">
                <?php if($show_submenu==false){?><a href="<?php echo $menuitem['url']; ?>" <?php echo isset($menuitem['linktarget']) ? $menuitem['linktarget']:''?>><?php } ?>
                    <div class="nav_item_content">
                        <div class="icon small mob_only small_tab_only tab_only main menu_<?php echo $menuitem['icon']; ?> std_bg <?php echo $current?>"></div>
                        <div class="nav_title trans_c"><?php echo $menuitem['title']; ?></div>
                    </div>
                    <?php if($show_submenu==false){?></a><?php } ?>

                <?php if($show_submenu==true){ ?>
                    <div class="nav_overlay trans_all"></div>
                    <div class="sub_menu trans_all <?php echo $menuitem['showOptions']==true ? 'with_options' : ''?>">
                        <ul class="<?php echo $menuitem['showOptions']==true ? 'with_options' : ''?>">
                            <?php
                            if($menuitem['hasBlock']==1 && $menuitem['url']!='' && $menuitem['link']==true){
                                ?>
                                <li class="nav_item_sub lev1">
                                    <a href="<?php echo $menuitem['url']; ?>" class="item_link">
                                        <div class="nav_item_content sub">
                                            <div class="nav_title_sub dsp_inl"><?php echo ucfirst($menuitem['title'])?></div>
                                        </div>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <?php

                            foreach($menuitem['subs'] as $subitem){
                                $show_submenuC = false;
                                if(isset($subitem['subs']) && count($subitem['subs']) > 0){
                                    $show_submenuC = true;
                                }
                                $subm_id++;
                                ?>
                                <li data-subm="sub_<?php echo $subm_id?>" class="nav_item_sub lev1 <?php if($show_submenuC==true && $subitem['link']==false){ ?>unfold_sub<?php } ?> trans_all">
                                    <?php if($subitem['url']!='' && $subitem['link']==true){?><a href="<?php echo $subitem['url']; ?>"><?php } ?>
                                        <div class="nav_item_content sub">
                                            <?php if(isset($subitem['catID'])){?><div class="icon small cat_<?php echo $subitem['icon']; ?> wh std_bg"></div><?php } ?>
                                            <div class="nav_title_sub <?php if(isset($subitem['catID'])){?>dsp_inl<?php } ?>"><?php echo ucfirst($subitem['title'])?></div>
                                            <?php if($show_submenuC==true){ ?><div data-subm="sub_<?php echo $subm_id?>" class="icon hldr <?php if($show_submenuC==true && $subitem['url']!=''){ ?>unfold_sub<?php } ?> unfold_icon trans_all"><div class="icon small down std_bg"></div></div><?php } ?>
                                        </div>
                                        <?php if($subitem['url']!='' && $subitem['link']==true){?></a><?php } ?>
                                    <?php if($show_submenuC==true){ ?>
                                        <ul id="sub_<?php echo $subm_id?>" class="nav_item_fold trans_all">
                                            <?php foreach($subitem['subs'] as $folditem){ ?>
                                                <li class="nav_item_sub lev2">
                                                    <?php if($folditem['url']!='' && $folditem['link']==true){?><a href="<?php echo $folditem['url']; ?>" class="item_link"><?php } ?>
                                                        <div class="nav_item_content sub">
                                                            <div class="nav_title_sub"><?php echo ucfirst($folditem['title'])?></div>
                                                        </div>
                                                        <?php if($folditem['url']!='' && $folditem['link']==true){?></a><?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>
            </li>
            <?php
            }
            $subm_id++;
            ?>
        </div>
        <li id="nav_trigger" class="nav_item_main">
            <div class="nav_item_content">
                <?php /*<div class="icon small main menu wh std_bg"></div>*/ ?>
                <div class="icon main small">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
						<g id="menu">
                            <path id="menut" fill="#000" class="trans_all" d="M6.3,8h11.4c0.6,0,1-0.4,1-1s-0.4-1-1-1H6.3c-0.6,0-1,0.4-1,1S5.7,8,6.3,8z"/>
                            <path id="menum" fill="#000" class="trans_all" d="M6.3,13h11.4c0.6,0,1-0.4,1-1s-0.4-1-1-1H6.3c-0.6,0-1,0.4-1,1S5.7,13,6.3,13z"/>
                            <path id="menub" fill="#000" class="trans_all" d="M6.3,18h11.4c0.6,0,1-0.4,1-1s-0.4-1-1-1H6.3c-0.6,0-1,0.4-1,1S5.7,18,6.3,18z"/>
                        </g>
					</svg>
                </div>
                <div class="nav_title">menu</div>
            </div>
            <div class="nav_overlay trans_all"></div>
            <div id="main_menu" class="sub_menu trans_all">
                <ul>
                    <?php
                    $m=1;
                    foreach($mainmenu as $menuitem){
                        $show_submenu = false;
                        if(isset($menuitem['subs']) && count($menuitem['subs']) > 0){
                            $show_submenu = true;
                        }
                        $subm_id++;
                        $current = $curMainMenuID==$menuitem['menuID'] ? 'current' : '';
                        if($m==4){
                            ?>
                            <li class="nav_item_sub trans_all">
                                <a href="/">
                                    <div class="nav_item_content sub">
                                        <div class="nav_title_sub txt_c_1 dsp_inl">Home</div>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }

                        ?>
                        <li data-subm="sub_<?php echo $subm_id?>" class="nav_item_sub <?php if($show_submenu==true && ($menuitem['url']=='' || $menuitem['link']==false)){ ?>unfold_sub<?php } ?> trans_all <?php echo $menuitem['class']; ?>">
                            <?php if($menuitem['url']!='' && $menuitem['link']==true){?><a href="<?php echo $menuitem['url']; ?>"><?php } ?>
                                <div class="nav_item_content sub">
                                    <div class="nav_title_sub dsp_inl txt_c_1"><?php echo ucfirst($menuitem['title'])?></div>
                                    <?php if($show_submenu==true){ ?><div data-subm="sub_<?php echo $subm_id?>" class="icon hldr <?php if($show_submenu==true && $menuitem['url']!=''){ ?>unfold_sub<?php } ?> unfold_icon trans_all"><div class="icon small down wh std_bg"></div></div><?php } ?>
                                </div>
                                <?php if($menuitem['url']!='' && $menuitem['link']==true){?></a><?php } ?>
                            <?php if($show_submenu==true){ ?>
                                <ul id="sub_<?php echo $subm_id?>" class="nav_item_fold trans_all">
                                    <?php
                                    foreach($menuitem['subs'] as $subitem){
                                        $show_submenuC = false;
                                        if(isset($subitem['subs']) && count($subitem['subs']) > 0){
                                            $show_submenuC = true;
                                        }
                                        $submf_id++;
                                        ?>
                                        <li data-subm="sublev2_<?php echo $submf_id?>" class="nav_item_sub <?php if($show_submenuC==true && $subitem['link']==false){ ?>unfold_sub<?php } ?>">
                                            <?php if($subitem['url']!='' && $subitem['link']==true){?><a href="<?php echo $subitem['url']; ?>" class="item_link"><?php }?>
                                                <div class="nav_item_content sub">
                                                    <div class="spcr_h px12 dsp_inl"></div>
                                                    <div class="nav_title_sub dsp_inl"><?php echo ucfirst($subitem['title'])?></div>
                                                    <?php if($show_submenuC==true){ ?><div data-subm="sublev2_<?php echo $submf_id?>" class="icon hldr <?php if($show_submenuC==true && $subitem['url']!=''){ ?>unfold_sub<?php } ?> unfold_icon trans_all"><div class="icon small down std_bg"></div></div><?php } ?>
                                                </div>
                                                <?php if($subitem['url']!='' && $subitem['link']==true){?></a><?php }?>
                                            <?php if($show_submenuC==true){ ?>
                                                <ul id="sublev2_<?php echo $submf_id?>" class="nav_item_fold trans_all">
                                                    <?php foreach($subitem['subs'] as $folditem){ ?>
                                                        <li class="nav_item_sub lev2">
                                                            <?php if($folditem['url']!='' && $folditem['link']==true){?><a href="<?php echo $folditem['url']; ?>" class="item_link"><?php } ?>
                                                                <div class="nav_item_content sub">
                                                                    <div class="spcr_h px24 dsp_inl"></div>
                                                                    <div class="nav_title_sub dsp_inl"><?php echo ucfirst($folditem['title'])?></div>
                                                                </div>
                                                                <?php if($folditem['url']!='' && $folditem['link']==true){?></a><?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <?php
                        $subm_id++;
                        $m++;
                    }
                    ?>
                    <div class="nav_cntct_hldr">
                        <a class="item touch_only" href="tel:<?php echo $tags['contact_telefoon_link'][$langID]; ?>" target="_blank" rel="noopener">
                            <div>
                                <div class="icon small call bl std_bg dsp_inl"></div>
                                <div class="nav_title_sub dsp_inl txt_c_bl">Bel</div>
                            </div>
                        </a>
                    </div>
                </ul>
            </div>
        </li>
    </ul>
</div>