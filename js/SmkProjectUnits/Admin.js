$('body').on('click','#Chanels_view',function(){
    $jQuery.ajax({
        'type':'POST'
        ,'url':'#'
        ,'cache':false
        ,'data':jQuery(this).parents("form").serialize()
        ,'success':function(html){
            jQuery("#Chanels").html(html)
        }
    });
    return false;
});
