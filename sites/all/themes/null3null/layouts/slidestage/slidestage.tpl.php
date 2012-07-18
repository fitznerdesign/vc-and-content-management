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
<script type="text/javascript">
    
</script>
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
  <!--no slideshow backend--> 
  <!--slider-item-->
  <?php
  foreach ((array)$content as $item) {
    if (!empty($item)) {
?>
  <div class="panel">
    <div class="content" style="width: 100%; float:left;"><?php print $item; ?> </div>
  </div>
  <?php
    }
  }
?>
</div>

<?php } 
elseif ($notEmptyItemCount > 1) {    
?>
<!--slideshow in frontend with more than 1 item-->
<div class="panel-display stage clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
    
    
  <ul class="stage-carousel jcarousel-skin-tango">
 
  
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
   <div class="jcarousel-control"><ul>
      <?php 
      $number = 0;
                foreach ((array)$content as $item) {
                if (!empty($item)) {
                    $number++;
                ?>
           <li><a href="#<?php print $number; ?>"><?php print $number; ?></a></li>
                <?php
                    }
                  }
                ?>
       </ul>
    </div>
    <div class="moreButtonFake"></div>
    <!--EOF:slider-controls-wrapper-->
</div>
<?php 
} else {
?>
<!--no slideshow in frontend with 1 item-->
<div class="panel-display stage clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
 	<div class="jcarousel-container">
			<div class="jcarousel-container-horizontal single">
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