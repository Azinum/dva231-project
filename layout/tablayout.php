<?php

    function tablayout_headtags() {
        ?><link rel="stylesheet" type="text/css" href="/css/tabs.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="/js/tabs.js"></script><?php
    }

    //$tabnames: array with names of tabs
    function tablayout_begin($tabs) {
        ?><div class="tablayout"><div class="tabs"><?php

        foreach($tabs as $i => $tab) {
            $tabname = "tab_" . $i;
            ?><div class="tab<?php echo ($i==0) ? " active" : ""; ?>" onclick="trigger_tab(this, '<?php echo $tabname; ?>');">
                <?php echo $tab; ?>
            </div><?php
        }

        ?></div><div class="tabcontents"><?php
    }

    function tabcontent_begin($tabnumber) {
        ?><div class="tabcontent<?php echo ($tabnumber==0) ? " active" : ""; ?>" id="tab_<?php echo $tabnumber; ?>"><?php
    }

    function tabcontent_end() {
        ?></div><?php
    }

    function tablayout_end() {
        ?></div></div><?php
    }

?>
