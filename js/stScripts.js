function checkScroll() {
    if (jQuery(window).scrollTop() < distFadeout)
	jQuery("#scrollingTools").fadeOut("slow");
    else
	jQuery("#scrollingTools").fadeIn("slow");
}

function placeSt() {
    var tmp = (jQuery(window).width() / 2) - distMiddle;
    jQuery("#scrollingTools").css(side, tmp+"px");
    if (jQuery(window).scrollTop() < distFadeout)
	jQuery("#scrollingTools").fadeOut("slow");
    else
	jQuery("#scrollingTools").fadeIn("slow");
}

function stPopup(id) {
    var url = jQuery("#"+id.replace("but", "link")).html();
    window.open(url, "Scrolling Tools Share",  "status=0, toolbar=1, height=500px, width=700px");
}

function myinit() {
    jQuery('.scrolltop').click(function(){
	    jQuery('html, body').animate({scrollTop:0}, 'slow');
	    return false;
	});

    placeSt();
    jQuery(window).scroll(function() { checkScroll(); });
    jQuery(window).resize(function() { placeSt(); });
    jQuery(".popup").click(function(event) { stPopup(event.target.id); });
}

window.onload = myinit;
// myinit();