<html>
<head>
    <title> Connectando ao Mysql em PHP</title>
</head>
<body>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbName = 'dbteste';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
if($mysqli -> connect_errno){
    die("conexão falhou.". $mysqli -> connect_errno);
}
printf("conexão bem sucedida!");

/* criar db e deletar com CREATE DATABASE e DROP DATABASE
if($mysqli->query("CREATE DATABASE DBTeste")){ //CREATE pra criar e DROP pra deletar
    printf("<br/>Banco de Dados criado com sucesso! <br/>");
}

if($mysqli->errno){
    die("<br/>Não foi possível criar este Banco de Dados...<br/>". $mysqli->error);
}
*/

/* selecionar db
$dbselect = mysqli_select_db($mysqli, 'dbteste');

if(!$dbselect){
    die("Não foi possível selecionar este DB: ".mysqli_error($mysqli));
}

printf("<br/>Banco de Dados selecionado com sucesso! <br/>");
*/

/* criar e deletar tabela com CREATE TABLE e DROP TABLE
$sql = "CREATE TABLE PESSOAS (id int,name varchar(50),fname varchar(50))";
if($mysqli->query($sql)){
    printf("<br/>Tabela criada com sucesso!<br/>");
}

if($mysqli->errno){
    die("<br/>Não foi possível criar esta tabela: " .mysqli_error($mysqli));
}
*/
/* inserindo dados com INSERT
$id = 1;
$name = "MIKE";
$fname = "Khan";
$sql = "INSERT INTO PESSOAS (id,name,fname) VALUES(\"$id\", \"$name\", \"$fname\")";
if($mysqli->query($sql)){
    printf("Dados inseridos com sucesso!");
}

if($mysqli->errno){
    die("Não foi possível inserir estas informações:".mysqli_error($mysqli));
}
*/
/* seleciona com SELECT e libera a memória consumida pelo resultado com mysqli_free_result()
$sql = "SELECT * FROM PESSOAS";
$result = $mysqli->query($sql);
if($result->num_rows>0){
    while($rows = $result->fetch_assoc()){
        echo '<br>id = '. $rows['id'].' name = '.$rows['name'].' fname = ' .$rows['fname'];
    }
}else{
    printf("Nenhum resultado.");
}
mysqli_free_result($result);
*/

/*// Transação utilizando try catch para ver se dá commit ou rollback.
$mysqli->begin_transaction();

try {
    // Operações que compõem a transação
    $sql1 = "INSERT INTO PESSOAS (id, name, fname) VALUES (1, 'João', 'Silva')";
    $sql2 = "UPDATE PESSOAS SET name = 'Maria' WHERE id = 1";

    $mysqli->query($sql1);
    $mysqli->query($sql2);

    // Confirma as operações se tudo estiver OK
    $mysqli->commit();

    echo "Transação bem-sucedida!";

} catch (Exception $e) {
    // Em caso de erro, reverte as operações
    $mysqli->rollback();
    echo "Erro na transação: " . $e->getMessage();
}*/

$mysqli -> close();

?>

</body>

</html>