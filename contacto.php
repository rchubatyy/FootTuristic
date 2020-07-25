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
    $con = mysqli_connect($hostname_conn,$username_conn,$password_conn, $database_conn);
mysqli_query($con,"SET NAMES 'utf8'");
mysqli_query($con,'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');

$carrinho= ("SELECT SUM(qtd) AS Total FROM carrinho WHERE sessao='".session_id()."'");
$resultado_carrinho = mysqli_query($con, $carrinho) or die(mysqli_error($con));
while ($total=mysqli_fetch_array($resultado_carrinho))
	{
	$itens=$total['Total'];
	$itens=$itens+0;
	}

// obter dados da Fábrica
$query = ("SELECT fabricas.Localidade FROM gerentes,fabricas WHERE Username='".$_SESSION['Username']."' AND gerentes_id=gerentes.id");
$resultado_query = mysqli_query($con, $query) or die(mysqli_error($con));
while ($total=mysqli_fetch_array($resultado_query))
	{
	$local_fabrica=$total['Localidade'];
	}

// Obter dados do lojista.
$query2 = ("SELECT id, NomeLoja, Localidade FROM lojistas WHERE Username='".$_SESSION['Username']."'");
$resultado_query2 = mysqli_query($con, $query2) or die(mysqli_error($con));
while ($total2=mysqli_fetch_array($resultado_query2))
	{
	$loja['Localidade']=$total2['Localidade'];
	$loja['Nome']=$total2['NomeLoja'];
	$lojaid=$total2['id'];
	}
?>
<body>
<?php
if ($_SESSION['TipoUtilizador']=="Lojista")
{
echo '<div id="templatemo_body_wrapper3">';
}
else if ($_SESSION['TipoUtilizador']=="Gerente")
{
echo '<div id="templatemo_body_wrapper2">';
}
else 
{
echo '<div id="templatemo_body_wrapper">';
}
?>
<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	<div id="site_title"><h1><a href="">Fábrica de calçado</a></h1></div>
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
        	<?php if ($_SESSION['TipoUtilizador']==""){ ?>
			<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categorias</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                       <li class="first"><a href="prod_casual.php">Casual</a></li>
                        <li class="last"><a href="prod_desporto.php">Desporto</a></li>   
                    </ul>
                </div>
            </div> <?php } ?>
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
     
            <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
            <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
            <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            </script>
<h2>Contactos</h2>
<div align="center">
<?php
include "conn.php";
    $con = mysqli_connect($hostname_conn,$username_conn,$password_conn, $database_conn);
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');
?>

<table width="680px" border="0" cellspacing="0" cellpadding="5">
<tr bgcolor="#ddd">
<th>Fábrica</th>
<th>Morada</th>
<th>Localidade</th>
<th>Telefone</th>
<th>Gerente</th>
</tr>
<?php
$query = ("SELECT * FROM fabricas,gerentes WHERE fabricas.`Gerentes_id`=gerentes.`id`");
$result = mysqli_query($conn, $query);
while ($rows = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td style='color:black'><center>".$rows['id']."</center></td>";
echo "<td style='color:black'><center>".$rows['Morada']."</center></td>";
echo "<td style='color:black'><center>".$rows['Localidade']."</center></td>";
echo "<td style='color:black'><center>".$rows['Telefone']."</center></td>";
echo "<td style='color:black'><center>".$rows['Nome']."</center></td>";
echo "</tr>";
}
echo "</table>";
echo "<br />";
echo "<br />";
?>
<?php
if ($_SESSION['TipoUtilizador'] == "Gerente")
 {
 echo '<table width="680px" border="0" cellspacing="0" cellpadding="5">';
echo '<tr bgcolor="#ddd">';
echo '<th>Loja</th>';
echo '<th>Morada</th>';
echo '<th>Localidade</th>';
echo '<th>Telefone</th>';
echo '<th>NIF</th>';
echo '</tr>';
$query2 = ("SELECT * FROM Lojistas");
$result2 = mysql_query($query2);
while ($rows = mysql_fetch_array($result2))
{
echo "<tr>";
echo "<td style='color:black'><center>".$rows['NomeLoja']."</center></td>";
echo "<td style='color:black'><center>".$rows['Morada']."</center></td>";
echo "<td style='color:black'><center>".$rows['Localidade']."</center></td>";
echo "<td style='color:black'><center>".$rows['Telefone']."</center></td>";
echo "<td style='color:black'><center>".$rows['NIF']."</center></td>";
echo "</tr>";
}
echo "</table>";
}
?>
</div>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<div id="templatemo_footer">
Copyright © 2014 <a href="">FootTuristic Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>
