<?php
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => "https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagoqr",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "{\n \"tcCommerceID\": \"d029.....6c8d1c\",\n \"tcNroPago\": 
\"23\",\n \"tcNombreUsuario\": \"Jhon Doe\",\n \"tnCiNit\": 7777777,\n
\"tnTelefono\": 600000000,\n \"tcCorreo\": \"micorreo@mail.com\",\n
\"tcCodigoClienteEmpresa\": \"9\",\n \"tnMontoClienteEmpresa\": \"1\",\n
\"tnMoneda\": 2,\n \"tcUrlCallBack\": \"misitio.com/callback\",\n \"tcUrlReturn\": 
\"misitio.com/return\",\n \"taPedidoDetalle\": [\n {\n \"Serial\": 1,\n
\"Producto\": \"Borrador\",\n \"Cantidad\": 1,\n \"Precio\": \"1\",\n
\"Descuento\": 0,\n \"Total\": \"1\"\n }\n ]\n}",
CURLOPT_HTTPHEADER => [
"Accept: */*",
"Authorization: Bearer eyJ0eXA3MGE1NuHdDWqao9YJV6i--Y8AnOn8 ... ...",
"Content-Type: application/json"
],
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}
#endregion
use GuzzleHttp\Client;
$loClient = new Client();
$laPrepararPago = $loClient->post(
'https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagoqr', [
'headers' => [
'Accept' => 'application/json',
'Authorization' => 'Bearer eyJ0eXAiOiJKV1Q… … …',
],
'json' => array(
"tcCommerceID": "d0294b70ad704bc6c8d1c",
 "tcNroPago": "20001",
 "tcNombreUsuario": "Jhon Doe",
 "tnCiNit": 7777777,
 "tnTelefono": 60000000,
 "tcCorreo": "micorreo@mail.com",
 "tcCodigoClienteEmpresa": "9",
 "tnMontoClienteEmpresa": "1",
 "tnMoneda": 2,
 "tcUrlCallBack": "misitio.com/callback",
 "tcUrlReturn": "misitio.com/return",
 "taPedidoDetalle": [
 {
 "Serial": 1,
 "Producto": "Borrador",
 "Cantidad": 1,
 "Precio": "1",
 "Descuento": 0,
 "Total": "1"
 }
 ]
)
]);
$laRespuestaPrepararPago= json_decode($laPrepararPago->getBody()->getContents());
echo $laRespuestaPrepararPago;

?>