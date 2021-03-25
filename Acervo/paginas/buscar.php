<?php 
  //BUSCA OS DADOS
  //IRAR ACESSAR ARQUIVO CLASSEINSER.INC E ACESSAR A CLASSE inser
  require_once '../classeinser.inc';
  $p = new inser("acervo","localhost","root","");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Livraria</title>
  	<link rel="stylesheet" type="text/css" href="../estilo/estilo1.css">
	<link rel="stylesheet" type="text/css" href="../estilo/estilo2.css">
</head>
<body>
          <div class="MenuDois">

          		<a id="bot" href="../index.php"> 
		          <img class="minilivro" src="../imagem/minilivros.jpg" height="60"/>  Cadastro
		        </a>

		        <a id ="bot" href="./listalivros.php">
		            <img class="minilivro" src="../imagem/minilivros2.jpg" height="60"/>Atualizar
		        </a>

		        <a id ="bot" href="buscar.php">
		            <img class="minilivro" src="../imagem/minilivros2.jpg" height="60"/>Buscar livro
		        </a>
          </div>

			<div id= "centro">

			          <form method="GET"> 
			          	
			          	<label> Digite o nome do livro</label>
			          	<input type="text" name="nome">

			          	<input type="submit" value="Enviar">

			          </form>
			 </div>

<?php  

		  if(isset($_GET['nome']))
		  {

		    $busc = addslashes($_GET['nome']);
		    $res= $p->buscarLivro($busc);

		     if(!$p->buscarLivro($busc))
                   { 
                    echo "<p id='centro'> Nao localizado </p>";
                   }
		  }

?>

<section id="direita">

  <table>
    <tr id="titulo">     
      <td>Titulo</td>
      <td>Autor</td>
      <td>Ano</td>
      <td>preco</td>
      <td>Quantidade</td>
      <td>Tipo</td>
      <td colspan="2">Editora</td>
    </tr>

    <tr>

<?php // BUSCA DADOS E EXIBE NA PAGINA

	if (isset($_GET['nome'])) 
	{
	  if($p->buscarLivro($busc))
		{
	      $dados = $p-> buscarLivro($busc);
	      if (count($dados)>0) //se tem pessoas no banco de dados
	      {
	              echo "<tr>";
	              foreach ($dados as $k => $v) 
	              {
	                      if (($k =="tipo" ))
	                      {
	                          switch ($v) 
	                          {
	                              case '1':
	                                   echo "<td>Romance</td>";
	                              break;

	                              case '2':
	                                   echo "<td>Drama</td>";
	                              break;

	                              case '3':
	                                   echo "<td>Terror</td>";
	                              break;

	                              case '4':
	                                   echo "<td>Acao</td>";
	                              break;

	                          }


	                        }
	                        else if (($k =="ideditora" ))   
	                              {     
	                                
	                                $dadeditora = $p ->buscarNedit($v);
	                             //   $dadeditora [0]['nome']
	                                echo "<td>".$dadeditora [0]['nome']."</td>";
	     
	                      		   } 

	                      	else if (($k !="id" ))   //NAO EXIBIR O ID
	                              {     
	                                echo "<td>".$v."</td>";
	                               }            

	              }
	    ?>
	      <td>    <!-- BOTÃO EDITAR E EXCLUIR   -->

	            <a id="bot" href="./listalivros.php?id_up=<?php echo $dados['id'];?>">Editar</a> <!-- SE CLICAR EM EDITAR, VARIAVEL RES LINHA 20 BUSCA ESSA INFORMACAO -->

	            <a id="bot" href="./listalivros.php?id=<?php echo $dados['id'];?>">Excluir</a>

	      </td>

<?php 
	      echo "</tr>";
		
  	 }
		  else //O banco esta vazio
		  {
		    echo "<p id='centro'> Nao a livro cadastrados: <a href='../index.php'>Cadastrar </p> </a>";  
		  }
	 }
  }

?>

      </table>
</section>

</body>
</html>
