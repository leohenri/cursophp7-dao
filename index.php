<?php 

require_once("config.php");

/*
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

//$root = new Usuarios();
//Carrega apenas um usuario especifico
//$root->loadById(4);

//Carrega lista de usuarios
//$lista = Usuarios::getList();
//echo json_encode($lista);


//Carrega login espcifico
//$lista = Usuarios::search("ro");
//echo json_encode($lista);

//Carrega um usuario
$usuario = new Usuarios();
$usuario->login('userRrRrRr', '102030');
echo ($usuario);
?>