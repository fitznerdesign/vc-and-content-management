<div id="page-top">
    <div class="container">
        <?php print render($page['leaderboard']); ?>
        
        <header class="clearfix" role="banner">
            <?php if ($linked_site_logo): ?>
                <div id="logo"><?php print $linked_site_logo; ?></div>
            <?php endif; ?>

            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
                <h1 id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>            

            <?php if ($site_name || $site_slogan): ?>
                <hgroup<?php if (!$site_slogan && $hide_site_name): ?> class="<?php print $visibility; ?>"<?php endif; ?>>
                    <?php if ($site_name): ?>
                        <h1 id="site-name"<?php if ($hide_site_name): ?> class="<?php print $visibility; ?>"<?php endif; ?>><?php print $site_name; ?></h1>
                    <?php endif; ?>
                    <?php if ($site_slogan): ?>
                        <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
                    <?php endif; ?>
                </hgroup>
            <?php endif; ?>

            <?php print render($page['header']); ?>
            <?php if ($page['socialmedia']): ?>
                <div id="socialmedia"><?php print render($page['socialmedia']); ?></div>
            <?php endif; ?>
        </header>
        
    </div>
</div>
<div id="page-nav"> 
    <div class="container">
        <?php print render($page['menu_bar']); ?>
        <?php print render($page['search']); ?>
    </div>
</div>
<div id="page-middle" class="container">
    <?php if ($page['contact_block']): ?>
        <aside id="contact_block"><?php print render($page['contact_block']); ?></aside>
    <?php endif; ?>

    <?php print render($page['secondary_content']); ?>
    <!-- Three column 3x33 Gpanel -->
    <?php if ($page['three_33_first'] || $page['three_33_second'] || $page['three_33_third']): ?>
        <div class="three-3x33 gpanel clearfix">
            <?php print render($page['three_33_first']); ?>
            <?php print render($page['three_33_second']); ?>
            <?php print render($page['three_33_third']); ?>
        </div>
    <?php endif; ?>

    <div id="columns"><div class="columns-inner clearfix">
            <div id="content-column"><div class="content-inner">
                     <?php print $messages; ?>
    <?php print render($page['help']); ?>

                    <?php print render($page['highlighted']); ?>

                    <?php $tag = $title ? 'section' : 'div'; ?>
                    <<?php print $tag; ?> id="main-content" role="main">


                    <?php if ($primary_local_tasks || $secondary_local_tasks || $action_links = render($action_links)): ?>
                        <header>
                            <?php if ($primary_local_tasks || $secondary_local_tasks || $action_links): ?>
                                <div id="tasks">
                                    <?php if ($primary_local_tasks): ?>
                                        <ul class="tabs primary clearfix"><?php print render($primary_local_tasks); ?></ul>
                                    <?php endif; ?>
                                    <?php if ($secondary_local_tasks): ?>
                                        <ul class="tabs secondary clearfix"><?php print render($secondary_local_tasks); ?></ul>
                                    <?php endif; ?>
                                    <?php if ($action_links = render($action_links)): ?>
                                        <ul class="action-links clearfix"><?php print $action_links; ?></ul>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </header>
                    <?php endif; ?>


                    <div id="content"><?php print render($page['content']); ?></div>

                    <?php print $feed_icons; ?>

                    </<?php print $tag; ?>>

                    <?php print render($page['content_aside']); ?>

                </div></div>

            <?php print render($page['sidebar_first']); ?>
            <?php print render($page['sidebar_second']); ?>

        </div></div>

    <?php print render($page['tertiary_content']); ?>

    <!-- Two column 2x50 Gpanel -->
    <?php if ($page['two_50_first'] || $page['two_50_second']): ?>
        <div class="two-50 gpanel clearfix">
            <?php print render($page['two_50_first']); ?>
            <?php print render($page['two_50_second']); ?>
        </div>
    <?php endif; ?>


    <!-- Six column Gpanel -->
    <?php if ($page['six_first'] || $page['six_second'] || $page['six_third'] || $page['six_fourth'] || $page['six_fifth'] || $page['six_sixth']): ?>
        <div class="six-6x16 gpanel clearfix">
            <?php print render($page['six_first']); ?>
            <?php print render($page['six_second']); ?>
            <?php print render($page['six_third']); ?>
            <?php print render($page['six_fourth']); ?>
            <?php print render($page['six_fifth']); ?>
            <?php print render($page['six_sixth']); ?>
        </div>
    <?php endif; ?>
</div>
<div id="page-bottom">
    <div class="container clearfix">
        <!-- Four column Gpanel -->
        <?php if ($page['four_first'] || $page['four_second'] || $page['four_third'] || $page['four_fourth']): ?>
            <div class="four-4x25 gpanel clearfix">
                <?php print render($page['four_first']); ?>
                <?php print render($page['four_second']); ?>
                <?php print render($page['four_third']); ?>
                <?php print render($page['four_fourth']); ?>
            </div>
        <?php endif; ?>


        <?php if ($page['five_first'] || $page['five_second'] || $page['five_third'] || $page['five_fourth'] || $page['five_fifth']): ?>
            <div class="five-5x20 gpanel clearfix">
                <?php print render($page['five_first']); ?>
                <?php print render($page['five_second']); ?>
                <?php print render($page['five_third']); ?>
                <?php print render($page['five_fourth']); ?>
                <?php print render($page['five_fifth']); ?>
            </div>
        <?php endif; ?>

        <?php if ($page['footer']): ?>
            <footer role="contentinfo"><?php print render($page['footer']); ?></footer>
        <?php endif; ?>
    </div>
</div>
