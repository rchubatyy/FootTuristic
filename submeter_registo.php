<?php
include "conn.php";
$con = mysql_connect($hostname_conn,$username_conn,$password_conn);
$bd  = mysql_select_db($database_conn);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Foot Turistic | Produtos</title>
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

<body>
<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1><a href="#">Fábrica de calçado</a></h1></div>
        <div id="header_right">
        	<p>
	        <?php
			if (isset($_SESSION['Username']))
			{
			echo "<span STYLE='color:white'>Bem-vindo <b>" .$_SESSION['Username']." </b></span>";
			echo " | <a href='perfil.php'>A minha conta</a> | <a href='logout.php'>Sair</a></p>";
            echo '<p>
            	Carrinho de Compras: <strong>0 itens</strong> ( <a href="carrinho.php">Ver carrinho</a> )
			</p>';
			}
			else {
			echo '<p><a href="registo.php">Registar</a> | <a href="login.php">Login</a></p>';
			echo '<p>Registe-se para criar uma conta ou faça Login para iniciar sessão.</p>';
			}
			?>
        <div class="cleaner"></div>
    </div>
</div>
<div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="produtos.php">Produtos</a>

                </li>
                <li><a href="sobre.php">Sobre nós</a>
                </li>
                <li><a href="faq.php">FAQs</a></li>
                <li><a href="contacto.php">Contactos</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="#" method="get">
              <input type="text" value=" " name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
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
<h1>Registo</h1>
<div align="center">
<?php
$username = $_POST['registo_username'];
$password = $_POST['registo_pass'];
$password_conf = $_POST['registo_pass_conf'];
$nome = $_POST['registo_nome'];
$morada = $_POST['registo_morada'];
$localidade = $_POST['registo_localidade'];
$telefone = $_POST['registo_telefone'];
$nif = $_POST['registo_nif'];

$query=("SELECT * FROM Clientes WHERE Username='$username'");
$users=mysql_query($query);

if(($nome=="") || !(preg_match('/[a-zA-Z ]*/', $nome))
	|| ($morada=="")
	|| ($localidade=="") || !(preg_match('/[a-zA-Z]*/',$localidade))
    || ($telefone=="") || !(preg_match('/[0-9]{9}/', $telefone))
	|| ($nif=="") || !(preg_match('/[0-9]{9}/', $nif))
	|| ($username=="")
	|| ($password=="") || !(preg_match('/[0-9a-zA-Z]{4,}/',$password))
	|| ($password_conf=="") || ($password_conf!=$password)
    )
{
	echo("<p>Dados inválidos! Verifique os dados introduzidos.</p>");
	echo "<a href='javascript:history.back()' class='backLink' title='Voltar atr&aacute;s'>Voltar atr&aacute;s</a><br />";
	echo "<img src='imgs/aviso.png' height='230' width='230'/>";
}

else if ((mysql_num_rows($users)>0))
{
	echo("<p>O username <b>$username</b> já existe. Por favor, insira outro.</p>");
	echo "<a href='javascript:history.back()' class='backLink' title='Voltar atr&aacute;s'>Voltar atr&aacute;s</a><br />";
	echo "<img src='imgs/aviso.png' height='230' width='230'/>";
}

else			
{
	mysql_query("INSERT INTO `Clientes` (`Nome`, `Morada`, `Localidade`, `Telefone`, `NIF`, `Username`, `Password`)
				VALUES (\"".$nome."\", \"".$morada."\", \"".$localidade."\", \"".$telefone."\", \"".$nif."\", \"".$username."\",\"".$password."\")");
 
	echo 'Registo efectuado com sucesso! Pode efectuar o login.<br />';	
	echo ' Ir para página de <a href="login.php">Login</a> ou ir para <a href="index.php">página inicial</a>.<br /><br />';
	echo '<img src="imgs/check.png" height="150" width="150"/><br />';
	
}
?>

</div>
<div class="cleaner"></div>
</div>
<div id="templatemo_footer">
<p><a href="index.php">Home</a> | <a href="produtos.php">Produtos</a> | <a href="sobre.php">Sobre nós</a> | <a href="faq.php">FAQ</a> | <a href="contacto.php">Contactos</a>
</p>
Copyright © 2014 <a href="index.php">FootTuristic Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->
</div>
</div>
</body>
</html>