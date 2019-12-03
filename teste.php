<?php
$url = "https://demo4417994.mockable.io/clientes/";
$clientes = json_decode(file_get_contents($url));

echo $clientes[0]->id." | ".$clientes[0]->nome." | ".$clientes[0]->cidade." | ".$clientes[0]->estado." | ".$clientes[0]->segmento."<br>";
echo "<pre>";

$cli_base = array(10=>[11,12],20=>[21,22],30=>[31,32],40=>[41,42],50=>[51,52]);
print_r($cli_base);

$a = "10,30,50";
$b = explode(",",$a);
$cli_canc = array();
for ($x=0;$x<count($b);$x++) {
    $cli_canc[$b[$x]] = 0;
}
print_r($cli_canc);


$allkeys = array_replace($cli_canc, array_intersect_key($clientes, $cli_canc));
print_r($allkeys);

?>
