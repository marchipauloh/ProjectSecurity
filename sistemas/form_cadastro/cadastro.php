<?php 

$nome = $_POST['nome']; 
$email = $_POST['email'];
$senha = $_POST['senha'];
$senhaConfirma = $_POST['senhaConfirma'];
$emailDB = '';

//conexão com o db (cria)
$connect = mysqli_connect("127.0.0.1","root","","segurancaDB");

//conexão com o db entra
//$db = mysqli_select_db('segurancaDB');

//verifica se o login já existe
$selectEmail = "SELECT email FROM Usuarios WHERE email = '$email'";
$existeEmail = mysqli_query($connect,$selectEmail);

if(!empty($existeEmail)){
	$arrayEmail = mysqli_fetch_array($existeEmail);
	$emailDB = $arrayEmail['email'];
}


//valida campos
if($nome == "" || $nome == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo Nome deve ser preenchido');window.location.href='cadastro.html';</script>";
    die();
}

if($email == "" || $email == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo Email deve ser preenchido');window.location.href='cadastro.html';</script>";
    die();
}

if($senha == "" || $senha == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo Senha deve ser preenchido');window.location.href='cadastro.html';</script>";
    die();
}

if($senhaConfirma == "" || $senhaConfirma == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo Confrimar senha deve ser preenchido');window.location.href='cadastro.html';</script>";
    die();
}

if(strlen($senha) < 5 || strlen($senhaConfirma) < 5){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo Senha e Confirmar Senha devem ser maiores que 5 digitos');window.location.href='cadastro.html';</script>";
    die();
}else{
	if($senha != $senhaConfirma){
		 echo"<script language='javascript' type='text/javascript'>
   		 alert('O campo Senha e Confirmar Senha devem ser iguais');window.location.href='cadastro.html';</script>";
   		 die();
	}else{
		$senhaCripty = md5($senha);		
	}
} 

if($emailDB == $email){

	echo"<script language='javascript' type='text/javascript'>
	alert('Esse Email já foi cadastrado');window.location.href='cadastro.html';</script>";
	die();

}else{
	$data = date('Y-m-d H:i:s');

	$insereUsuario = "INSERT INTO Usuarios(nome,email,senha,dtHora) VALUES ('$nome','$email','$senhaCripty','$data')";
	$resul = mysqli_query($connect,$insereUsuario);

	if($resul){
	  echo"<script language='javascript' type='text/javascript'>
	  alert('Usuário cadastrado com sucesso!');window.location.
	  href='../form_login/login.html'</script>";
	}else{
	  echo"<script language='javascript' type='text/javascript'>
	  alert('Não foi possível cadastrar esse usuário');window.location
	  .href='cadastro.html'</script>";
	}
}
    
?>