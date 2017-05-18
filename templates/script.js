$("document").ready(function(){
    $("a.changeStep").on("click", function(e){
        e.preventDefault();
        let stap = $(this).data("stap");
        $(".pagina").css("display", "none");
        $("#stap" + stap).css("display", "block");
    });
});