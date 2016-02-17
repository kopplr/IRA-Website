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
            $isSubMenu.slideUp(200);
        }

      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });

    //Dropdown menu
    $('.menu-item-has-children').hover(
        function(){
            $(this).children('.sub-menu').slideDown(200);
        },
        function(){
            if(!$(this).find('.is-checked').exists()) { // If a submenu button is NOT checked, then slideUp
                $(this).children('.sub-menu').slideUp(200);
            }
        }
    );



    // Extra jQuery functions
    $.fn.exists = function () {
        return this.length !== 0;
    }


});
