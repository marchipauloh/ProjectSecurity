<?php 
$email = $_POST['email'];
$entrar = $_POST['entrar'];
$senha = $_POST['senha'];
session_start();

//conexão com o db (cria)
$connect = mysqli_connect("127.0.0.1","root","","segurancaDB");

//apertou o botão entrar
  if (isset($entrar)) {
    if(empty($email)){
       echo"<script language='javascript' type='text/javascript'>
        alert('Preencha o campo email!');window.location
        .href='login.html';</script>";
        die();
    }

    if(empty($senha)){
       echo"<script language='javascript' type='text/javascript'>
        alert('Preencha o campo senha!');window.location
        .href='login.html';</script>";
        die();
    }
    if(strlen($senha) < 5){
       echo"<script language='javascript' type='text/javascript'>
        alert('Campo senha incompleto, coloque 6 caracteres!!');window.location
        .href='login.html';</script>";
        die();
    }

    if(!empty($email) && !empty($senha)){ 
      $senhaEnCripty = md5($senha);

        $selectUser = "SELECT * FROM Usuarios WHERE email = '$email' AND senha = '$senhaEnCripty'";
        $verifica = mysqli_query($connect, $selectUser) or die("erro ao selecionar");
        if (mysqli_num_rows($verifica)<=0){
          echo"<script language='javascript' type='text/javascript'>
          alert('Email e/ou senha incorretos');window.location
          .href='login.html';</script>";
          die();
        }else{
          $_SESSION['email'] = $email;
          //setcookie("email",$email);
          header("Location:../menu/menu.html");
        }
    }
  }
?>