<?php
session_start();

include_once '../app/model/Inscricao.php';

print_r($_POST);
//die();

if(isset($_POST['nome_servidor']) && !empty($_POST['nome_servidor'])){
    $nome_servidor = $_POST['nome_servidor'];
}
else{
    $nome_servidor = NULL;
}

if(isset($_POST['cpf_servidor']) && !empty($_POST['cpf_servidor'])){
    $cpf_servidor = $_POST['cpf_servidor'];
}
else{
    $cpf_servidor = NULL;
}

if(isset($_POST['cep_servidor']) && !empty($_POST['cep_servidor'])){
    $cep_servidor = $_POST['cep_servidor'];
}
else{
    $cep_servidor = NULL;
}

if(isset($_POST['endereco']) && !empty($_POST['endereco'])){
    $endereco = $_POST['endereco'];
}
else{
    $endereco = NULL;
}

if(isset($_POST['telefone']) && !empty($_POST['telefone'])){
    $telefone = $_POST['telefone'];
}
else{
    $telefone = NULL;
}

if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = $_POST['email'];
}
else{
    $email = NULL;
}

if(isset($_POST['cargo']) && !empty($_POST['cargo'])){
    $cargo = $_POST['cargo'];
}
else{
    $cargo = NULL;
}

if(isset($_POST['funcao']) && !empty($_POST['funcao'])){
    $funcao = $_POST['funcao'];
}
else{
    $funcao = NULL;
}

if(isset($_POST['unidade_atual']) && !empty($_POST['unidade_atual'])){
    $unidade_atual = $_POST['unidade_atual'];
}
else{
    $unidade_atual = NULL;
}

if(isset($_POST['data_chegada']) && !empty($_POST['data_chegada'])){
    $data_chegada = $_POST['data_chegada'];
}
else{
    $data_chegada = NULL;
}

if(isset($_POST['motivo_sair']) && !empty($_POST['motivo_sair'])){
    $motivo_sair = $_POST['motivo_sair'];
}
else{
    $motivo_sair = NULL;
}

if(isset($_POST['unidade_vai1']) && !empty($_POST['unidade_vai1'])){
    $unidade_vai1 = $_POST['unidade_vai1'];
}
else{
    $unidade_vai1 = NULL;
}
    
if(isset($_POST['unidade_vai2']) && !empty($_POST['unidade_vai2'])){
    $unidade_vai2 = $_POST['unidade_vai2'];
}
else{
    $unidade_vai2 = NULL;
}

if(isset($_POST['unidade_vai3']) && !empty($_POST['unidade_vai3'])){
    $unidade_vai3 = $_POST['unidade_vai3'];
}
else{
    $unidade_vai3 = NULL;
}

if(isset($_POST['unidade_foi1']) && !empty($_POST['unidade_foi1'])){
    $unidade_foi1 = $_POST['unidade_foi1'];
}
else{
    $unidade_foi1 = NULL;
}

if(isset($_POST['data_chegada_foi1']) && !empty($_POST['data_chegada_foi1'])){
    $data_chegada_foi1 = $_POST['data_chegada_foi1'];
}
else{
    $data_chegada_foi1 = NULL;
}

if(isset($_POST['data_saida_foi1']) && !empty($_POST['data_saida_foi1'])){
    $data_saida_foi1 = $_POST['data_saida_foi1'];
}
else{
    $data_saida_foi1 = NULL;
}

if(isset($_POST['motivo_foi1']) && !empty($_POST['motivo_foi1'])){
    $motivo_foi1 = $_POST['motivo_foi1'];
}
else{
    $motivo_foi1 = NULL;
}

if(isset($_POST['unidade_foi2']) && !empty($_POST['unidade_foi2'])){
    $unidade_foi2 = $_POST['unidade_foi2'];
}
else{
    $unidade_foi2 = NULL;
}

if(isset($_POST['data_chegada_foi2']) && !empty($_POST['data_chegada_foi2'])){
    $data_chegada_foi2 = $_POST['data_chegada_foi2'];
}
else{
    $data_chegada_foi2 = NULL;
}

if(isset($_POST['data_saida_foi2']) && !empty($_POST['data_saida_foi2'])){
    $data_saida_foi2 = $_POST['data_saida_foi2'];
}
else{
    $data_saida_foi2 = NULL;
}

if(isset($_POST['motivo_foi2']) && !empty($_POST['motivo_foi2'])){
    $motivo_foi2 = $_POST['motivo_foi2'];
}
else{
    $motivo_foi2 = NULL;
}

if(isset($_POST['unidade_foi3']) && !empty($_POST['unidade_foi3'])){
    $unidade_foi3 = $_POST['unidade_foi3'];
}
else{
    $unidade_foi3 = NULL;
}

if(isset($_POST['data_chegada_foi3']) && !empty($_POST['data_chegada_foi3'])){
    $data_chegada_foi3 = $_POST['data_chegada_foi3'];
}
else{
    $data_chegada_foi3 = NULL;
}

if(isset($_POST['data_saida_foi3']) && !empty($_POST['data_saida_foi3'])){
    $data_saida_foi3 = $_POST['data_saida_foi3'];
}
else{
    $data_saida_foi3 = NULL;
}

if(isset($_POST['motivo_foi3']) && !empty($_POST['motivo_foi3'])){
    $motivo_foi3 = $_POST['motivo_foi3'];
}
else{
    $motivo_foi3 = NULL;
}

$inscricao = new Inscricao();
$inscricao->inserir($nome_servidor, $cpf_servidor, $cep_servidor, $endereco, $telefone, $email, $cargo, $funcao, $unidade_atual, $data_chegada, $motivo_sair, $unidade_vai1, $unidade_vai2, $unidade_vai3, $unidade_foi1, $data_chegada_foi1, $data_saida_foi1, $motivo_foi1, $unidade_foi2, $data_chegada_foi2, $data_saida_foi2, $motivo_foi2, $unidade_foi3, $data_chegada_foi3, $data_saida_foi3, $motivo_foi3);
   
if(true){
    
}else{
    header('Location: ../page/login.php?msg=nao_logado');
}