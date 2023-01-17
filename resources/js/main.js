jQuery(function() {
    $("#main_form").validate({
            rules: {
                name: {
                    required: true,
                }
            },
            messages:{
                name: "Please Enter Name",
                image:"Please Enter URL",
                cost:"Please Enter Amount",
                description:"Please Enter Description",
            }
        });
 })