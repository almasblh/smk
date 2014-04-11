$(document).ready(function(){
    DChanelProbivForm();
    AChanelProbivForm();
    $("#kd-collection-grid").change(function(){
        AChanelProbivForm();
    });
});
//------------------------------------------------------------------------------------------------------
function DChanelProbivForm(){
    $.ajax({
        url: "js/oimPmiTests/DInpForm.php",
        cache: false,
        success: function(html){
                $(".Din").html(html);
        }
    });
}

function assa() {
//    var url = $(this).attr('href');
//    $.get(url, function(response) {
//        $("#kd-collection-grid").html(response);
//    });
};


function AChanelProbivForm(){
    $.ajax({
        url: "js/oimPmiTests/AInpForm.php",
        cache: false,
        success: function(html){
                $(".Ain").html(html);
        }
    });
}