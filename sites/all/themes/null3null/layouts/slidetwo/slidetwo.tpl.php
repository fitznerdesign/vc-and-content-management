<?php
/**
 * @file
 * Template for a 3 column panel layout.
 *
 * This template provides a three column panel display layout, with
 * each column roughly equal in width.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: Content in the left column.
 *   - $content['middle']: Content in the middle column.
 *   - $content['right']: Content in the right column.
 */
?>
<?php  
$notEmptyItemCount = 0;
foreach ((array)$content as $item) {
	if (!empty($item)) {
		$notEmptyItemCount++;
	}
}

$url = $_SERVER['REQUEST_URI'];
if (strpos($url, 'panel_content') !== false) { ?>

<div class="panel-display panel-racing-layout clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>> 
  <!--no slideshow in backend--> 
  <!--slider-item-->
  <?php
  foreach ((array)$content as $item) {
    if (!empty($item)) {
?>
  <div class="panel">
    <div class="content-50" style="width: 50%; float:left;"><?php print $item; ?> </div>
  </div>
  <?php
    }
  }
?>
</div>

<?php } 
elseif ($notEmptyItemCount >= 2){    
?>
<!--slideshow in frontend with more than 2 items-->
<div class="panel-display slider-2 clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
    <div class="teaser-counter"><span class="active_item_count">1</span>/<span class="sum_item_count"></span></div>
    
  <ul class="sec-carousel jcarousel-skin-tango">
 
  
      <!--slider-item-->
		<?php
		foreach ((array)$content as $item) {
        if (!empty($item)) {
		?>
        	 <li style="display:none;"> <?php print $item; ?> </li>
      <?php
        }
      }
	  ?>
    </ul>
    <!--EOF:slideshow--> 
    <!--slider-controls-wrapper-->
   <div class="jcarousel-control">
      <?php
                foreach ((array)$content as $item) {
                if (!empty($item)) {
                ?>
                    <a href="#"></a>
                <?php
                    }
                  }
                ?>
    </div>
   <div class="moreButtonFake-left"></div>
   <div class="moreButtonFake-right"></div>
    <!--EOF:slider-controls-wrapper-->
</div>
<?php 
} else {
?>
<!--no slideshow in frontend 1 or 2 items-->
<div class="panel-display slider-2 clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
	<div class="jcarousel-container">
		<div class="jcarousel-container-horizontal">
		<?php
		foreach ((array)$content as $item) {
        if (!empty($item)) {
		?>
        	  <?php print $item; ?> 
      <?php
        }
    }
	  ?>
		</div>
	</div>
</div>
<?php 
} 
?>
