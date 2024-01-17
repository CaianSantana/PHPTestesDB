<?php
include 'PHPDBC.php';

$db = PHPDBC::getInstance();
$db2 = PHPDBC::getInstance();

echo ($db == $db2) ? "singleton deu certo<br>" : "singleton deu errado<br>";

function echoAll($db){
    foreach($db->selectAll("pessoas") as $pessoa){
        echo $pessoa['name']." ".$pessoa['fname'].'<br>';
    }
}


$data = array("name"=>"Jax", "fname"=>"Icatchia");
$db->insert("pessoas", $data);
echoAll($db);
$updateData = array('name' => 'Jinx', 'fname' => 'Zaun');
$updateCondition = 'id = 1';
$db->update("pessoas", $updateData, $updateCondition);
$updateCondition = 'id = 2';
$db->delete("pessoas", $updateCondition);
echoAll($db2);

