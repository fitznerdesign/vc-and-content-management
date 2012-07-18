jQuery(document).ready(function($) {	
    $(".four-4x25 > div.article-ansicht-4-spalter:nth-child(4n)").css("border-right", "none");
    //$(".four-4x25 .field-name-field-weitere-inhalte(4n) > div.article-ansicht-4-spalter:nth-child").css("border-right", "none"); 
    // Delete the last border of columns
    $(".two-50 > div.article-ansicht-2-spalter:nth-child(2n)").css("border-right", "none");
    
    
    // Take Title-Tag and show it on image
    $('.page-stage-small img').each(function() {
    $(this).wrap('<div class="caption"></div>').after('<div class="description">' + $(this).attr('title') + '</div>');
    
  });

    
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
    codaNavSetCurrent();
});
