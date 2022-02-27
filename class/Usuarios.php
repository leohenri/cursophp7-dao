<?php 

class Usuarios{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

    /**
     * @return mixed
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * @param mixed $idusuario
     *
     * @return self
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * @param mixed $deslogin
     *
     * @return self
     */
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * @param mixed $dessenha
     *
     * @return self
     */
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    /**
     * @param mixed $dtcadastro
     *
     * @return self
     */
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;

        return $this;
    }

    private function setData($data){

        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));

    }

    public function loadById($id){
    	$sql = new Sql();

    	$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

    	if(count($results) > 0){

    		$this->setData($results[0]);

    	}
    }

    public static function getList(){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE 1 ORDER BY deslogin;");
    } 

    public static function search($login){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin;",array(':SEARCH'=>"%".$login."%"));
    } 

    public function login($login, $password){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$login, ":PASSWORD"=>$password));

        if(count($results) > 0){

            $this->setData($results[0]);

        } else {
            throw new Exception("Login e oou senha invalidos.");
        }

    }


    public function insert(){
        $sql = new Sql();



        $results = $sql->select(" CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", 
            array(
                ':LOGIN'=>$this->getDeslogin(), 
                ':PASSWORD'=>$this->getDessenha()
            )
        );

        if(count($results) > 0){

            $this->setData($results[0]);

        }

    }

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $results = $sql->query("

            UPDATE
                tb_usuarios 
            SET
                deslogin = :LOGIN,
                dessenha = :PASSWORD
            WHERE
                idUsuario = :ID
            LIMIT 1
        ", array(
                ':LOGIN'=>$this->getDeslogin(), 
                ':PASSWORD'=>$this->getDessenha(), 
                ':ID'=>$this->getIdusuario()
            )
        );

    }



    public function delete(){

        $sql = new Sql();

        $sql->query("

            DELETE FROM
                tb_usuarios 
            WHERE
                idUsuario = :ID
            LIMIT 1
        ", array(
                ':ID'=>$this->getIdusuario()
            )
        );

        $this->setData(array(
            'idusuario'=>NULL,
            'deslogin'=>NULL,
            'dessenha'=>NULL,
            'dtcadastro'=>NULL
        ));

    }


    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}

?>