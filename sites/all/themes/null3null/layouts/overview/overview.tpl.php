<?php
/**
* @file
* This layout is intended to be used inside the page content pane. Thats why
* there is not wrapper div by default.
*/
?>
<?php if (!empty($css_id)): ?>
    <div id="<?php print $css_id; ?>" class="clearfix">
    <?php endif; ?>

    <?php if (!empty($content['stage'])): ?>
        <section class="page-stage clearfix">
            <?php print render($content['stage']); ?>
        </section>
        <div class="page-stage-shadow"></div>
    <?php endif; ?>

    <?php if (!empty($content['breadcrumb'])): ?>
        <div class="breadcrumb clearfix">
            <?php print render($content['breadcrumb']); ?>
        </div>
    <?php endif; ?>
        
    <?php if (!empty($content['three_33_first']) && !empty($content['three_33_second']) && !empty($content['three_33_third'])) : ?>
        <div class="three-3x33 gpanel clearfix">
            <?php print render($content['three_33_first']); ?>
            <?php print render($content['three_33_second']); ?>
            <?php print render($content['three_33_third']); ?>
        </div>
    <?php endif; ?>
<div class="clearfix"></div>
    <?php if (!empty($content['content_full']) || !empty($content['two_50_first']) || !empty($content['two_50_second']) || !empty($content['four_first']) || !empty($content['four_second']) || !empty($content['four_third']) || !empty($content['four_fourth'])): ?>
        <section id="content-wrapper" classs="clearfix">
            <?php if (!empty($content['content_full'])) : ?>
                <div class="content-full gpanel clearfix">
                    <?php print render($content['content_full']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($content['two_50_first']) && !empty($content['two_50_second'])) : ?>
                <div class="two-50 gpanel clearfix">
                    <section class="region">
                    <?php print render($content['two_50_first']); ?>
                        </section>
                    <section class="region">
                    <?php print render($content['two_50_second']); ?>
                        </section>
                </div>
            <?php endif; ?>
            <?php if (!empty($content['four_first']) && !empty($content['four_second']) && !empty($content['four_third']) && !empty($content['four_fourth'])) : ?>
                <div class="four-4x25 gpanel clearfix">
                    <?php print render($content['four_first']); ?>
                    <?php print render($content['four_second']); ?>
                    <?php print render($content['four_third']); ?>
                    <?php print render($content['four_fourth']); ?>
                    
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
        </section>
    <?php endif; ?>

    <?php if (!empty($content['slider_01'])): ?>
        <div class="page-slider_01">
            <?php print render($content['slider_01']); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($content['slider_02'])): ?>
        <div class="page-slider_02">
            <?php print render($content['slider_02']); ?>
        </div>
    <?php endif; ?>
