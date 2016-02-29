jQuery(document).ready(function($) {
    $(document).on('click', '#year-selection li', function() {
        var selectedpost = $(this).data('id');
        if (selectedpost > 0){
            $.ajax({
                type: "POST",
                url: yearpost_vars.ajaxurl,
                dataType: 'json',
                data: {action: 'filter_year_post', nonce: yearpost_vars.nonce, postid: selectedpost}
            }).done(function(data) {
                console.log(data);
                // Update iframe to show new PDF file
                $('iframe').attr('src', data.url);

                // Update item-selected to the one clicked on
                $('#year-selection p').contents().filter(function(){
                    return this.nodeType == 3;
                })[0].nodeValue = data.post_title;

                // Update the pdf link
                $('#download-pdf a').attr('href', data.url);

                // Update the excel icon if necessary
                if (data.has_excel == false){
                    $('#download-excel').attr('style', 'display:none');
                }
                else{
                    $('#download-excel').attr('style', 'display:inline-block');
                    $('#download-excel a').attr('href', data.excel_url);
                }
            });

            // Remove selected from last year and add it to the clicked on li
            $(this).siblings().each(function(){
                $(this).removeClass("selected");
            });
            $(this).addClass("selected");

            // Slide options back up>?
            $('.item-selected').siblings('.dropdown-options').slideUp(200);


        }
    });
});
