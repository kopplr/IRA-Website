/*
Version: 1.0
*/

jQuery(document).ready(function($) {

    // init Isotope
    var $grid = $('.grid').isotope({
      // options
        itemSelector: '.element-item'
    });

    // filter items on button click
    $('.filter-button-group').on( 'click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
        console.log($grid);
      $grid.isotope({ filter: filterValue });
    });

    //Dropdown menu
    if ( $('.button-group li').children().length > 0){
        $('.button-group li').hover(function(){
            $(this).children('ul').css({display: 'block'});
        }, function(){
            $(this).children('ul').css({display: 'none'});
        });
    };

});
