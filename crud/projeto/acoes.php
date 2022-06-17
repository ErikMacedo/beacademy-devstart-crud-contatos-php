<?php

function login()
{
  include 'telas/login.php';
}

function cadastro()
{
  if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    //abrindo arquivo e escrevendo 
    $arquivo = fopen('./dados/contatos.csv', 'a+');
    //escrevendo novo contato e quebando a pagina
    fwrite($arquivo, "{$nome};{$email};{$telefone}" .PHP_EOL);

    fclose($arquivo);

    $mensagem = 'Pronto, cadastro realizado';

    include 'telas/mensagem.php';
    
  }

  include 'telas/cadastro.php';
}

function home()
{
  include 'telas/home.php';
}

function listar()
{
  $contatos = file('dados/contatos.csv');

  include 'telas/listar.php';
}

function erro404()
{
  include 'telas/404.php';
}

function relatorio()
{
  include 'telas/relatorio.php';
}

function excluir () {
  //id do elemento a excluir
  $id = $_GET['id'];
  
  $contatos = file('./dados/contatos.csv');
  //excluir um elemento
  unset($contatos['id']);

  //excluir todo o arquivo
  unlink('./dados/contatos.csv');

  //criando um novo arquivo
  $arquivo = fopen('./dados/contatos.csv', 'a+');

  //precorrendo cada contato e escrevendo em novo arquivo de mesmo nome
  foreach ($contatos as $cadaContato) {
    fwrite($arquivo, $cadaContato);
  }

  $mensagem = 'Pronto, contato excluido';
  include 'telas/mensagem.php';
}

function editar() {
  $id = $_GET['id'];

  $contatos = file('./dados/contatos.csv');

  if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $contatos[$id] = "{$nome};{$email};{$telefone}" .PHP_EOL;

    unlink(('./dados/contatos.csv'));

    $arquivo = fopen('dados/contatos.csv', 'a+');

    foreach($contatos as $cadaContato) {
      fwrite($arquivo, $cadaContato);
    }
    fclose($arquivo);
    $mensagem = 'Pronto, contato atualizado.';
    include 'telas/mensagem.php';
  }

  $dados = explode(';', $contatos[$id]) ;

  include 'telas/editar.php';
}