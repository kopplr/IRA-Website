/*
Version: 1.0
*/

$(window).load(function() {
    alert('hi');
    var theIframe = $('#viz iframe');
    var theWidth = $('#viz').width();
    theIframe.each(function(){
        $(this).attr('width', theWidth);
    });
    console.log(theWidth);

    $('#viz').wrap('<div id="mother" />');

    $('#mother').css({
		width: function() {
		return theWidth;
	  },
		height: function() {
		return '500px';
	  },
        flex: '1',
		position: 'relative',
		overflow: 'hidden'
	});
		//get total of image sizes and set as width for ul
	var totalWidth = theIframe.length * theWidth;
    console.log(totalWidth);
	$('#viz').css({
		width: function(){
		return totalWidth;
	}
	});

    $('.carousel-home i').on("click", function(){
            console.log("clicked!");
            $('#viz').animate({
               "margin-left": (-(1)*theWidth)}, 1000);
    });
});
