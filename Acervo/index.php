
<?php
    //BUSCA OS DADOS
    //IRAR ACESSAR ARQUIVO CLASSEINSER.INC E ACESSAR A CLASSE inser
    require_once 'classeinser.inc';
    $p = new inser("acervo","localhost","root","");

?>

<!DOCTYPE html>
<html>
<head>
  <title>CADASTRO</title>
  <link rel="stylesheet" type="text/css" href="./estilo/estilo1.css">
</head>


<body>
  <div id="topo">
    <p>Sistema de estoque de livros</p> 
  </div>

  <div id="dimg">
    <img id="imag" src="./imagem/Bemvindo-menor.png"/> 
  </div>


      <div class="Menu">
         
          <a href="index.php"> 
            <img class="minilivros" src="./imagem/minilivros.jpg" height="60"/>
          </a> 

          Cadastrar 

          <a href="./paginas/listalivros.php">
            <img class="minilivros" src="./imagem/minilivros2.jpg" height="60"/>
          </a>

          Listar livros

          <a  href="./paginas/buscar.php">
            <img class="minilivros" src="./imagem/minilivros2.jpg" height="60"/>
          </a>
          Buscar livro

      </div>

  <div id= "centro">


   <?php
      //se existe algo em nome
    if (isset($_POST['titulo'])) //CLICOU NO BOTAO CADASTRAR
      {

        $idedi =  addslashes($_POST['idedi']);
        $titulo = addslashes($_POST['titulo']);
        $autor =  addslashes($_POST['autor']);
        $ano =    addslashes($_POST['ano']);
        $preco =  addslashes($_POST['preco']);
        $quantidade = addslashes($_POST['quantidade']);
        $tipo =   addslashes($_POST['tipo']);

        //se alguma variavel estiver vazia, exibir mensagem de erro
         if (!empty($idedi)&& !empty($titulo)&& !empty($autor)&& !empty($ano)&& !empty($preco)&& !empty($quantidade)&& !empty($tipo)) 
              //se tiver tudo certo
            {
             
                 if(!$p->cadastrar($idedi,$titulo,$autor,$ano,$preco,$quantidade,$tipo))
                   { 
                    echo "<p id='centro'> Livro ja esta cadastrado </p>";
                   }
            }
          else
          {
            echo "<p id='centro'>Preencha todos os campos</p>";
          }
      }
  ?>


      <form method="POST">

          <label>Editora</label>

          <select name="idedi">
               <?php 
                    $dado = $p-> buscarPval();
                    $dados = $p-> buscarPuser();
                    if (count($dados)>0) //se tem pessoas no banco de dados
                    {
                      for ($i=0; $i < count($dado); $i++) 
                      { 

                         for ($i=0; $i < count($dados); $i++) 
                           { 
     
                               foreach ($dado[$i] as $s => $e) {}
                               foreach ($dados[$i] as $k => $v) 
                              {
                                ?>
                                    <option value="<?php echo $e ?>"> <?php  echo $v  ?>  </option>";
                               <?php
                               }     
                            }
                       }
                    }
                ?>
          </select>

          <label >Titulo</label>
          <input type="text" name="titulo" placeholder="titulo..">

          <label >  Autor Livro </label>
          <input type="text" name="autor" placeholder="autor....">

          <label >Ano Publicacao</label>
          <input type="text" name="ano" placeholder="ano..">

          <label >Valor do Livro</label>
          <input type="text" name="preco" placeholder="preco..">

          <label >Quantidade de Livros</label>
          <input type="text" name="quantidade" placeholder="quantidade..">

          <label>Tipo</label>
          <select name="tipo">

            <option selected>  Selecione uma opcao</option>
            <option value="1">Romance</option>
            <option value="2">Drama</option>
            <option value="3">Terror</option>
            <option value="4">Acao</option>

          </select>

          <input type="submit" value="CADASTRAR">

      </form>

  </div>

</body>
</html>