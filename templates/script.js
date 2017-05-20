$("document").ready(function(){
$("#stap1 .changeStep").on("click", function(){
let verzendAdres = $("#straatVerzender").val() + " " + $("#huisnummerVerzender").val() +
        ", " + $("#postcodeCijfersVerzender").val() + $("#postcodeLettersVerzender").val() +
        ", " + $("#plaatsVerzender").val();
        alert(verzendAdres);
        let ontvangAdres = $("#straatOntvanger").val() + " " + $("#huisnummerOntvanger").val() +
        ", " + $("#postcodeCijfersOntvanger").val() + $("#postcodeLettersOntvanger").val() +
        ", " + $("#plaatsOntvanger").val();
        $.ajax({
        url: "index.php/modules/RoutePrijsBerekening/ajaxCall",
                data: {
                verzendAdres: verzendAdres,
                        ontvangAdres: ontvangAdres
                },
                method: "POST",
                dataType: "json"
        }).done(function(data){
        });
});
//        $("a.changeStep").on("click", function(e){
//e.preventDefault();
//        let stap = $(this).data("stap");
//        $(".pagina").css("display", "none");
//        $("#stap" + stap).css("display", "block");
//});
        $("#postcodeCijfersVerzender, #postcodeLettersVerzender, #huisnummerVerzender").on("change", function(){
let postcodeCijfers = $("#postcodeCijfersVerzender").val();
        let postcodeLetters = $("#postcodeLettersVerzender").val();
        let huisnummer = $("#huisnummerVerzender").val();
        //HIER CHECKS TOEVOEGEN
        console.log(huisnummer);
        let postcode = postcodeCijfers + postcodeLetters;
        $.ajax({
        url: "index.php/modules/PostcodeApi/zoekAdres",
                data: {
                postcode: postcode,
                        huisnummer: huisnummer
                },
                method: "POST",
                dataType: "json"
        }).done(function(data){
//Moet nog goede feedback geven => aangeven dat er niks gevonden kon worden
$("#straatVerzender").val(data.straat);
        $("#plaatsVerzender").val(data.plaats);
        });
});
        $("#postcodeCijfersOntvanger, #postcodeLettersVOntvanger, #huisnummerOntvanger").on("change", function(){
let postcodeCijfers = $("#postcodeCijfersOntvanger").val();
        let postcodeLetters = $("#postcodeLettersOntvanger").val();
        let huisnummer = $("#huisnummerOntvanger").val();
        //HIER CHECKS TOEVOEGEN
        console.log(huisnummer);
        let postcode = postcodeCijfers + postcodeLetters;
        $.ajax({
        url: "index.php/modules/PostcodeApi/zoekAdres",
                data: {
                postcode: postcode,
                        huisnummer: huisnummer
                },
                method: "POST",
                dataType: "json"
        }).done(function(data){
//Moet nog goede feedback geven => aangeven dat er niks gevonden kon worden
$("#straatOntvanger").val(data.straat);
        $("#plaatsOntvanger").val(data.plaats);
        });
});
        });