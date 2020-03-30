<?php

$dbuser = $_ENV['MYSQL_USER'];
$dbpass = $_ENV['MYSQL_PASS'];
$dadosXls = "";
try {
    $pdo = new PDO("mysql:host=mysql;dbname=corona_db", $dbuser, $dbpass);
    $statement = $pdo->prepare("SELECT * FROM corona_db.tbl_voluntarios");
    $statement->execute();
    $voluntarios = $statement->fetchAll(PDO::FETCH_OBJ);
    } catch(PDOException $e) {
    echo $e->getMessage();
}
    $dadosXls .= "<table><thead><tr><th>id</th><th>nome</th><th>ocupacao</th><th>subcategoria</th><th>telefone</th><th>celular</th><th>email</th><th>cpf</th><th>registro profisisonal</th><th>ano</th><th>periodo</th></tr></thead><tbody>";
    foreach ($voluntarios as $voluntario ) {
        $dadosXls .= "<tr><td>".$voluntario->id."</td><td>".$voluntario->nome."</td><td>".$voluntario->ocupacao."</td><td>".$voluntario->subcategoria."</td><td>".$voluntario->telefone."</td><td>".$voluntario->celular."</td><td>".$voluntario->email."</td><td>".$voluntario->cpf."</td><td>".$voluntario->registro_profissional."</td><td>".$voluntario->ano."</td><td>".$voluntario->periodo."</td></tr>";
    }
    $dadosXls .= "</tbody></table>";

// Definimos o nome do arquivo que será exportado  
    $arquivo = "MinhaPlanilha.xls";  
    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');
       
    // Envia o conteúdo do arquivo  
    echo $dadosXls;  
    exit;




