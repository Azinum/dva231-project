<?php
    function shadow_start($classes = "") {
        ?>
        <div class="shadowbox <?php echo $classes; ?>">
        <?php
    }

    function shadow_end() {
        ?>
            <div class="oldshadow"></div>
        </div>
        <?php
    }
?>
