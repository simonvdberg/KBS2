$("document").ready(function() {


    //Postcode verzender checken met API
    $("#postcodeCijfersVerzender, #postcodeLettersVerzender, #huisnummerVerzender").on("change", function() {
        let postcodeCijfers = $("#postcodeCijfersVerzender").val();
        let postcodeLetters = $("#postcodeLettersVerzender").val();
        let huisnummer = $("#huisnummerVerzender").val();
        //HIER CHECKS TOEVOEGEN
        let postcode = postcodeCijfers + postcodeLetters;
        $.ajax({
            url: "index.php/modules/PostcodeApi/zoekAdres",
            data: {
                postcode: postcode,
                huisnummer: huisnummer
            },
            method: "POST",
            dataType: "json"
        }).done(function(data) {
            //Moet nog goede feedback geven => aangeven dat er niks gevonden kon worden
            $("#straatVerzender").val(data.straat);
            $("#plaatsVerzender").val(data.plaats);
        });
    });
    //Postcode ontvanger checken met API
    $("#postcodeCijfersOntvanger, #postcodeLettersVOntvanger, #huisnummerOntvanger").on("change", function() {
        let postcodeCijfers = $("#postcodeCijfersOntvanger").val();
        let postcodeLetters = $("#postcodeLettersOntvanger").val();
        let huisnummer = $("#huisnummerOntvanger").val();
        //HIER CHECKS TOEVOEGEN
        let postcode = postcodeCijfers + postcodeLetters;
        $.ajax({
            url: "index.php/modules/PostcodeApi/zoekAdres",
            data: {
                postcode: postcode,
                huisnummer: huisnummer
            },
            method: "POST",
            dataType: "json"
        }).done(function(data) {
            //Moet nog goede feedback geven => aangeven dat er niks gevonden kon worden
            $("#straatOntvanger").val(data.straat);
            $("#plaatsOntvanger").val(data.plaats);
        });
    });
    //Stap 1 naar 2
    $("#stap1 .changeStep").on("click", function() {
        let verzendAdres = $("#straatVerzender").val() + " " + $("#huisnummerVerzender").val() +
            ", " + $("#postcodeCijfersVerzender").val() + $("#postcodeLettersVerzender").val() +
            ", " + $("#plaatsVerzender").val();
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
        }).done(function(data) {
            var prijs = (parseFloat(data[1])*1.21 + 2).toFixed(2);
            $("#prijs").html("&euro;" + prijs);
            $("#resultaatOphaalAdres").html(ontvangAdres);
            $("#resultaatAfleverAdres").html(verzendAdres);
            $("input[name=resultaatOphaalAdres]").val(ontvangAdres);
            $("input[name=resultaatAfleverAdres]").val(verzendAdres);
            $("#resultaat").css("display", "block");
            $("#waiting").css("display", "none");
            $("#resApiCall").val(JSON.stringify(data));
        });
        let stap = $(this).data("stap");
        $(".pagina").css("display", "none");
        $("#stap" + stap).css("display", "block");
    });
    //Stap 2 naar 3
    $("#stap2 .changeStep").on("click", function(e) {
        e.preventDefault();
        var hoogte = parseInt($("#pakketHoogte").val());
        var lengte = parseInt($("#pakketLengte").val());
        var breedte = parseInt($("#pakketBreedte").val());
        var gewicht = parseInt($("#pakketGewicht").val());
        var error = false;
        if (isNaN(hoogte) || hoogte == 0 || hoogte > 50) {
            $("#pakketHoogte").css("border", "1px solid red");
            error = true;
        }
        if (isNaN(lengte) || lengte == 0 || lengte > 50) {
            $("#pakketLengte").css("border", "1px solid red");
            error = true;
        }
        if (isNaN(breedte) || breedte == 0 || breedte > 50) {
            $("#pakketBreedte").css("border", "1px solid red");
            error = true;
        }
        if (isNaN(gewicht) || gewicht == 0 || gewicht > 10) {
            $("#pakketGewicht").css("border", "1px solid red");
            error = true;
        }
        if (!error) {
            let stap = $(this).data("stap");
            $(".pagina").css("display", "none");
            $("#stap" + stap).css("display", "block");
        }
    });
    //Stap 3 naar 4
    $("#stap3 .changeStep").on("click", function(e) {
        let stap = $(this).data("stap");
        $(".pagina").css("display", "none");
        $("#stap" + stap).css("display", "block");
    });
    //Stap verdergaan
    //        $("a.changeStep").on("click", function(e){
    //e.preventDefault();
    //        let stap = $(this).data("stap");
    //        $(".pagina").css("display", "none");
    //        $("#stap" + stap).css("display", "block");
    //});
});