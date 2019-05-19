<?php 

  class Usuario {

  	 private $pdo; # Criaçao da variavel pdo
  	 public $msgErro = "";
     #------------------------------#-------------------------------

     
     public function conectar($nome, $host, $usuario, $senha)
     {
     	  global $pdo;
        global $msgErro;
     	try 
      {
          $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha); # instancia pdo recebe PDO
        } catch (PDOException $e) {
         $msgErro = $e->getMessage();
        } 
      }
      #----------------------------------#----------------------------------------------------
      
      public function cadastrar($nome, $telefone, $email, $senha)
    {
    	global $pdo;
    	# Verificar se ja existe o email cadastrado.
    	$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
    	$sql->bindValue(":e",$email);
    	$sql->execute();
    	if($sql->rowCount() > 0)
    	{
             return false; # ja esta cadastrado
    	}	
        else
        {
        	$sql = $pdo->prepare("INSERT INTO usuarios(nome, telefone, email, senha) VALUES(:n, :t, :e, :s)");
        	$sql->bindValue(":n",$nome);
        	$sql->bindValue(":t",$telefone);
        	$sql->bindValue(":e",$email);
        	$sql->bindValue(":s",md5($senha));
        	$sql->execute();
        	return true; # foi cadastrado com sucesso
        }	
      }

      #----------------------------------------------#--------------------------------------------------

     
     public function logar($email, $senha)
    {
    	global $pdo;
        #Verificar se o email e senha estao cadastrados, se sim
       $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
       $sql->bindValue(":e",$email);
       $sql->bindValue(":s",md5($senha));
       $sql->execute();
       if($sql->rowCount() > 0)
       {
             
           $dado = $sql->fetch();
           session_start();
           $_SESSION['id_usuario'] = $dado['id_usuario'];
           return true; # logado com sucesso
       }
       else #entrar no sistema(sessao)
       {    
           return false; # nao foi possivel logar
       } 
     }
}


?>