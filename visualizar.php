<?php

// incluir conexao com o banco de dados
include_once 'conexao.php';

$nome = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_NUMBER_INT);
//$id = "1000";

if (!empty($nome)) {
    $query_usuario = "SELECT nome, codigo, preco, descricao FROM produtos WHERE nome=:nome LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':nome', $nome);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $retorna = ['status' => true, 'dados' => $row_usuario];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
    }
} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}
echo json_encode($retorna);
