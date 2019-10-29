<?php
	session_start();
	if((!isset ($_SESSION['email']) == true)){
	  unset($_SESSION['email']);
	  header('location:../form_login/login.php');
	}
	 
	$logado = $_SESSION['email'];
	
    if(!empty($logado) and $logado != ''){
      echo"Bem-Vindo, $logado <br>";
      echo"Essas informações <font color='red'>PODEM</font> ser acessadas por você";
    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
      echo"<br><a href='../form_login/login.html'>Faça Login</a> Para ler o conteúdo";
    }
?>