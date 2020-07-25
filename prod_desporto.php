<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
<script type="text/javascript">
function checksenhora() {
   document.getElementById("botaofiltro").checked = true;
}
function checkhomem() {
   document.getElementById("botaofiltro2").checked = true;
}
function checkprecoasc()
{
	document.getElementById("botaofiltro3").checked = true;
}
function checkprecodesc()
{
	document.getElementById("botaofiltro4").checked = true;
}
function uncheckpreco()
{
	document.getElementById("botaofiltro3").checked = false;
	document.getElementById("botaofiltro4").checked = false;
}
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
    	<div id="site_title"><h1><a href="index.php">Fábrica de calçado</a></h1></div>
        <div id="header_right">
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
		</div>
        <div class="cleaner"></div>
    </div>
<div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="produtos.php" class="selected">Produtos</a>
              
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
                        <li class="last"><a href="prod_desporto.php"><b>Desporto</b></a></li>
                    </ul>
                </div>
            </div>
			
			<form action="" method="get">
			<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Filtrar por género:</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first"><input type="radio" name="genero" id="botaofiltro" onclick="uncheckpreco()" value="senhora">Senhora</li>
                        <li class="last"><input type="radio" name="genero" id="botaofiltro2" onclick="uncheckpreco()" value="homem">Homem</li>
                    </ul>
                </div>
			</div>
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Ordenar por:</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first"><input type="radio" name="ordenar" id="botaofiltro3" value="preco_asc">Preço (ascendente)</li>
                        <li class="last"><input type="radio" name="ordenar" id="botaofiltro4" value="preco_desc">Preço (descendente)</li>
                    </ul>
                </div>
            </div>
			<center><input type="submit" value="Filtrar"></center>
			</form>
        </div>
	
<h1>Lista de Produtos - Desporto</h1>
<div align="center">
<?php
include "conn.php";
$con = mysql_connect($hostname_conn,$username_conn,$password_conn);
$bd  = mysql_select_db($database_conn);
// Função para fazer as colunas dos produtos.
function GeraColunas($pNumColunas, $pQuery) {
$resultado = mysql_query($pQuery); //Executa a query guardada em $sql e guarda o resultado em $resultado.
echo ("<table width='100%' border='0'>\n");
 for($i = 0; $i <= mysql_num_rows($resultado); ++$i) {

 for ($intCont = 0; $intCont < $pNumColunas; $intCont++) {
  $linha = mysql_fetch_array($resultado);
  if ($i > $linha) {
   if ( $intCont < $pNumColunas-1) echo "</tr>\n";
   break;
  }

  $id = $linha[0];
  $nome = $linha[1];
  $gen = $linha[3];
  $img = $linha[6];
  $preco = number_format($linha[2],2,",",".");

  if ( $intCont == 0 ) echo "<tr>\n";
  echo "<td>";
?>
 <div class="product_box">
<?php
  if(mysql_num_rows($resultado) >0){
  echo "<table width='220' border='0' cellspacing='0' cellpadding='0'>";
  echo "<tr>";
  echo "<td width='250' height='141' valign='middle'><div align='center'><img src='produtos/".$img."' border='0' width='160' height='141' /></div></td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td>";
  echo "<table width='92%' border='0' align='center' cellpadding='0' cellspacing='0'>";
  echo "<tr>";
  echo "<td><div align='center' style='font-size:10px;font-family:Arial'><strong><a>".$nome."</a></strong></div><strong><div align='center'><font color='##00BFFF' size='4px'> € ".$preco."</a></strong></div><strong><div align='center'><font face='Arial' color='#000000' size=2px> ".$gen."  </font></strong></div></td>";
  echo "</tr>";
			if (isset($_SESSION['Username']))
			{
			echo "<tr>";
		  echo "<td><div align='center' style='font-size:10px;font-family:Arial'><a href='carrinho.php?id=".$id."&acao=incluir'><img src='imgs/addcarrinho.png' border='0'/></a></div><br></td>";
		  echo "</tr>";
		  echo "</table>";
		  echo "</td>";
		  echo "</tr>";
		  echo "</table>";
			}
			else {
  echo "</table>";
  echo "</td>";
  echo "</tr>";
  echo "</table>"; }
  }
  else {echo "<b>Não foram encontrados produtos.</b>";
	   echo "\n";
	   echo "<img src='imgs/aviso.png' height='230' width='230'/>";}
?>
 </div>
<?php
  echo "</td>";

  if ( $intCont == $pNumColunas-1 ) {
   echo "</tr>\n";
  } else { $i++; }
 }
 }
echo ('</table>');
}

if ($_REQUEST['genero']=="senhora")
{ 
	?>
	<script>checksenhora()</script>
	<?php
	if ($_REQUEST['ordenar']=="preco_asc")
	{
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<script>checksenhora()</script>
		<script>checkprecoasc()</script>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Genero="Senhora" AND Tipo="Desporto" ORDER BY Preco ASC';
		GeraColunas(3, $sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}
	
	else if ($_REQUEST['ordenar']=="preco_desc")
	{ 
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<script>checksenhora()</script>
		<script>checkprecodesc()</script>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Genero="Senhora" AND Tipo="Desporto" ORDER BY Preco DESC';
		GeraColunas(3, $sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}
	else
	{
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<script>checksenhora()</script>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Genero="Senhora" AND Tipo="Desporto" ORDER BY RAND()';
		GeraColunas(3,$sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}	
}
else if ($_REQUEST['genero']=="homem")
{ 
	?>
	<script>checkhomem()</script>
	<?php
	if ($_REQUEST['ordenar']=="preco_asc")
	{
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<script>checkprecoasc()</script>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Genero="Homem" AND Tipo="Desporto" ORDER BY Preco ASC';
		GeraColunas(3, $sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}
	
	else if ($_REQUEST['ordenar']=="preco_desc")
	{ 
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<script>checkprecodesc()</script>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Genero="Homem" AND Tipo="Desporto" ORDER BY Preco DESC';
		GeraColunas(3, $sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}
	else
	{
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Genero="Homem" AND Tipo="Desporto" ORDER BY RAND()';
		GeraColunas(3,$sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}	
}
else if ($_REQUEST['genero']=="")
{ 
	?>
	<?php
	if ($_REQUEST['ordenar']=="preco_asc")
	{
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<script>checkprecoasc()</script>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Tipo="Desporto" ORDER BY Preco ASC';
		GeraColunas(3, $sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}
	
	else if ($_REQUEST['ordenar']=="preco_desc")
	{ 
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<script>checkprecodesc()</script>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Tipo="Desporto" ORDER BY Preco DESC';
		GeraColunas(3, $sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}
	else
	{
		?>
		<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
		<tr>
		<td>
		<?php
		$sql = 'SELECT * FROM Produtos WHERE Tipo="Desporto" ORDER BY RAND()';
		GeraColunas(3,$sql)
		?>
		</td>
		</tr>
		</table>
		<?php
	}	
}
?>
</div>
<div class="cleaner"></div>
</div> 
<div id="templatemo_footer">
<p><a href="index.php">Home</a> | <a href="produtos.php">Produtos</a> | <a href="sobre.php">Sobre nós</a> | <a href="faq.php">FAQ</a> | <a href="contacto.php">Contactos</a>
</p>
Copyright © 2014 <a href="index.php">Foot-Tech Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->

</div> 
</body>
</html>