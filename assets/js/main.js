$(document).ready(function(){
    $(".form-input-place").hide();
    $("#place").attr("disabled", "disabled");

    $(".form-input-winner").on("change", function(e){
        let {value} = e.target
        console.log(value)
        if(value == "yes"){
            $(".form-input-place").show();
            $("#place").removeAttr("disabled")
        }else{
            $(".form-input-place").hide();
            $("#place").attr("disabled", "disabled");
        }
    })
})