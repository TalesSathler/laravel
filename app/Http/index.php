<?php

/**
 * Escreve no arquivo de saída
 */
function escreverArquivo ($file, $msg) {
    //escreve no arquivo de saída
    fwrite($file, $msg);
    fclose($file);
    exit;
}




//criar o arquivo de saída para ajudar a testar, este arquivo será criado na pasta do arquivo index.php
$file = fopen('saida.txt', 'w');

$dbusername = "root";
$dbpassword = "";
$server = "localhost";

//    echo '<pre>';print_r(phpinfo());die();


$dbconnect = mysqli_connect($server, $dbusername, $dbpassword);
if(!$dbconnect){
    escreverArquivo ($file, 'Erro: não foi possível conectar no MYSQL!');
}


//$dbselect = mysqli_select_db($dbconnect, "tcc_rfid_chrystian");
$dbselect = mysqli_select_db($dbconnect, "mercearia");
if(!$dbselect){
    escreverArquivo ($file, 'Erro: base de dados incorreta!');
}


$rfid = $_GET['rfid'];
if (!$rfid) {
    //escreve no arquivo de saída
    fwrite($file, 'Erro: valor do rfid não informado!');
    fclose($file);
    exit;
}
//$rfid = 'a0dde51b';

//echo '<pre>';print_r($rfid);die();

$select = "SELECT * FROM products WHERE product_rfid = '{$rfid}' ";
$result = mysqli_query($dbconnect, $select);
if ($result->num_rows <= 0) {
    //escreve no arquivo de saída
    fwrite($file, 'Erro: nenhum produto encontrado!');
    fclose($file);
    exit;
}

$produto = $result->fetch_assoc();

$prod_id = $produto['product_id'];
$prod_quant = $produto['product_quantity'];
$product_value = $produto['product_value'];

$nova_quant = $prod_quant - 1;


$sql = "UPDATE products SET product_quantity = '{$nova_quant}' WHERE product_id = '{$prod_id}' ";
$result = mysqli_query($dbconnect, $sql);
if(!$result){
    //escreve no arquivo de saída
    fwrite($file, 'Erro: não foi possível editar o valor do produto!');
    fclose($file);
    exit;
}


$result = mysqli_query($dbconnect, "INSERT INTO product_sales values(null, '{$prod_id}', '{$product_value}', '1', now(), now())");
if(!$result){
    //escreve no arquivo de saída
    fwrite($file, 'Erro: não foi possível registrar o valor da venda!');
    fclose($file);
    exit;
}


//escreve no arquivo de saída
fwrite($file, 'Sucesso: valor do produto editado com sucesso!');
fclose($file);

print_r($result);
echo 'asdf';

//em arduino

/*
    Array
(
    [0] => __construct
    [1] => close
    [2] => free
    [3] => data_seek
    [4] => fetch_field
    [5] => fetch_fields
    [6] => fetch_field_direct
    [7] => fetch_all
    [8] => fetch_array
    [9] => fetch_assoc
    [10] => fetch_object
    [11] => fetch_row
    [12] => field_seek
    [13] => free_result
)
*/

?>

