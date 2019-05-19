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
 <!-- a tag form cria um documento interativo dentro do formulário -->
       <!-- O metodo POST é o encapsulamento da função ocutanto os parânmetros de login e senha na barra de url-->
       <!-- a tag input cria um botão para interação com o usuário final dentro do formulário -->
        <!-- a tag div faz divisao -->
        <!-- a tag width: troca a largura -->
        <!-- a tag margin: centraliza -->
<body>
 <div id= "corpo-form-Cad">     
     <h1>Cadastrar</h1>  
<form method="POST">
  <input type="text"     name= "nome"     placeholder="Nome completo" maxlength="30">
  <input type="text"     name= "telefone" placeholder="Telefone" maxlength="30">
 	<input type="email"    name= "email"    placeholder="Usuário" maxlength="40">
 	<input type="password" name= "senha"    placeholder="Senha"maxlength="15">
  <input type="password" name= "confSenha"placeholder="Confirmar Senha">
 	<input type="submit"   value="Cadastrar">
 
 	
</form>
  </div>

<?php 
#verificar se clicou no botao
if(isset($_POST['nome']))
{
  $nome = addslashes($_POST['nome']);
  $telefone = addslashes($_POST['telefone']);
  $email = addslashes($_POST['email']);
  $senha = addslashes($_POST['senha']);
  $confirmarSenha = addslashes($_POST['confSenha']);
  
  #verificar se esta preenchido
  if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
  {
     $u->conectar("projeto_pulseads","localhost","root","");
     if ($u->msgErro == "")# se esta tudo ok
     {  
        if ($senha == $confirmarSenha)
        {
          if($u->cadastrar($nome,$telefone,$email,$senha))
          {  
             ?>
             <div id="msg-sucesso">
              Cadastrado com sucesso! Acesse para entrar!
             </div>
             <?php 
          }
          else
          {
             ?> 
             <div class="msg-erro">
              Email ja cadastrado!
             </div>
             <?php 
            
          }  
        }
        else
        {
             ?>
             <div class="msg-erro">
               Senha e confimar senha nao correspondem!
             </div>  
             <?php 
           
        }
     }
     else
    {
      ?>
         <div class="msg-erro"> 
        echo Erro: ".$u->msgErro";
        </div> 
      <?php 
      
    }
  }else
  
  {
   
   ?>   <div class="msg-erro">
        Preencha todos os campos!
        </div>
    <?php 
  }

}

?>
</body>
</html>