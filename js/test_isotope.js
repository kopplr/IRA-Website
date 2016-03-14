/*
Version: 1.0
*/



jQuery(document).ready(function($) {

    // add is-checked to the "Show All" button
    $('#menu-sidebar-menu-links li').first().children().addClass('is-checked');

    // init Isotope
    var $grid = $('.grid').isotope({
      // options
        itemSelector: '.element-item'
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
            var downtown = {lat: 43.2570048, lng: -79.8692459};



            var map = new google.maps.Map( document.getElementById( 'map' ), {
                zoom:           14,
                center:         new google.maps.LatLng( 43.2676166, -79.8924281 ),
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
              }
            ];
            map.setOptions({styles: styles});

            var campusContentString = '<h1>University Hall (UH)</h1>'+
                '<p>McMaster University</p>'+
                '<p>1280 Main Street West</p>'+
                '<p>University Hall, Room 207</p>'+
                '<p>Hamilton, Ontario</p>'+
                '<p>Canada L8S 4L8</p>'
            ;

            var campusInfowindow = new google.maps.InfoWindow({
                content: campusContentString
            });

            var downtownContentString = '<h1>One James North (OJN)</h1>'+
                '<p>McMaster University</p>'+
                '<p>1 James St. North</p>'+
                '<p>3rd Floor, Room 310</p>'+
                '<p>Hamilton, Ontario</p>'+
                '<p>Canada L8R 2K3</p>'
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


        }

        e.preventDefault(); // Stop from adding to the URL
    });


    // Extra jQuery functions
    $.fn.exists = function () {
        return this.length !== 0;
    }


});
