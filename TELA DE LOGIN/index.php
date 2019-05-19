<?php  
require_once 'CLASSES/usuarios.php';
$u = new Usuario;

?>


<html lang="pt-br">
 
 <head>
	<meta charset="utf-8">
	  <title>Login PulseADS</title>
	   <link rel="stylesheet" href="CSS/estilo.css">
 </head>
 
<body>
 <div id= "corpo-form">     
     <h1>Entrar</h1>  
<form method="POST">
 	<input type="email"    placeholder="Usuário" name= "email">
 	<input type="password" placeholder="Senha"   name= "senha">
 	<input type="submit" value="ACESSAR">
 	<a href="cadastrar.php">Ainda não é inscrito? <strong>Cadastre-se!</strong></a>
 	
</form>
  </div>
  
<?php  

if(isset($_POST['email']))
{
  $email = addslashes($_POST['email']);
  $senha = addslashes($_POST['senha']);

  if(!empty($email) && !empty($senha))
  {   
      $u->conectar("projeto_pulseads","localhost","root","");
          if($u->msgErro == "")
          {
          if($u->logar($email,$senha))
          {
             header("location: areaprivada.php");
          }
          else
          {
              echo "Email ou senha estao incorretos!";
          }
        } 
        else 
        {
            echo "Erro: ".$u->msgErro;
        }
    }else
   {
    echo "Preencha todos os campos!";
   }   
  }

?>
</body>
</html>