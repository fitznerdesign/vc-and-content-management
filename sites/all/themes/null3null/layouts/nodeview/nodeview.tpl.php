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
        <section class="page-stage-small">
            <?php print render($content['stage']); ?>
        </section>
        <div class="page-stage-shadow"></div>
    <?php endif; ?>

    <?php if (!empty($content['breadcrumb'])): ?>
        <div class="breadcrumb clearfix">
            <?php print render($content['breadcrumb']); ?>
        </div>
    <?php endif; ?>


    <?php if (!empty($content['content_main']) || !empty($content['sidebar']) || !empty($content['four_first']) || !empty($content['four_second']) || !empty($content['four_third']) || !empty($content['four_fourth'])): ?>
        <section id="content-wrapper">
            <?php if (!empty($content['content_main']) || !empty($content['sidebar'])) : ?>
                <article class="content-content gpanel clearfix">
                    <?php print render($content['content_main']); ?>
                </article>
                <aside id="sidebar-second">
                    <?php print render($content['sidebar']); ?>
                </aside>
                <?php if (!empty($content['three_33_first']) && !empty($content['three_33_second']) && !empty($content['three_33_third'])) : ?>
                    <aside class="three-3x33 gpanel clearfix">
                        <?php print render($content['three_33_first']); ?>
                        <?php print render($content['three_33_second']); ?>
                        <?php print render($content['three_33_third']); ?>
                    </aside>
                <?php endif; ?>            
                <?php if (!empty($content['four_first']) && !empty($content['four_second']) && !empty($content['four_third']) && !empty($content['four_fourth'])) : ?>
                    <aside class="four-4x25 gpanel clearfix">
                        <?php print render($content['four_first']); ?>
                        <?php print render($content['four_second']); ?>
                        <?php print render($content['four_third']); ?>
                        <?php print render($content['four_fourth']); ?>
                    </aside>
            
                <?php endif; ?>
            <div class="clearfix"></div>
            </section>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if (!empty($content['slider_01'])): ?>
    <aside class="page-slider_01">
        <?php print render($content['slider_01']); ?>
    </aside>
<?php endif; ?>
