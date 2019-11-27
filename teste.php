
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="description" content="jQuery-Mask-Plugin - A jQuery plugin to make field masks" />
    <meta name="author" content="Igor Escobar" />
    <title>jQuery Mask Plugin - A jQuery Plugin to make masks on form fields and html elements.</title>


<!--
<link href="https://fonts.googleapis.com/css?family=Chivo:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500,700" rel="stylesheet">

<link rel="stylesheet" href="css/main.css" type="text/css" media="screen">
<link rel="stylesheet" href="https://yandex.st/highlightjs/7.3/styles/default.min.css">

<script async defer src="https://buttons.github.io/buttons.js"></script>

-->



</head>

<body>

<section class="examples">
    <div class="container">
        <h3 id="examples">View in action</h3>

        <div class="inputs">
            <div class="input-group">
                <label for="date">Date</label>
                <input type="text" class="date" id="date"/>
            </div>

            <div class="input-group">
                <label for="time">Hour</label>
                <input type="text" class="time" id="time"/>
            </div>

            <div class="input-group">
                <label for="date_time">Date &amp; Hour</label>
                <input type="text" class="date_time" id="date_time"/>
            </div>

            <div class="input-group">
                <label for="cep">ZIP Code</label>
                <input type="text" class="cep" id="cep"/>
            </div>

            <div class="input-group">
                <label for="cep_with_callback">With Callbacks (open console)</label>
                <input type="text" class="cep_with_callback" id="cep_with_callback"/>
            </div>

            <div class="input-group">
                <label for="crazy_cep">Crazy Zip Code</label>
                <input type="text" class="crazy_cep" id="crazy_cep"/>
            </div>

            <div class="input-group">
                <label for="money">Money</label>
                <input type="text" class="money" id="money"/>
            </div>

            <div class="input-group">
                <label for="placeholder">Mask placeholder option</label>
                <input type="text" class="placeholder" id="placeholder"/>
            </div>

            <div class="input-group">
                <label for="placeholder">Masks on div elements!</label>
                <input type="text" class="placeholder" id="placeholder"/>
            </div>

            <div class="input-group">
                <label for="phone">Telephone</label>
                <input type="text" class="phone" id="phone"/>
            </div>

            <div class="input-group">
                <label for="phone_with_ddd">Telephone with Code Area</label>
                <input type="text" class="phone_with_ddd" id="phone_with_ddd"/>
            </div>

            <div class="input-group">
                <label for="phone_us">US Telephone</label>
                <input type="text" class="phone_us" id="phone_us"/>
            </div>

            <div class="input-group">
                <label for="sp_celphones">São Paulo Celphones</label>
                <input type="text" class="sp_celphones" id="sp_celphones"/>
            </div>

            <div class="input-group">
                <label for="mixed">Mixed Type Mask</label>
                <input type="text" class="mixed" id="mixed"/>
            </div>

            <div class="input-group">
                <label for="cpf">CPF</label>
                <input type="text" class="cpf" id="cpf"/>
            </div>

            <div class="input-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" class="cnpj" id="cnpj"/>
            </div>

            <div class="input-group">
                <label for="ip_address">IP Address</label>
                <input type="text" class="ip_address" id="ip_address"/>
            </div>

            <div class="input-group">
                <label for="clear-if-not-match">With Clear If Not Match Option</label>
                <input type="text" class="clear-if-not-match" id="clear-if-not-match"/>
            </div>

            <div class="input-group">
                <label for="fallback">With a fallback digit</label>
                <input type="text" class="fallback" id="fallback"/>
            </div>

            <div class="input-group">
                <label for="selectonfocus">With selectOnFocus</label>
                <input type="text" class="selectonfocus" id="selectonfocus"/>
            </div>
        </div>

        <label>Masks on div elements!</label>
        <div class="mask-on-div">12345678909</div> <input type="button" class="bt-mask-it" value="Mask it!"/>
    </div>
</section>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/examples.js"></script>

</body>
</html>
