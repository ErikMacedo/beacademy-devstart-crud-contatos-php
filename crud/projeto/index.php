<?php

//verificando a requisicao(o que vem apos o dominio)
$url = explode('?', $_SERVER['REQUEST_URI']);

//incluindo outros arquivos
include 'telas/head.php';
include 'telas/menu.php';
include 'acoes.php';

match ($url[0]) {
  '/' => home(),
  '/login' => login(),
  '/cadastro' => cadastro(),
  '/listar' => listar(),
  '/relatorio' => relatorio(),
  '/excluir' => excluir(),
  '/editar' => editar(),
  default => erro404(),
};

include 'telas/footer.php';
