<!doctype html>
<html>
    <head>
        <script src="jquery.js"></script>
        <script src="script.js"></script>
        <style>
            .pagina{
                display: none;
            }
            #stap1{
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="pagina" id="stap1">
            1
            <a href="#" class="changeStep" data-stap="2">Volgende stap</a>
        </div>
        <div class="pagina" id="stap2">
            2
            <a href="#" class="changeStep" data-stap="3">Volgende stap</a>
        </div>
        <div class="pagina" id="stap3">
            3
            <a href="#" class="changeStep" data-stap="4">Volgende stap</a>
        </div>
        <div class="pagina" id="stap4">
            4
        </div>
    </body>
</html>
