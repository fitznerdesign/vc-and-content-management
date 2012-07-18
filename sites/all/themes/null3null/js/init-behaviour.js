/**
 * @author alexander.farkas
 */

jQuery.noConflict();
(function($){

  function callOnDomReady() {    
    $('#coda-slider-main-navigation').codaSlider({
      dynamicArrows: false,
      dynamicTabs: true,
      dynamicTabsAlign: 'left',
      firstPanelToLoad: '',   
      autoHeight: false
    });
    $('#coda-slider-main-menu').codaSlider({
      dynamicArrows: false,
      dynamicTabs: true,
      dynamicTabsAlign: 'left',
      autoHeight: false
    });
   
   $('.preload').show();
   $('.coda-slider').show();
  }
  $(callOnDomReady);
})(jQuery);