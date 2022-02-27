CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuarios_insert`(
	pdeslogin VARCHAR(64),
    pdessenha VARCHAR(256)
)
BEGIN

	INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (pdeslogin, pdessenha);
	
    SELECT * FROM tb_usuarios WHERE idusuario = last_insert_id();
END