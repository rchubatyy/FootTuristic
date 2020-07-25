<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include "conn.php";
$con = mysqli_connect($hostname_conn,$username_conn,$password_conn, $database_conn);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Foot Turistic | Pesquisa</title>
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
$carrinho = ("SELECT SUM(qtd) AS Total FROM carrinho WHERE sessao='".session_id()."'");
$resultado_carrinho = mysqli_query($con,$carrinho) or die(mysqli_error($con));
$total="0";
while ($total=mysqli_fetch_array($resultado_carrinho))
{
$itens=$total['Total'];
$itens=$itens+0;
}
?>
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
    </div>
<div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="produtos.php">Produtos</a>
                    <ul>
                      
                  </ul>
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
<h1>Resultados da pesquisa</h1>
<div align="center">
<?php
// Função para fazer as colunas dos produtos.
function GeraColunas($conn, $pNumColunas, $pQuery) {
$resultado = mysqli_query($conn, $pQuery); //Executa a query guardada em $sql e guarda o resultado em $resultado.
echo ("<table width='100%' border='0'>\n");
 for($i = 0; $i <= mysqli_num_rows($resultado); ++$i) {

 for ($intCont = 0; $intCont < $pNumColunas; $intCont++) {
  $linha = mysqli_fetch_array($resultado);
  if ($i > $linha) {
   if ( $intCont < $pNumColunas-1) echo "</tr>\n";
   break;
  }
     if ($linha != null){
  $id = $linha[0];
  $nome = $linha[1];
  $gen = $linha[3];
  $img = $linha[6];
  $preco = number_format($linha[2],2,",",".");
     }
  if ( $intCont == 0 ) echo "<tr>\n";
  echo "<td>";
?>
 <div class="product_box">
<?php
 if(mysqli_num_rows($resultado) >0){
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
?>
<table cellSpacing=1 cellPadding=0 width="50%" align=center border=0>
<tr>
<td>
<?php
$pesquisa = $_GET['keyword'];
$query = ("SELECT * FROM produtos WHERE Nome LIKE '%$pesquisa%'");
GeraColunas($con, 3,$query)
?>
</td>
</tr>
</table>
		


</div>
<div class="cleaner"></div>
</div>
<div id="templatemo_footer">
<p><a href="index.php">Home</a> | <a href="produtos.php">Produtos</a> | <a href="sobre.php">Sobre nós</a> | <a href="faq.php">FAQ</a> | <a href="contacto.php">Contactos</a>
</p>
Copyright © 2014 <a href="index.php">FootTuristic Calçado</a> 
</div> 
</div>
</div>
</body>
</html>
