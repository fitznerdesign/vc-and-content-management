/*
  jQuery Coda-Slider v2.0 - http://www.ndoherty.biz/coda-slider
  Copyright (c) 2009 Niall Doherty
  This plugin available for use in all personal or commercial projects under both MIT and GPL licenses.
*/

(function($){
	
	
	$.fn.customFadeIn = function(speed, callback) {
		return this.animate({opacity: 'show'}, speed, function() {
			if (jQuery.browser.msie)
				this.style.removeAttribute('filter');
			if (jQuery.isFunction(callback))
				callback();      
		});
	};
	$.fn.customFadeOut = function(speed, callback) {
		return this.animate({opacity: 'hide'}, speed, function() {         
			if (jQuery.browser.msie)
				this.style.removeAttribute('filter');
			if (jQuery.isFunction(callback))
				callback();
		});
	};
	$.fn.fadeTo = function(speed,to,offset, callback) {     
		return this.animate({opacity: to}, speed, function() {         
			if (to == 1 && jQuery.browser.msie) {
				this.style.removeAttribute('filter');          
			}
			if (jQuery.isFunction(callback)) {
				callback();
			}
		}); 
	}; 	
	
  // Remove the coda-slider-no-js class from the body
  $("body").removeClass("coda-slider-no-js");
  // Preloader
  $(".coda-slider").children('.panel').hide().end().prepend('<p class="loading">Loading...<br /><img src="images/ajax-loader.gif" alt="loading..." /></p>');
  
  var sliderCount = 1;
  
  $.fn.codaSlider = function(settings) {
    
    settings = $.extend({
      autoHeight: true,
      autoHeightEaseDuration: 1000,
      autoHeightEaseFunction: "easeInOutExpo",
      autoSlide: false,
      autoSlideInterval: 7000,
      autoSlideStopWhenClicked: true,
      crossLinking: true,
      dynamicArrows: true,
      dynamicArrowLeftText: "&#171; left",
      dynamicArrowRightText: "right &#187;",
      dynamicTabs: true,
      dynamicTabsAlign: "center",
      dynamicTabsPosition: "top",
      externalTriggerSelector: "a.xtrig",
      firstPanelToLoad: 1,
      panelTitleSelector: "h2.title",
      slideEaseDuration: 1200,
      slideEaseFunction: "easeInOutExpo"
    }, settings);
    
    return this.each(function(){
      
      // Uncomment the line below to test your preloader
      // alert("Testing preloader");
      
      var slider = $(this);
      
      // If we need arrows
      if (settings.dynamicArrows) {
        slider.parent().addClass("arrows");
        slider.before('<div class="coda-nav-left" id="coda-nav-left-' + sliderCount + '"><a href="#">' + settings.dynamicArrowLeftText + '</a></div>');
        slider.after('<div class="coda-nav-right" id="coda-nav-right-' + sliderCount + '"><a href="#">' + settings.dynamicArrowRightText + '</a></div>');
      };
      
      var panelWidth = slider.find(".panel").width();
      var panelHeight = slider.find(".panel").height();
      var panelCount = slider.find(".panel").size();
      var panelContainerWidth = panelWidth*panelCount;
      var navClicks = 0; // Used if autoSlideStopWhenClicked = true
      
      // Surround the collection of panel divs with a container div (wide enough for all panels to be lined up end-to-end)
      $('.panel', slider).wrapAll('<div class="panel-container"></div>');
      // Specify the width of the container div (wide enough for all panels to be lined up end-to-end)
      $(".panel-container", slider).css({ width: panelContainerWidth });
      
      // Specify the current panel.
      // If the loaded URL has a hash (cross-linking), we're going to use that hash to give the slider a specific starting position...
      if (settings.crossLinking && location.hash && parseInt(location.hash.slice(1)) <= panelCount) {
        var currentPanel = parseInt(location.hash.slice(1));
        var offset = - (panelWidth*(currentPanel - 1));
        $('.panel-container', slider).css({ marginLeft: offset });
        // If that's not the case, check to see if we're supposed to load a panel other than Panel 1 initially...
      } else if (settings.firstPanelToLoad != 1 && settings.firstPanelToLoad <= panelCount) { 
        var currentPanel = settings.firstPanelToLoad;
        var offset = - (panelWidth*(currentPanel - 1));
        $('.panel-container', slider).css({ marginLeft: offset });
        // Otherwise, we'll just set the current panel to 1...
      } else { 
        var currentPanel = 1;
      };
      
      // Left arrow click
      $("#coda-nav-left-" + sliderCount + " a").click(function(){
        navClicks++;
        if (currentPanel == 1) {
          offset = - (panelWidth*(panelCount - 1));
          alterPanelHeight(panelCount - 1);
          currentPanel = panelCount;
          slider.siblings('.coda-nav').find('a.current').removeClass('current').parents('ul').find('li:last a').addClass('current');
        } else {
          currentPanel -= 1;
          alterPanelHeight(currentPanel - 1);
          offset = - (panelWidth*(currentPanel - 1));
          slider.siblings('.coda-nav').find('a.current').removeClass('current').parent().prev().find('a').addClass('current');
        };
        $('.panel-container', slider).animate({ marginLeft: offset }, settings.slideEaseDuration, settings.slideEaseFunction);
        if (settings.crossLinking) { location.hash = currentPanel }; // Change the URL hash (cross-linking)
        return false;
      });
      
      // Right arrow click
      $('#coda-nav-right-' + sliderCount + ' a').click(function(){
        navClicks++;
        if (currentPanel == panelCount) {
          offset = 0;
          currentPanel = 1;
          alterPanelHeight(0);
          slider.siblings('.coda-nav').find('a.current').removeClass('current').parents('ul').find('a:eq(0)').addClass('current');
        } else {
          offset = - (panelWidth*currentPanel);
          alterPanelHeight(currentPanel);
          currentPanel += 1;
          slider.siblings('.coda-nav').find('a.current').removeClass('current').parent().next().find('a').addClass('current');
        };
        $('.panel-container', slider).animate({ marginLeft: offset }, settings.slideEaseDuration, settings.slideEaseFunction);
        if (settings.crossLinking) { location.hash = currentPanel }; // Change the URL hash (cross-linking)
        return false;
      });
      
      // If we need a dynamic menu
      if (settings.dynamicTabs) {
        var dynamicTabs = '<div class="coda-nav" id="coda-nav-' + sliderCount + '"><ul></ul></div>';
        switch (settings.dynamicTabsPosition) {
          case "bottom":
            slider.parent().append(dynamicTabs);
            break;
              default:
            slider.parent().prepend(dynamicTabs);
            break;
              };
        ul = $('#coda-nav-' + sliderCount + ' ul');
        // Create the nav items
        $('.panel', slider).each(function(n) {
          ul.append('<li class="tab' + (n+1) + '"><a href="#' + (n+1) + '">' + $(this).find(settings.panelTitleSelector).text() + '</a></li>');                        
        });
        navContainerWidth = slider.width() + slider.siblings('.coda-nav-left').width() + slider.siblings('.coda-nav-right').width();
        ul.parent().css({ width: navContainerWidth });
        switch (settings.dynamicTabsAlign) {
          case "center":
            ul.css({ width: ($("li", ul).width() + 2) * panelCount });
            break;
              case "right":
            ul.css({ float: 'right' });
            break;
              };
      };
 

	// mark current category in navigation menues
	function codaNavSetCurrent() {
		var req = window.location.href;
		var reqArr = req.split("/");

		if (reqArr != null) {
			switch (reqArr[3])
			{
			// tabs in world-navigation
				case "about-us":
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-1 ul li.tab1 a').addClass("current");
					break;
				case "content":
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-1 ul li.tab2 a').addClass("current");
					break;
				case "news-and-press-area":
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-1 ul li.tab3 a').addClass("current");
					break;
			// tabs in main-navigation
				case "racing":
					//$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-2 ul li.tab1 a').addClass("current");
					break;
				case "experience":
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-2 ul li.tab2 a').addClass("current");
					break;
				case "technology":
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-2 ul li.tab3 a').addClass("current");
					break;
				case "philosophy":
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-2 ul li.tab4 a').addClass("current");
					break;
				case "team-registration":
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					$('#coda-nav-2 ul li.tab5 a').addClass("current");
					break;
				default:
					$('#coda-nav-2 ul li.tab1 a').removeClass("current");
					break;
			}
        }			
	};

	// If we need a tabbed nav
      $('#coda-nav-' + sliderCount + ' a').each(function(z) {
        
        $('#meta-nav-wrapper-world-navigation').live('mouseleave', function() {
             $('.panel-container',slider).slideUp(900);
			 $(this).find('a').removeClass("current");
			 codaNavSetCurrent();
        }); 
         $('#meta-nav-wrapper-main-menu').live('mouseleave', function() {
             $('.panel-container',slider).slideUp(900);
			 $(this).find('a').removeClass("current");
			 codaNavSetCurrent();
        }); 
         $('#nav-global').live('mouseleave', function() {
             $('.panel-container',slider).slideUp(900);
        }); 
        // What happens when a nav link is mouseover
         var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
         var isiPad = navigator.userAgent.match(/iPad/i) != null;
        
        if(isiPad || isiPhone){
               
       
        $(this).bind("click", function() {
            if(!$('.panel-container',slider).is(":visible") || ($('.panel-container',slider).is(":visible") && $(this).hasClass('current'))){
              
          navClicks++;
              
          $(this).addClass('current').parents('ul').find('a').not($(this)).removeClass('current');
          
          offset = - (panelWidth*z);
          alterPanelHeight(z);
          currentPanel = z + 1;
          if($('.panel-container',slider).is(":visible") ){
            $('.panel-wrapper', slider).stop(true, true);
            $('.panel-container',slider).slideToggle(600,function(){
              $('.panel-container', slider).animate({ marginLeft: offset });
            });
          }else{
            $('.panel-wrapper', slider).stop(true, true);
            $('.panel-container', slider).animate({ marginLeft: offset },function(){
              $('.panel-container',slider).slideToggle(600);
            }).stop(true, true);
          } 
          if (!settings.crossLinking) { return false };
            }else{
                      
            if($('.panel-container',slider).is(":visible") && !$(this).hasClass('current')){
            navClicks++;
            $(this).addClass('current').parents('ul').find('a').not($(this)).removeClass('current');
            offset = - (panelWidth*z);
            alterPanelHeight(z);
            currentPanel = z + 1;
            /*$('.panel-container', slider).animate({ marginLeft: offset }, settings.slideEaseDuration, settings.slideEaseFunction);*/
            $('.panel-wrapper', slider).fadeOut(600, function(){
              $('.panel-container', slider).css({ marginLeft: offset });
              $('.panel-wrapper', slider).fadeIn(600);
              //alert("bin da");
            });
            
            if (!settings.crossLinking) { return false }; // Don't change the URL hash unless cross-linking is specified
            };
            }
          });
   
       
        
        }else{
           
          $(this).bind("click", function() {
	          navClicks++;
	          $(this).addClass('current').parents('ul').find('a').not($(this)).removeClass('current');
	          offset = - (panelWidth*z);
	          alterPanelHeight(z);
	          currentPanel = z + 1;
	          if($('.panel-container',slider).is(":visible")){
	            //$('.panel-wrapper', slider).stop(true,true);
	            $('.panel-container',slider).slideToggle(900,function(){
	              $('.panel-container', slider).animate({ marginLeft: offset });
	            });
	          }else{
	            //$('.panel-wrapper', slider).stop(true,true);
	            $('.panel-container', slider).animate({ marginLeft: offset },function(){
	              $('.panel-container',slider).slideToggle(900);
	            }).stop(true, true);
	          }; 
	          if (!settings.crossLinking) { return false };
        	});
        
         
        //if (jQuery.browser.msie) {
		
		navigator.userAgent.match(/MSIE (\d+\.\d+);/);
		if (RegExp.$1 == "7.0") {		
			$(this).bind("mouseover", function() {         
				if($('.panel-container',slider).is(":visible")){
					if(!$(this).hasClass('current')) {
						navClicks++;
						$(this).addClass('current').parents('ul').find('a').not($(this)).removeClass('current');
						offset = - (panelWidth*z);
						alterPanelHeight(z);
						currentPanel = z + 1;
	            
						/*$('.panel-container', slider).animate({ marginLeft: offset }, settings.slideEaseDuration, settings.slideEaseFunction);*/
						$('.panel-container', slider).customFadeOut(600, function() {
							$('.panel-container', slider).css({ marginLeft: offset }).customFadeIn(600);
						});
					}
             //}
					if (!settings.crossLinking) { return false }; // Don't change the URL hash unless cross-linking is specified
					};
				});
        } else {
        	$(this).bind("mouseover", function() {         
            if($('.panel-container',slider).is(":visible")){
                if(!$(this).hasClass('current')){
            navClicks++;
            $(this).addClass('current').parents('ul').find('a').not($(this)).removeClass('current');
            offset = - (panelWidth*z);
            alterPanelHeight(z);
            currentPanel = z + 1;
            
            /*$('.panel-container', slider).animate({ marginLeft: offset }, settings.slideEaseDuration, settings.slideEaseFunction);*/
            $('.panel-wrapper', slider).fadeOut(600, function(){
              $('.panel-container', slider).css({ marginLeft: offset });
              $('.panel-wrapper', slider).fadeIn(600);
              $('.panel-wrapper').css({opacity: 1});
              //alert("bin da");
               
            });
                }
             //}
            if (!settings.crossLinking) { return false }; // Don't change the URL hash unless cross-linking is specified
            };
            
          });
        }
      };
        
      });
      // External triggers (anywhere on the page)
      $(settings.externalTriggerSelector).each(function() {
        // Make sure this only affects the targeted slider
        if (sliderCount == parseInt($(this).attr("rel").slice(12))) {
          $(this).bind("click", function() {
            navClicks++;
            targetPanel = parseInt($(this).attr("href").slice(1));
            offset = - (panelWidth*(targetPanel - 1));
            alterPanelHeight(targetPanel - 1);
            currentPanel = targetPanel;
            // Switch the current tab:
            slider.siblings('.coda-nav').find('a').removeClass('current').parents('ul').find('li:eq(' + (targetPanel - 1) + ') a').addClass('current');
            // Slide
            $('.panel-container', slider).animate({ marginLeft: offset }, settings.slideEaseDuration, settings.slideEaseFunction);
            if (!settings.crossLinking) { return false }; // Don't change the URL hash unless cross-linking is specified
          });
        };
      });
      
      // Specify which tab is initially set to "current". Depends on if the loaded URL had a hash or not (cross-linking).
      if (settings.crossLinking && location.hash && parseInt(location.hash.slice(1)) <= panelCount) {
        $("#coda-nav-" + sliderCount + " a:eq(" + (location.hash.slice(1) - 1) + ")").addClass("current");
        // If there's no cross-linking, check to see if we're supposed to load a panel other than Panel 1 initially...
      } else if (settings.firstPanelToLoad != 1 && settings.firstPanelToLoad <= panelCount) {
        $("#coda-nav-" + sliderCount + " a:eq(" + (settings.firstPanelToLoad - 1) + ")").addClass("current");
        // Otherwise we must be loading Panel 1, so make the first tab the current one.
      } else {
        $("#coda-nav-" + sliderCount + " a:eq(0)").addClass("current");
      };
      
      // Set the height of the first panel
      if (settings.autoHeight) {
        panelHeight = $('.panel:eq(' + (currentPanel - 1) + ')', slider).height();
        slider.css({ height: panelHeight });
      };
      
      // Trigger autoSlide
      if (settings.autoSlide) {
        slider.ready(function() {
          setTimeout(autoSlide,settings.autoSlideInterval);
        });
      };
      
      function alterPanelHeight(x) {
        if (settings.autoHeight) {
          panelHeight = $('.panel:eq(' + x + ')', slider).height()
            slider.animate({ height: panelHeight }, settings.autoHeightEaseDuration, settings.autoHeightEaseFunction);
        };
      };
      
      function autoSlide() {
        if (navClicks == 0 || !settings.autoSlideStopWhenClicked) {
          if (currentPanel == panelCount) {
            var offset = 0;
            currentPanel = 1;
          } else {
            var offset = - (panelWidth*currentPanel);
            currentPanel += 1;
          };
          alterPanelHeight(currentPanel - 1);
          // Switch the current tab:
          slider.siblings('.coda-nav').find('a').removeClass('current').parents('ul').find('li:eq(' + (currentPanel - 1) + ') a').addClass('current');
          // Slide:
          $('.panel-container', slider).animate({ marginLeft: offset }, settings.slideEaseDuration, settings.slideEaseFunction);
          setTimeout(autoSlide,settings.autoSlideInterval);
        };
      };
      
      // Kill the preloader
      $('.panel', slider).show().end().find("p.loading").remove();
      slider.removeClass("preload");
      
      sliderCount++;
      
    });
  };
})(jQuery);
