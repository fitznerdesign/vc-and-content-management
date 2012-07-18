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
  <!--no slideshow backend--> 
  <!--slider-item-->
  <?php
  foreach ((array)$content as $item) {
    if (!empty($item)) {
?>
  <div class="panel">
    <div class="content-25" style="width: 25%; float:left;"><?php print $item; ?> </div>
  </div>
  <?php
    }
  }
?>
</div>

<?php 
} elseif ($notEmptyItemCount > 3) {    
?>
	<!-- slideshow in frontend with more than 3 elements-->
<div class="panel-display slider-4 clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
    
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
  	<ul class="fourth-carousel jcarousel-skin-tango">
 
  
    <!--slider-item-->
		<?php
		foreach ((array)$content as $item) {
        if (!empty($item)) {
		?>
        	 <li style="display:none"> <?php print $item; ?> </li>
      <?php
        }
    }
	  ?>
    </ul>
    <!--EOF:slideshow--> 
    <!--slider-controls-wrapper-->
   
    <!--EOF:slider-controls-wrapper-->
</div>
<?php 
} else {
?>
	<!-- no slideshow in frontend with less than 4 elements-->
<div class="panel-display slider-4 clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
	<div class="jcarousel-skin-tango">
	<div class="jcarousel-container jcarousel-container-horizontal">
		<div class="jcarousel-clip jcarousel-clip-horizontal">
				<ul class="jcarousel-list jcarousel-list-horizontal">
			<?php
			foreach ((array)$content as $item) {
	        if (!empty($item)) {
			?>
	        	  <li class="jcarousel-item jcarousel-item-horizontal"><?php print $item; ?> </li>
	      <?php
	        }
	      }
		  ?>
			</ul>
		</div>
	</div>
</div>
</div>
<?php 
} 
?>