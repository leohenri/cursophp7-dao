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

/*
//Carrega lista de usuarios
$lista = Usuarios::getList();
echo json_encode($lista);
*/

//Carrega login espcifico
//$lista = Usuarios::search("ro");
//echo json_encode($lista);

/*
//Carrega um usuario LOAD
$usuario = new Usuarios();
$usuario->login('userRrRrRr', '102030');
echo ($usuario);
*/

/*
//Inserir novo usuario INSERT
$aluno = new Usuarios();
$aluno->setDeslogin('aluno_Lucas');
$aluno->setDessenha('asdqwe123asd789');
$aluno->insert();
*/

/*
//Alterar os dados UPDATE
$usuario = new Usuarios();
$usuario->loadById(1);
$usuario->update('professorRoot', '123dfgg');
echo $usuario;
*/

//Deletar os dados DELETE
$usuario = new Usuarios();
$usuario->loadById(1);
$usuario->delete();
echo $usuario;
//unset($usuario);
//echo $usuario;
?>