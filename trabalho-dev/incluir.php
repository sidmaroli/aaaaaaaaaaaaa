<?php


require('func/sanitize_filename.php');


if(isset($_FILES['imagem'])){

    $arquivo = sanitize_filename($_FILES['arquivo']['name']);
    $img = $_FILES['imagem'];
    $diretorio = 'assets/imagem/';
    move_uploaded_file($img['tmp_name'], $diretorio . $arquivo);
}




//Realiza o INSERT DOS niveis de ensino
function Insere_nivel($nome_nivel)
{
require('pdo.inc.php');
        $sql = $conex->prepare("INSERT INTO nivel_ensino (nome) VALUES
                (:nome)");

        $sql->bindParam(':nome', $nome_nivel);

        $sql->execute();



}

    //----------------------------------------------------------------------------------
//Realiza o INSERT DOS cursos
function Insere_curso($nome_curso, $nivel_ensino)
{
require('pdo.inc.php');
        $sql = $conex->prepare("INSERT INTO cursos (nome, nivel_ensino_idNivel_ensino) VALUES
                (:nome, :nivel)");

        $sql->bindParam(':nome', $nome_curso);
        $sql->bindParam(':nivel', $nivel_ensino);

        $sql->execute();



}

    //----------------------------------------------------------------------------------
//Realiza o INSERT Das turmas
function Insere_turma($nome_turma, $idcurso)
{
require('pdo.inc.php');
        $sql = $conex->prepare("INSERT INTO turmas (nome, cursos_idcursos) VALUES
                (:nome, :nivel)");

        $sql->bindParam(':nome', $nome_turma);
        $sql->bindParam(':nivel', $idcurso);

        $sql->execute();



}

    //----------------------------------------------------------------------------------
  
//insere aluno
function Insere_aluno($nome_aluno, $data_nasc,  $foto, $idturma)
{
require('pdo.inc.php');
       

        //Realiza o INSERT DOS JOGADORES
        $sql = $conex->prepare("INSERT INTO alunos (nome_aluno, data_nasc, foto, turmas_idturmas) VALUES
                (:nome, :nasc, :foto,  :idturma)");

        $sql->bindParam(':nome', $nome_aluno);
        $sql->bindParam(':nasc', $data_nasc);
        $sql->bindParam(':foto', $foto);
        $sql->bindParam(':idturma', $idturma);
      

        $sql->execute();

        header('location:login.php');


    

}


$tipo = $_POST['tipo'] ?? false;

if(!isset($tipo)){
    header("Location: index.php");
}
    

if ($tipo == 'aluno'){
    Insere_aluno( $_POST['nome'], $_POST['data_nasc'], $diretorio.$img['name'], $_POST['idturma']);
    // Redireciona para a página inicial
    header('Location: index.php');
    die;
}elseif($tipo == 'turma'){
    Insere_turma($_POST['nome_turma'], $_POST['idcurso']);
     // Redireciona para a página inicial
    header('Location: index.php');
    die;
}
elseif($tipo == 'curso'){
    Insere_curso( $_POST['nome_curso'], $_POST['nivel_ensino']);
    // Redireciona para a página inicial
    header('Location: index.php');
    die;
}
elseif($tipo == 'nivel'){
    Insere_nivel( $_POST['nome_nivel']);
    // Redireciona para a página inicial
    header('Location: index.php');
    die;
};