
<?php



require('func/sanitize_filename.php');

if(isset($_FILES['imagem'])){
    $img = $_FILES['imagem'];
    $diretorio = 'assets/imagem/';

    if($diretorio.$img['name'] != $diretorio){
        $imagem = $diretorio.$img['name'];
      }
          else{ $imagem = $_POST['imagem_t'];}
}




//Realiza o altera DOS niveis de ensino
function altera_nivel($nome_nivel)
{
require('pdo.inc.php');
        $sql = $conex->prepare("UPDATE nivel_ensino SET nome_nivel = :nome  WHERE id = :id");

        $sql->bindParam(':nome', $nome_nivel);

        $sql->execute();



}

    //----------------------------------------------------------------------------------
//Realiza o altera DOS cursos
function altera_curso($nome_curso, $nivel_ensino)
{
require('pdo.inc.php');
        $sql = $conex->prepare("UPDATE curso SET nome_curso = :nome, nivel_ensino_idNivel_ensino = :idnivel  WHERE id = :id");

        $sql->bindParam(':nome', $nome_curso);
        $sql->bindParam(':idnivel', $nivel_ensino);

        $sql->execute();



}

    //----------------------------------------------------------------------------------
//Realiza o altera Das turmas
function altera_turma($nome_turma, $idcurso)
{
require('pdo.inc.php');
        $sql = $conex->prepare("UPDATE turma SET nome_turma = :nome, cursos_idcursos = :idcurso  WHERE id = :id");
        $sql->bindParam(':nome', $nome_turma);
        $sql->bindParam(':idcurso', $idcurso);

        $sql->execute();



}

    //----------------------------------------------------------------------------------
  
//altera aluno
function altera_aluno($nome_aluno, $data_nasc,  $foto, $idturma)
{
require('pdo.inc.php');
       

        //Realiza o altera DOS JOGADORES
        $sql = $PDO->prepare("UPDATE alunos SET nome_aluno = :nome, data_nasc = :nasc, foto = :foto, turmas_idturmas = :idturma  WHERE id = :id");

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
    altera_aluno( $_POST['nome'], $_POST['data_nasc'], $diretorio.$img['name'], $_POST['idturma']);
    // Redireciona para a página inicial
    header('Location: index.php');
    die;
}elseif($tipo == 'turma'){
    altera_turma($_POST['nome_turma'], $_POST['idcurso']);
     // Redireciona para a página inicial
    header('Location: index.php');
    die;
}
elseif($tipo == 'curso'){
    altera_curso( $_POST['nome_curso'], $_POST['nivel_ensino']);
    // Redireciona para a página inicial
    header('Location: index.php');
    die;
}
elseif($tipo == 'nivel'){
    altera_nivel( $_POST['nome_nivel']);
    // Redireciona para a página inicial
    header('Location: index.php');
    die;
};

