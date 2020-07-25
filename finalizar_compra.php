<?php
session_start();
include "conn.php";
$con = mysql_connect($hostname_conn,$username_conn,$password_conn);
$bd  = mysql_select_db($database_conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FootTuristic </title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
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
$carrinho = ("SELECT SUM(qtd) AS Total FROM carrinho WHERE sessao='".session_id()."'");
$resultado_carrinho = mysql_query($carrinho) or die(mysql_error());
$total="0";
while ($total=mysql_fetch_array($resultado_carrinho))
{
$itens=$total['Total'];
$itens=$itens+0;
}
$bd  = mysql_select_db($database_conn);
$query = ("SELECT Fabricas.Localidade FROM Gerentes,Fabricas WHERE Username='".$_SESSION['Username']."' AND Gerentes_id=Gerentes.id");
$resultado_query = mysql_query($query) or die(mysql_error());
while ($total=mysql_fetch_array($resultado_query))
	{
	$local_fabrica=$total['Localidade'];
	}
	
$query2 = ("SELECT id, NomeLoja, Localidade FROM Lojistas WHERE Username='".$_SESSION['Username']."'");
$resultado_query2 = mysql_query($query2) or die(mysql_error());
while ($total2=mysql_fetch_array($resultado_query2))
	{
	$loja['Localidade']=$total2['Localidade'];
	$loja['Nome']=$total2['NomeLoja'];
	$lojaid = $total2['id'];
	}
	
$query_cliente = ("SELECT * FROM Clientes WHERE Username='".$_SESSION['Username']."' ");
$res_cliente = mysql_query($query_cliente);
while ($linha = mysql_fetch_array($res_cliente))
{
	$clienteid = $linha['id'];
}

$query_carrinho=("SELECT * FROM carrinho WHERE sessao='".session_id()."'");
$res_carrinho = mysql_query ($query_carrinho);
?>
<body>
<?php
if ($_SESSION['TipoUtilizador']=="Lojista")
{
echo '<div id="templatemo_body_wrapper3">';
}
else
{
echo '<div id="templatemo_body_wrapper">';
}
?>
<div id="templatemo_wrapper">
<div id="templatemo_header">
    	<div id="site_title"><h1><a href="index.php">Fábrica de calçado</a></h1></div>
    <div id="header_right">
        	<p>
			<?php
			if (isset($_SESSION['Username']) && $_SESSION['TipoUtilizador']=="Gerente")
			{
			echo "<span STYLE='color:white'>Bem-vindo <b>" .$_SESSION['Username']." </b></span>";
			echo " | <a href='logout.php'>Sair</a></p>";
            echo "<p>
            	<mark><span STYLE='color:black'>Fábrica de ".$local_fabrica."
			</p></span></mark>";
			}
			else if (isset($_SESSION['Username']) && $_SESSION['TipoUtilizador']=="Lojista")
			{
			echo "<span STYLE='color:white'>Bem-vindo <b>" .$_SESSION['Username']." </b></span>";
			echo " | <a href='logout.php'>Sair</a></p>";
            echo "<p>Loja: 
            	<mark><span STYLE='color:black'>".$loja['Nome']." ".$loja['Localidade']."
			</p></span></mark>";
			}
			else if (isset($_SESSION['Username']) && $_SESSION['TipoUtilizador']=="")
			{
			echo "<span STYLE='color:white'>Bem-vindo <b>" .$_SESSION['Username']." </b></span>";
			echo " | <a href='perfil.php'>A minha conta</a> | <a href='logout.php'>Sair</a></p>";
            echo '<p>
            	Carrinho de Compras: <strong>'.$itens.' itens</strong> ( <a href="carrinho.php">Ver carrinho</a> )
			</p>';
			}
			else
			{
			echo '<p><a href="registo.php">Registar</a> | <a href="login_func.php">Login</a></p>';
			echo '<p>Registe-se para criar uma conta ou faça Login para iniciar sessão.</p>';
			}
			?>
			</p>
		</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
<div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
           <ul>
		   <?php
				if($_SESSION['TipoUtilizador']=="Lojista")
				{ 
			   echo '<li><a href="encomendar.php">Encomendar</a></li>';
               echo '<li><a href="ver_encomendas.php">Ver Encomendas</a> </li>';
			   echo '<li><a href="contacto.php" class="selected">Contactos</a></li>';
			   }
			   else if ($_SESSION['TipoUtilizador']=="Gerente")
			   {
			   echo '<li><a href="gerir_encomendas.php">Gerir Encomendas</a></li>';
               echo '<li><a href="gerir_stock.php">Stocks </a> </li>';
			   echo '<li><a href="compras.php">Compras</a></li>';
			   echo '<li><a href="contacto.php" class="selected">Contactos</a></li>';
			   }
			   else
			   { 
			   echo '<li><a href="index.php">Home</a></li>';
			   echo '<li><a href="produtos.php">Produtos</a> </li>';
			   echo '<li><a href="sobre.php">Sobre nós</a> </li>';
			   echo '<li><a href="faq.php">FAQ</a></li>';
			   echo '<li><a href="contacto.php" class="selected">Contactos</a></li>';
                }
			?>
			</ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <?php  if($_SESSION['TipoUtilizador']=="Gerente")
		{ ?>
		<div id="templatemo_search">
            <form action="pesquisa_func.php?" method="get">
              <input type="text" value="Introduza o NIF..." name="keyword" id="keyword" title="keyword" onfocus="if(this.value=='Introduza o NIF...') this.value='';"" onblur="clearText(this)" class="txt_field" />
			  <input type="submit" name="" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
		<?php }
		 else if ($_SESSION['TipoUtilizador']=="Lojista")
		{ ?>
		<div id="templatemo_search">
            <form action="pesquisa_func.php" method="get">
              <input type="text" value="Introduza a localidade..." name="keyword" id="keyword" title="keyword" onfocus="if(this.value=='Introduza a localidade...') this.value='';"" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
	   <?php }
		else { ?>
		<div id="templatemo_search">
            <form action="pesquisa.php" method="get">
              <input type="text" value="Introduza o nome do produto..." name="keyword" id="keyword" title="keyword" onfocus="if(this.value=='Introduza o nome do produto...') this.value='';"" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
		<?php } ?>
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

<div id="content" class="float_r">
<h2>Pagamento</h2>
<div align="center">
<?php
$id = $_GET['id'];
$data = date('Y-m-d');
$fabrica_sel = $_GET['fabrica'];
if ($_GET['tipo']=="encomenda")
 {
	$estado="Pago";
	mysql_query("UPDATE PedidosEncomenda SET Estado='".$estado."' WHERE id='".$id."'");
	echo "Compra efectuada com sucesso! <br/>";
	echo '<a href="ver_encomendas.php">Ver encomendas.</a><br /><br />';
	echo '<img src="imgs/check.png" height="150" width="150"/><br />';
 }
else
 {
	$estado="Em Espera";
	while ($carro= mysql_fetch_array($res_carrinho))
	{
	$qtd = $carro['qtd'];
	$produtoid = $carro['cod'];
	mysql_query("INSERT INTO `Compras` (`Quantidade`, `Clientes_id`, `Produtos_id`, `Estado`, `Data`, `Fabricas_id`)
				VALUES (\"".$qtd."\", \"".$clienteid."\", \"".$produtoid."\", \"".$estado."\", \"".$data."\", \"".$fabrica_sel."\")"); 
	
	mysql_query("UPDATE `Produtos` SET Qtd_Vendas=Qtd_Vendas+$qtd WHERE id=$produtoid"); 
	}
	mysql_query ("DELETE FROM carrinho WHERE sessao='".session_id()."'");
	echo "Compra efectuada com sucesso! <br/>";
	echo 'Ir para<a href="index.php"> página inicial.</a><br /><br />';
	echo '<img src="imgs/check.png" height="150" width="150"/><br />';
 }
?>  
</div>     
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