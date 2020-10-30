<?php

    function tablayout_headtags() {
        ?><link rel="stylesheet" type="text/css" href="/css/tabs.css">
        <script src="/js/tabs.js"></script><?php
    }

    //$tabnames: array with names of tabs
    $starttab = 0;
    function tablayout_begin($tabs, $specstarttab = 0) {
        global $starttab;
        ?><div class="tablayout"><div class="tabs"><?php
        
        $starttab = $specstarttab;
        foreach($tabs as $i => $tab) {
            $tabname = "tab_" . $i;
            ?><div class="tab<?php echo ($i==$starttab) ? " active" : ""; ?>" onclick="trigger_tab(this, '<?php echo $tabname; ?>');">
                <?php echo $tab; ?>
            </div><?php
        }

        ?></div><div class="tabcontents"><?php
    }

    function tabcontent_begin($tabnumber) {
        global $starttab;
        ?>
            <div class="tabcontent<?php echo ($tabnumber==$starttab) ? " active" : ""; ?>" id="tab_<?php echo $tabnumber; ?>">
        <?php
    }

    function tabcontent_end() {
        ?></div><?php
    }

    function tablayout_end() {
        ?></div></div><?php
    }

?>
