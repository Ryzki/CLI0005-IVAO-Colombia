$(window).load(function() {
    $('.flexslider').flexslider({
        animation: "fade",
        animationLoop: true,
        controlNav: false,
        directionNav: false
    });


});
$(document).ready(function() {

    $('#carousel_vertical_slide,#carousel_fade, #carousel_vertical_testimonial, #carousel_fade_icons, #carousel_fade_1, #carousel_fade_2, #carousel_testimonial_2').carousel({
        interval: 3000

    });





    $('.carousel-control').hover(
            function() {

                $(this).addClass('animated wobble');
            },
            function() {

                $(this).removeClass('animated wobble');

            }

    );

    $('#rfelogo').hover(
            function() {
                $(this).addClass('animated tada');

            },
            function() {
                $(this).removeClass('animated tada');

            });
            
//            Responsive Videos

    $("#main-media").fitVids();


    ///////////// HEIGHT OF FIRST FRAME OF WEBSITE
    $(function() {
        $('#top').css({
            'height': ($(window).height()) + 'px'
        });
        $(window).resize(function() {
            $('#top').css({
                'height': ($(window).height()) + 'px'
            });
        });
    });

//////// NICE SCROLL JS
    $(function() {
        $("html").niceScroll({horizrailenabled:false});
    });



});


//	


// Cache selectors
var lastId,
        topMenu = $(".nav"),
        topMenuHeight = topMenu.outerHeight() + 50,
// All list items
        menuItems = topMenu.find("a"),
// Anchors corresponding to menu items
        scrollItems = menuItems.map(function() {
    var item = $($(this).attr("href"));
    if (item.length) {
        return item;
    }
});


///////////////TWITTER 
jQuery(document).ready(function($) {
    $.getJSON('http://api.twitter.com/1/statuses/user_timeline/wrapbootstrap.json?count=2&amp;callback=?', function(tweets) {
        $("#twitter").html(tz_format_twitter(tweets));
    });
});

 /*-----------------------------------------------------------------------------------*/
            /*	FANCYBOX
             /*-----------------------------------------------------------------------------------*/
            $(document).ready(function() {
                $(".fancybox-media").fancybox({
                    arrows: true,
                    padding: 0,
                    closeBtn: true,
                    openEffect: 'fade',
                    closeEffect: 'fade',
                    prevEffect: 'fade',
                    nextEffect: 'fade',
                    helpers: {
                        media: {},
                        overlay: {
                            locked: false
                        },
                        buttons: false,
                        title: {
                            type: 'inside'
                        }
                    },
                    beforeLoad: function() {
                        var el, id = $(this.element).data('title-id');
                        if (id) {
                            el = $('#' + id);
                            if (el.length) {
                                this.title = el.html();
                            }
                        }
                    }
                });
            });
