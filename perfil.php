<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FootTuristic Calçado</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/forms.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
</head>
<?php
include "conn.php";
    $con = mysqli_connect($hostname_conn,$username_conn,$password_conn,$database_conn);
mysqli_query($con,"SET NAMES 'utf8'");
mysqli_query($con,'SET character_set_connection=utf8');
mysqli_query($con,'SET character_set_client=utf8');
mysqli_query($con,'SET character_set_results=utf8');
$carrinho = ("SELECT * FROM carrinho WHERE sessao='".session_id()."'" );
$carrinho2 = ("SELECT SUM(qtd) AS Total FROM carrinho WHERE sessao='".session_id()."'");
$resultado_carrinho = mysqli_query($con, $carrinho2) or die(mysqli_error($con));
while ($total=mysqli_fetch_array($resultado_carrinho))
{
$itens=$total['Total'];
}
?>
<?php
$username=$_SESSION['Username'];
$query = ("SELECT * FROM clientes WHERE Username='".$username."'");
$resultado = mysqli_query($con, $query) or die(mysql_error($con));
while ($row=mysqli_fetch_array($resultado))
{
	$perfil = $row;
}

$query_cl = ("SELECT SUM(Quantidade) AS Total FROM compras WHERE Clientes_id='".$perfil['id']."' ");
$res_q_cl = mysqli_query($con, $query_cl);
while ($linha = mysqli_fetch_array($res_q_cl))
{
	$num_compras = $linha['Total']+0;
}
?>
<body>
<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	<div id="site_title"><h1><a href="index.php">Fábrica de calçado</a></h1></div>
        <div id="header_right">
        	<p>
			<?php
			if (isset($_SESSION['Username']))
			{
			echo "<span STYLE='color:white'>Bem-vindo <b>" .$_SESSION['Username']." </b></span>";
			echo " | <a href='perfil.php'>A minha conta</a> | <a href='logout.php'>Sair</a></p>";
            echo '<p>
            	Carrinho de Compras: <strong>'.$itens.' itens</strong> ( <a href="carrinho.php">Ver carrinho</a> )
			</p>';
			}
			else {
			echo '<p><a href="registo.php">Registar</a> | <a href="login.php">Login</a></p>';
			echo '<p>Registe-se para criar uma conta ou faça Login para iniciar sessão.</p>';
			}
			?>
		</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
<div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="produtos.php">Produtos</a>
                </li>
                <li><a href="sobre.php">Sobre nós</a>
                </li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="contacto.php">Contactos</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="pesquisa.php" method="get">
              <input type="text" value="Introduza o nome do produto..." name="keyword" id="keyword" title="keyword" onfocus="if(this.value=='Introduza o nome do produto...') this.value='';"" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
</div> <!-- END of templatemo_menubar -->
    
<div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categorias</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                       <li class="first"><a href="prod_casual.php">Casual</a></li>
                        <li class="last"><a href="prod_desporto.php">Desporto</a></li>   
                    </ul>
                </div>
            </div>
			<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Revendedores </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="http://www.zara.com/pt/"><img src="imgs/zara-logo.jpg" height="58px" width="58px" alt="image" /></a>
                        <h4><a href="#">ZARA</a></h4>
                        <p class="price">Lisboa, Porto</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="http://www.bershka.com/pt/pt/#"><img src="imgs/bershka-logo.jpeg" alt="Bershka" height="58px" width="58px" /></a>
                        <h4><a href="http://www.bershka.com/pt/pt/#">Bershka</a></h4>
                        <p class="price">Funchal, Faro</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="http://www.massimodutti.com/pt/pt/"><img src="imgs/Massimo_Dutti-logo.gif" height="58px" width="58px" alt="image" /></a>
                        <h4><a href="#">Massimo Dutti</a></h4>
                        <p class="price">Lisboa, Ponta Delgada</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>      
<h1>Perfil de utilizador</h1>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style>
<div align="center">
<?php
if (!isset($_POST['Editar']))
{
?>
<fieldset class="fieldset-auto-width">
	<legend><b><?php echo "$username" ?></b></legend>
	<font face="Arial">
	<form align="left" name="perfil" id="perfil" method="post" action="?editar=perfil">
	 <?php 
	 echo "<br/><b>Nome completo: </b>" .$perfil['Nome']."<br/>";
	 echo "<br/><b>Morada: </b>" .$perfil['Morada']."<br />";
	 echo "<br/><b>Localidade: </b>" .$perfil['Localidade']."<br />";
	 echo "<br/><b>Telefone: </b>" .$perfil['Telefone']."<br />";
	 echo "<br/><b>NIF: </b>" .$perfil['NIF']."<br /><br />";
	 echo "<br/><b>N.º Produtos comprados: </b>" .$num_compras."<br />";
	 
	?>
	<br />
	  <center><input type="submit" name="Editar" id="submeter" value="Editar perfil"  /></center><br />
	</form>
	<form method="post" action="?editar=pass">
	 <center><input type="submit" name="Editar" id="alterarpass" value="Alterar password"  /></center></br>
	</form>
</fieldset>
<?php
}
else if($_POST['Editar']=="Editar perfil"){
echo '<fieldset class="fieldset-auto-width">';
echo "<legend><b>" .$username. "</b></legend>";
echo '<form align="left" name="alterarperfil" method="post" action="editar_perfil.php">';
echo "<b>Nome completo: </b><br /><input size=35 type='text' name='nome' value='".$perfil['Nome']."'><br>";
echo "<b>Morada: </b><br /><input type='text' size=40 name='morada' value='".$perfil['Morada']."'><br>";
echo "<b>Localidade: </b><br /><input type='text' name='localidade' value='".$perfil['Localidade']."'><br>";
echo "<b>Telefone: </b><br /><input type='text' name='telefone' value='".$perfil['Telefone']."'><br>";
echo "<b>NIF: </b><br /><input type='text' name='nif' value='".$perfil['NIF']."'><br>";
echo '<input type="hidden" name="Editar" id="alterarperfil" value=""  />';
echo "<a href='javascript:history.back()' title='Cancelar'>Cancelar</a>";
echo '<input type="hidden" name="editar_perfil" value="perfil"  />';
echo '<center><input type="submit" name="ok" id="alterarperfilok" value="OK"  /></center></br>';
echo "</form>";
echo "</fieldset>";
}

else if ($_POST['Editar']=="Alterar password"){
echo '<fieldset class="fieldset-auto-width">';
echo "<legend><b>" .$username. "</b></legend>";
echo '<form align="left" name="alterarpass" method="post" action="editar_perfil.php">';
//echo "<b>Password actual: </b><br /><input type='password' onBlur='verificar_password(password_actual,erro_pass2)'name='password_actual' value=''><br />";
//echo '<div id="erro_pass2" hidden="true"><font face="Arial" size="1px" color="red">Password inválida! Tem de ter pelo menos 4 caracteres.</font></div>';
echo "<b>Nova password: </b><br /><input type='password' onKeyUp='verificar_password(nova_password,erro_pass)' name='nova_password' value=''><br />";
echo '<div id="erro_pass" hidden="true"><font face="Arial" size="1px" color="red">Password inválida! Tem de ter pelo menos 4 caracteres.</font></div>';
echo '<center><input type="hidden" "name="Editar" id="alterarpasss" value=""  /></center><br/>';
echo "<a href='javascript:history.back()' title='Cancelar'>Cancelar</a>";
echo '<input type="hidden" name="editar_perfil" value="pass"  />';
echo '<center><input type="submit" name="alterar_pass" id="alterarpassok" value="OK"  /></center><br/>';
echo "</form>";
echo "</fieldset>";
}
?>
</div>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<div id="templatemo_footer">
<p><a href="index.php">Home</a> | <a href="produtos.php">Produtos</a> | <a href="sobre.php">Sobre nós</a> | <a href="faq.php">FAQ</a> | <a href="contacto.php">Contactos</a>
</p>
Copyright © 2014 <a href="index.php">FootTuristic Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>
