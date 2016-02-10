jQuery(document).ready(function($) {

    // init Isotope
    var $grid = $('.grid').isotope({
      // options
    });

    // filter items on button click
    $('.filter-button-group').on( 'click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
        console.log($grid);
      $grid.isotope({ filter: filterValue });
    });
})
