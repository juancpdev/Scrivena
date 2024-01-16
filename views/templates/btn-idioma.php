<?php if ($isHomePage): ?>
    <div class="language-toggle">
        <div class="language-option <?php echo $langParam === "es" ? "es" : "none" ?>">
            ES
        </div>
        <div class="toggle-button">
            <div class="circle"></div>
        </div>
        <div class="language-option <?php echo $langParam === "en" ? "en" : "none" ?>">
            EN
        </div>
    </div>
<?php endif; ?>