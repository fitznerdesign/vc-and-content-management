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
$url = $_SERVER['REQUEST_URI'];
if (strpos($url, 'panel_content') !== false) { ?>

<div class="panel-display panel-racing-layout clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>> 
  <!--slideshow--> 
  <!--slider-item-->
  <?php
  foreach ((array)$content as $item) {
    if (!empty($item)) {
?>
  <div class="panel">
    <div class="content-33" style="width: 33%; float: left;"><?php print $item; ?> </div>
  </div>
  <?php
    }
  }
?>
</div>

<?php } 
else {    
?>
<div class="panel-display panel-racing-layout clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
    
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
  <ul id="third-carousel" class="third-carousel jcarousel-skin-tango">
 
  
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
} 
?>

