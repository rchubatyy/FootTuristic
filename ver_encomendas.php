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
$con = mysql_connect($hostname_conn,$username_conn,$password_conn);
$bd  = mysql_select_db($database_conn);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

// Obter dados do gerente 
$query = ("SELECT Fabricas.Localidade FROM Gerentes,Fabricas WHERE Username='".$_SESSION['Username']."' AND Gerentes_id=Gerentes.id");
$resultado_query = mysql_query($query) or die(mysql_error());
while ($total=mysql_fetch_array($resultado_query))
	{
	$local_fabrica=$total['Localidade'];
	}
	
// Obter dados do lojista
$query2 = ("SELECT id, NomeLoja, Localidade FROM Lojistas WHERE Username='".$_SESSION['Username']."'");
$resultado_query2 = mysql_query($query2) or die(mysql_error());
while ($total2=mysql_fetch_array($resultado_query2))
	{
	$loja['Localidade']=$total2['Localidade'];
	$loja['Nome']=$total2['NomeLoja'];
	$lojaid=$total2['id'];
	}
	
// Verificar número de encomendas pendentes e seus dados.
$query_encomendas=("SELECT PedidosEncomenda.Data AS Data, PedidosEncomenda.id AS Encomenda_Id, Gerentes.Localidade AS Localidade_Fabrica, Fabricas.Morada as Morada_Fabrica, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM PedidosEncomenda, Lojistas, Gerentes, Fabricas, Produtos
WHERE Estado !=  'Concluida'
AND Lojistas_id = $lojaid
AND Lojistas_id = Lojistas.id
AND Produtos_id = Produtos.id 
AND Gerentes.id = Fabricas.Gerentes_id
AND Gerentes.id = PedidosEncomenda.Gerentes_id
");
$res_encomendas=mysql_query($query_encomendas);
$num_encomendas=mysql_num_rows($res_encomendas);

// Obter encomendas anuais e seus dados.
$query_encomendas3=("SELECT PedidosEncomenda.Data AS Data, PedidosEncomenda.id AS Encomenda_Id, Lojistas.NomeLoja AS Nome_Loja, Lojistas.Morada AS Morada_Loja, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM PedidosEncomenda, Lojistas, Produtos
WHERE Estado =  'Concluida'
AND Lojistas_id = Lojistas.id
AND Lojistas.id = $lojaid
AND Produtos_id = Produtos.id 
AND PedidosEncomenda.Data LIKE '%2014%'");
$res_encomendas3=mysql_query($query_encomendas3);

//Obter número de e ganhos com as encomendas anuais.
$num_enc_anual = mysql_num_rows($res_encomendas3);
while ($res=mysql_fetch_array($res_encomendas3))
{
 $dinheiro_enc_anual = ($res['Quantidade']*$res['Produto_Preco']) + $dinheiro_enc_anual;
}

// Obter encomendas totais e seus dados.
$query_encomendas2=("SELECT PedidosEncomenda.Data AS Data, PedidosEncomenda.id AS Encomenda_Id, Lojistas.NomeLoja AS Nome_Loja, Lojistas.Morada AS Morada_Loja, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM PedidosEncomenda, Lojistas, Produtos
WHERE Estado =  'Concluida'
AND Lojistas_id = Lojistas.id
AND Lojistas.id = $lojaid
AND Produtos_id = Produtos.id ");
$res_encomendas2=mysql_query($query_encomendas2);

//Obter número de e ganhos com as encomendas totais.
$num_enc = mysql_num_rows($res_encomendas2);
while ($res2=mysql_fetch_array($res_encomendas2))
{
 $dinheiro_enc = ($res2['Quantidade']*$res2['Produto_Preco']) + $dinheiro_enc;
}

?>
<body>
<?php
if ($_SESSION['TipoUtilizador']=="Gerente")
{
echo '<div id="templatemo_body_wrapper2">';
}
else
{
echo '<div id="templatemo_body_wrapper3">';
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
			else {
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
				if($_SESSION['TipoUtilizador']=="Gerente")
				{ 
			   echo '<li><a href="index_func.php">Home</a></li>';
               echo '<li><a href="ver_encomendas.php" class="selected">Ver Encomendas ('.$num_encomendas.')</a> </li>';
               echo '<li><a href="stock.php">Stocks</a></li>';
               echo '<li><a href="compras.php">Compras</a></li>'; }
			   else
			   { 
			   echo '<li><a href="encomendar.php">Encomendar</a> </li>';
               echo '<li><a href="ver_encomendas.php" class="selected">Ver Encomendas ('.$num_encomendas.')</a> </li>';
			   echo '<li><a href="contacto.php">Contactos</a> </li>';
                }
			?>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="pesquisa_func.php" method="get">
              <input type="submit" name="" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
              <input type="text" value="Introduza a localidade..." name="keyword" id="keyword" title="keyword" onfocus="if(this.value=='Introduza a localidade...') this.value='';"" onblur="clearText(this)" class="txt_field" />
            </form>
        </div>
</div> <!-- END of templatemo_menubar -->
    
<div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Encomendas totais</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
					<?php 
					echo "<li class='first'>Despesa: <span STYLE='color:red'>" .number_format($dinheiro_enc,2,',','.')." €  </span></li>";
					echo "<li class='last'>Nº Encomendas:<b> $num_enc </b></li>"; 
					?>
					</ul>
                </div>
            </div>
			<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Encomendas anuais</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
					<?php 
					echo "<li class='first'>Despesa: <span STYLE='color:red'>" .number_format($dinheiro_enc_anual,2,',','.')." €  </span></li>";
					echo "<li class='last'>Nº Encomendas:<b> $num_enc_anual </b></li>"; 
					?>
					</ul>
                </div>
            </div>
			<?php
			if (!isset($_SESSION['Username']))
			{
			?>
			<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Acesso restrito</h3>   
                <div class="content"> 
                	<ul>
                       <li><img src="imgs/key.png" height="20px" width="20px"><a href="login_func.php"> Funcionários</a></li>
                    </ul>
                </div>
            </div>
			<?php
			}
			else {}
			?>	
</div>
            <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
            <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
            <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            </script>

<div id="content" class="float_r">
<h2>Lista de encomendas pendentes</h2>
<form class="fieldset-auto-width" action="" method="get">
<table width="700px" border="0" cellspacing="0" cellpadding="5">
  <tr bgcolor="#ddd">
	<th width="95" align="center">DATA</th>
	<th width="70" align="center">FÁBRICA</th>
	<th width="190" align="center">MORADA</th>
	<th width="100" align="center">PRODUTO</th>
    <th width="60" align="center">PREÇO</th>
    <th width="30" align="center">QTD</th>
	<th width="80" align="center">TOTAL</th>
    <th width="70" align="center">ESTADO</th>
    <th width="70"></th>
  </tr>
    <tr>
    <?php 
	while ($rows = mysql_fetch_array($res_encomendas))
	{
	echo "<td><div align='center'>".$rows['Data']."</div></td>";
	echo "<td><div align='center'>".$rows['Localidade_Fabrica']."</div></td>";
	echo "<td><div align='center'>".$rows['Morada_Fabrica']."</div></td>";
	echo "<td><div align='center'>".$rows['Produto_Nome']."</div></td>";
    echo "<td><div align='center'>".number_format($rows['Produto_Preco'],2,',','.')." € </div></td>";
	echo "<td><div align='center'>".$rows['Quantidade']."</div></td>";
	echo "<td><div align='center'>".number_format($rows['Produto_Preco']*$rows['Quantidade'],2,',','.')." € </div></td>";
	if($rows['Estado']=="Por pagar")
	echo "<td><div align='center'><a href='pagar_encomenda.php?id=".$rows['Encomenda_Id']."'>Por pagar</a></div></td>";
	else echo "<td><div align='center'>".$rows['Estado']."</div></td>";
	if($rows['Estado']=="Entregar" || $rows['Estado']=="Pago" || $rows['Estado']=="Concluido")
	{echo "<td></td></tr>";}
	else echo "<td><div align='center'><a href='ver_encomendas.php?id=".$rows['Encomenda_Id']."&acao=excluir'>Remover</a></div></td></tr>";
	}
 ?>
</table>
</form>
</div>
<?php
$acao = $_GET['acao'];
$id =  $_GET['id'];
if ($acao=="excluir")
{
$query_enc_excluir = ("DELETE FROM PedidosEncomenda WHERE id ='".$id."'");
$exec_query_excluir = mysql_query($query_enc_excluir) or die(mysql_error());
echo("<script>location.href = 'ver_encomendas.php';</script>");
}
?>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<div id="templatemo_footer">
<p><a href="encomendar.php">Encomendar</a> | <a href="ver_encomendas.php">Ver Encomendas</a> | <a href="contacto.php">Contactos</a></p>
</p>
Copyright © 2014 <a href="#">FootTuristic Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>