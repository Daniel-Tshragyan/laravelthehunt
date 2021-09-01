$(document).ready(function () {
    $(".tags1").select2()

    $(".getplan").click(function(){
        $(".paymentModal").css({"display":"block"})
        $(".plan_price").text($(this).attr("data-price"))
        $(".plan_name").val($(this).attr("data-id"))
    })

})
