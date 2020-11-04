<?php
require('vendor/autoload.php');
use bcmath_compat\BCMath;
use ipinfo\ipinfo\IPinfo;
use IPTools\IP;
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <title>IPv4 Geoloc</title>
        <meta charset='utf-8'>
        <link rel='stylesheet' type='text/css' href='styles.css'>
    </head>

    <body>
<?php
if ($_POST && !empty($_POST['num']) && preg_match('/[0-9]+/', $_POST['num'])) {
    $ipAddr = (string)IP::parse($_POST['num']);
    $ip = new IPinfo();
    $detalles = $ip->getDetails($ipAddr);
    $arrAux = ['all', 'readme', 'latitude', 'longitude'];
?>
        <p>
            <?=$ipAddr?>
        </p>
        <hr>
<?php
    foreach($detalles as $k => $v) {
        if (!in_array($k, $arrAux)) {
            switch ($k) {
                case 'city':
                    $k = 'Ciudad';
                    break;
                case 'region':
                    $k = 'Región';
                    break;
                case 'country':
                    $k = 'Código país';
                    break;
                case 'loc':
                    $k = 'Coordenadas';
                    break;
                case 'timezone':
                    $k = 'Zona horaria';
                    break;
                case 'country_name':
                    $k = 'País';
                    break;
                case 'postal':
                    $k = 'Código postal';
                    break;
                default:
                    break;
            }
?>
        <p>
            <i></i>
            <span class='clave'><?=$k?>:</span>
            <span class='valor'><?=$v?>.</span>
        </p>   
<?php
        }
    }
} else {
?>
        <h2>
            Geolocalización de un nº decimal.
        </h2>
        <form method='post'>
            <label for='num'>Introduzca el número entero:</label><br>
            <input type='number' name='num' id='num' pattern='[0-9]+' placeholder='nº entero'><br>
            <input type='submit' value='Calcular'>
        </form>
<?php
}
?>
    </body>

</html>
