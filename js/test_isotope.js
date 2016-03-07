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


    // Extra jQuery functions
    $.fn.exists = function () {
        return this.length !== 0;
    }


});
