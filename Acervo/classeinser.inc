<?php 

//Criando funcões
//Primeira funcao: Conexao com o vanco de dados

Class inser{

	private $pdo;
	//CONEXAO COM O BANCO DE DADOS -------------------------------------------------------------------------------
	public function __construct($dbname, $host, $user, $senha)
    {

   	try{
		$this-> pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
   	}

	catch(PDOException $e)
	{

		echo "Erro com banco de dados: ".$e->getMessage();
		exit();

	}

	catch(Exception $e)
	{

		echo "Erro generico: ".$e->getMessage();
		exit();
	}
}
//Funcao para buscar os dados e mostrar na tela------------------------------------------------------------------------------
	public function buscarDados()
	{
	//res recebeu array, caso nao retorne nada, nao dar erro, vai retornar array vazio	
	$res = array();
	$cmd=$this-> pdo->query("SELECT * FROM acervo ORDER BY titulo ");

	$res = $cmd -> fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}


//Funcao para buscar o dado especico e mostrar na tela------------------------------------------------------------------------------

		public function buscarLivro($titulo)
	{
		$res = array();
		$cmd = $this->pdo->prepare("SELECT * FROM acervo WHERE titulo LIKE :t");
		$cmd->bindValue(":t",$titulo."%");
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	#--------------------------------
	#-------CADASTRO--------------------------------------------------------------------------------------------------------

	public function cadastrar($idedi,$titulo,$autor,$ano,$preco,$quantidade,$tipo){

		//verificar se esta cadastrado
		$cmd = $this ->pdo->prepare("SELECT id from acervo WHERE titulo = :ti");
		$cmd->bindValue(":ti",$titulo);
		$cmd->execute();


		if ($cmd->rowCount() > 0) 
		{
			return false;
		}
		else
		{
			$cmd= $this->pdo->prepare("INSERT INTO acervo(ideditora,titulo,autor,ano,preco,quantidade,tipo) 
										VALUES(:i,:ti,:a,:an,:p,:q,:t)");
			$cmd->bindValue(":i",$idedi);
			$cmd->bindValue(":ti",$titulo);
			$cmd->bindValue(":a",$autor);
			$cmd->bindValue(":an",$ano);
			$cmd->bindValue(":p",$preco);
			$cmd->bindValue(":q",$quantidade);
			$cmd->bindValue(":t",$tipo);
			$cmd->execute();
			return true;
		}
	}

//-------------Excluir ------------------------------------------------------------------------------------
	public function excluir($id)
	{
		$cmd = $this->pdo->prepare("DELETE FROM acervo WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
	}

	//BUSCAR DADOS DE UM livro-----------------------------------------------------------------------------
	public function buscardadosacervo($id)
	{
		$res = array();
		$cmd = $this->pdo->prepare("SELECT * FROM acervo WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	//ATUALIZAR DADOS NO BANCO DE DADOS-----------------------------------------------------------------------
	public function atualizardados($id,$ideditora,$titulo,$autor,$ano,$preco,$quantidade,$tipo)
	{
		$cmd = $this->pdo->prepare("UPDATE acervo SET ideditora = :i, titulo = :ti, autor = :a, ano = :an, preco = :p, quantidade = :q, tipo = :t WHERE id = :id");

			$cmd->bindValue(":i",$ideditora);
			$cmd->bindValue(":ti",$titulo);
			$cmd->bindValue(":a",$autor);
			$cmd->bindValue(":an",$ano);
			$cmd->bindValue(":p",$preco);
			$cmd->bindValue(":q",$quantidade);
			$cmd->bindValue(":t",$tipo);
		    $cmd->bindValue(":id",$id);
			$cmd->execute();
			return true;

	}

			public function buscarPuser()
	{
	//res recebeu array, caso nao retorne nada, nao dar erro, vai retornar array vazio	
	$res = array();
	$cmd=$this-> pdo->query("SELECT nome FROM editora");

	$res = $cmd -> fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}


	//Funcao para buscar os dados e mostrar na tela------------------------------------------------------------------------------
		public function buscarNedit($id)
	{
	//res recebeu array, caso nao retorne nada, nao dar erro, vai retornar array vazio	
	$res = array();
	$cmd=$this-> pdo->query("SELECT nome FROM editora WHERE id = $id");

	$res = $cmd -> fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}



	//Funcao para buscar os dados e mostrar na tela------------------------------------------------------------------------------
			public function buscarPval()
	{
	//res recebeu array, caso nao retorne nada, nao dar erro, vai retornar array vazio	
	$res = array();
	$cmd=$this-> pdo->query("SELECT id FROM editora");

	$res = $cmd -> fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

}

?>
