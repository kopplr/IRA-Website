/*
Version: 1.0
*/



jQuery(document).ready(function($) {
    // outdated browser
    outdatedBrowser({
        bgColor: '#f25648',
        color: '#ffffff',
        lowerThan: 'transform',
        languagePath: '../html/en.html'
    });

    // Add fonts
    WebFont.load({
        google: {
            families: ['Roboto Condensed:300,400']
        }
    });

    // Add icons to menu
    $('.site-header nav a').each(function(){
        if($(this).text() == 'IRA Portals'){
            $(this).prepend('<i class="fa fa-external-link" aria-hidden="true"></i>');
        }
        else if($(this).text() == 'Data'){
            $(this).prepend('<i class="fa fa-bar-chart" aria-hidden="true"></i>');
        }
        else if($(this).text() == 'Publications'){
            $(this).prepend('<i class="fa fa-newspaper-o" aria-hidden="true"></i>');
        }
        else if($(this).text() == 'Accountability'){
            $(this).prepend('<i class="fa fa-check-square-o" aria-hidden="true"></i>');
        }
        else if($(this).text() == 'Fact Book'){
            $(this).prepend('<i class="fa fa-book" aria-hidden="true"></i>');
        }
        else if($(this).text() == 'About Us'){
            $(this).prepend('<i class="fa fa-info-circle" aria-hidden="true"></i>');
        }
        else if($(this).text() == 'Submit a Request'){
            $(this).prepend('<i class="fa fa-envelope" aria-hidden="true"></i>');
        }
    });

    // add is-checked to the "Show All" button
    $('#menu-sidebar-menu-links li').first().children().addClass('is-checked');

    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.element-item',
        getSortData: {
            postOrder: '[data-order]'
        },
        sortBy: 'postOrder', // Post order for IQAP vs IRA Portal (not alphabetical)
    });


    // filter items on button click
    $('.filter-button-group').on( 'click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });




    // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
        console.log("clicked");

        var $isSubMenu = $buttonGroup.find('.is-checked').parents('.sub-menu');
        if($isSubMenu.exists() && !$(this).parents('.sub-menu').exists()){ // Selected a button filter that is NOT in the sub-menu, so slideUp
            $isSubMenu.stop().slideUp(400);
        }

      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });

    // Dropdown menu filter
    $('.menu-item-has-children').hover(
        function(){
            $(this).children('.sub-menu').stop().slideDown(400);
        },
        function(){
            if(!$(this).find('.is-checked').exists()) { // If a submenu button is NOT checked, then slideUp
                $(this).children('.sub-menu').stop().slideUp(400);
            }
        }
    );

    // Dropdown menu attachment
    $('.item-selected').on("click", function(){
        var options = $(this).siblings('.dropdown-options');
        if(options.css('display') == 'none'){
            options.slideDown(200);
        }
        else {
            options.slideUp(200);
        }
    });

    // Add in icons for home page
    $('#menu-home-page-menu-links > li').each(function(){
        if ($(this).text() == 'IRA Portals'){
            $('a',this).append('<i class="fa fa-external-link" style="display:block;font-size:3em;padding: 10px 0 10px 0"></i>');
        }
        if ($(this).text() == 'Data'){
            $('a',this).append('<i class="fa fa-bar-chart" style="display:block;font-size:3em;padding: 10px 0 10px 0"></i>');
        }
        if ($(this).text() == 'Publications'){
            $('a',this).append('<i class="fa fa-newspaper-o" style="display:block;font-size:3em;padding: 10px 0 10px 0"></i>');
        }
    })

    // Tabs navigation
    $('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');

        // Show/Hide Tabs
        $('.tabs ' + currentAttrValue).show().siblings().hide();

        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');

        // Load Google Map
        if (currentAttrValue == '#tab2') {
            var campus = {lat: 43.263448, lng: -79.919101};
            var downtown = {lat: 43.257526, lng: -79.8692459};



            var map = new google.maps.Map( document.getElementById( 'map' ), {
                zoom:           14,
                center:         new google.maps.LatLng( 43.2676166, -79.869034 ),
                scrollwheel:    false,
            });

            var styles = [
//              {
//                stylers: [
//                  { hue: "#7a003c" },
//                  { saturation: 100 },
//                  { lightness: 24 }
//                ]
//              },
                {
                featureType: "poi.business",
                elementType: "geometry",
                stylers: [
                  { visibility: "off" }
                ]
                },
                {
                featureType: "poi.business",
                elementType: "labels",
                stylers: [
                  { visibility: "off" }
                ]
                },
            ];
            map.setOptions({styles: styles});

            var campusContentString = '<h1>University Hall (UH)</h1>'+
                '<p>McMaster University</p>'+
                '<p>1280 Main Street West</p>'+
                '<p>University Hall, Room 215</p>'+
                '<p>Hamilton, Ontario</p>'+
                '<p>Canada L8S 4L8</p>'+
                '<p><a href="http://maps.google.ca/?daddr=43.263448,-79.919101" target="_blank">Get Directions</a></p>'
            ;

            var campusInfowindow = new google.maps.InfoWindow({
                content: campusContentString
            });

            var downtownContentString = '<h1>One James North (OJN)</h1>'+
                '<p>McMaster University</p>'+
                '<p>1 James St. North</p>'+
                '<p>3rd Floor, Room 310</p>'+
                '<p>Hamilton, Ontario</p>'+
                '<p>Canada L8R 2K3</p>'+
                '<p><a href="http://maps.google.ca/?daddr=43.257526,-79.869034" target="_blank">Get Directions</a></p>'
            ;

            var downtownInfowindow = new google.maps.InfoWindow({
                content: downtownContentString
            });



            var campusMarker = new google.maps.Marker({
                position: campus,
                map: map,
                title: 'University Hall (UH)',
            });

//            campusMarker.addListener('click', function() {
//                campusInfowindow.open(map, campusMarker);
//            });

            var downtownMarker = new google.maps.Marker({
                position: downtown,
                map: map,
                title: 'One James North (OJN)',
            });


//            downtownMarker.addListener('click', function() {
//                downtownInfowindow.open(map, downtownMarker);
//            });

            google.maps.event.addListenerOnce(map, 'idle', function(){
                campusInfowindow.open(map, campusMarker);
                downtownInfowindow.open(map, downtownMarker);
            });

            campusMarker.addListener('click', function(){
                campusInfowindow.open(map, campusMarker);
            });

            downtownMarker.addListener('click', function(){
                downtownInfowindow.open(map, downtownMarker);
            });



        }

        e.preventDefault(); // Stop from adding to the URL
    });

    // Showing "Return to Top" button
    var amountScrolled = 300;

    $(window).scroll(function() {
        if ( $(window).scrollTop() > amountScrolled ) {
            $('a.back-to-top').fadeIn('slow');
        } else {
            $('a.back-to-top').fadeOut('slow');
        }
    });

    // Scroll back up to top smoothly
    $('a.back-to-top').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

//    $('.responsive').slick({
//        speed: 300,
//        adaptiveHeight: true,
//    });

    // Tab allows focus outline, but button click does not
    document.addEventListener('keydown', function(e) {
        if (e.keyCode === 9) {
            $('body').addClass('show-focus-outlines');
        }
    });
    document.addEventListener('click', function(e) {
        $('body').removeClass('show-focus-outlines');
    });


    // Allow enter to open the menu and search thing
    $('#mcmaster-search').keypress(function(event){
        if(event.keyCode == 13){
            macSearchToggle();
        }
    });
    $('#mcmaster-menu').keypress(function(event){
        if(event.keyCode == 13){
            macMenuToggle();
        }
    });

    //Toggle dropdown menu in menu
    $('#mcmaster-nav h3').keypress(function(event){

        if(event.keyCode == 13){
            console.log($(this).siblings('input').checked);
            $(this).siblings('ul').slideToggle();
        }
    });
    $('#mcmaster-nav li > h3').click(function() {
        $(this).parent().siblings().find('ul').slideUp(400);
        $(this).next('ul').stop(true, false, true).slideToggle(400);
        return false;
    });

//    var animationOut = 'animated slideOutRight';
//    var animationIn = 'animated slideInLeft';
//    var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
//
//    var src, value, newSrc;
//
//    var visArray = ['d3-transfer.html', 'd3-bubble.html'];
//    var currIndex = 0;
//    var arrayLength = visArray.length;
//    console.log($('iframe').width());
//
//    $('.carousel-home i').on("click", function(){
//        $('iframe').addClass(animationOut).one(animationEnd, function(){
//            $(this).removeClass(animationOut);
//
//            if(++currIndex > arrayLength - 1){ // End of array
//                currIndex = 0;
//            }
//            console.log(currIndex);
//            console.log()
//            src = $('iframe').attr('src');
//            value = src.substring(src.lastIndexOf('/') + 1);
//            newSrc = src.replace(value, visArray[currIndex]);
//
//            $(this).attr('src', newSrc);
//            $(this).addClass(animationIn).one(animationEnd, function(){
//                $(this).removeClass(animationIn);
//            });
//        });
//    });

//    var theIframe = $('#viz iframe');
//    $('#background-pic').load(function(){
//        console.log("loaded: " + $('#background-pic').width());
//    });
//
//    var theWidth = $('#background-pic').width() - 2*$('.carousel-home').width();
//        //$('#viz').width();
//    theIframe.each(function(){
//        $(this).attr('width', theWidth);
//    });
//    console.log(theWidth);
//
//    $('#viz').wrap('<div id="mother" />');
//
//    $('#mother').css({
//        width: function() {
//        return theWidth;
//      },
//        height: function() {
//        return '500px';
//      },
//        flex: '1',
//        position: 'relative',
//        overflow: 'hidden'
//    });
//        //get total of image sizes and set as width for ul
//    var totalWidth = theIframe.length * theWidth;
//    console.log(totalWidth);
//    $('#viz').css({
//        width: function(){
//        return totalWidth;
//    }
//    });
//
//    $('.carousel-home i').on("click", function(){
//            console.log("clicked!");
//            $('#viz').animate({
//               "margin-left": (-(1)*theWidth)}, 1000);
//    });

    if($(window).width() > 750){ // Disable for small viewports
        $('.flexslider').flexslider({
            slideshow: false,
            controlNav: false,
        });
    }





    // Extra jQuery functions
    $.fn.exists = function () {
        return this.length !== 0;
    }


});
jQuery(window).resize(function(){
    if(jQuery(window).width() < 750){
        jQuery('.flexslider').hide();
    }
    else {
        jQuery('.flexslider').show();
    }
});


