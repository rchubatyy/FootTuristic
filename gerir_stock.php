<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Foot-Tech Calçado</title>
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
$query_ger = ("SELECT id FROM Gerentes WHERE Username='".$_SESSION['Username']."' ");
$res_q_ger = mysql_query($query_ger);
while ($gid=mysql_fetch_array($res_q_ger))
	{
	$gerenteid=$gid['id'];
	}
$query = ("SELECT Fabricas.Localidade FROM Gerentes,Fabricas WHERE Username='".$_SESSION['Username']."' AND Gerentes_id=Gerentes.id");
$resultado_query = mysql_query($query) or die(mysql_error());
while ($total=mysql_fetch_array($resultado_query))
	{
	$local_fabrica=$total['Localidade'];
	}
// Obter dados do lojista
$query2 = ("SELECT NomeLoja, Localidade FROM Lojistas WHERE Username='".$_SESSION['Username']."'");
$resultado_query2 = mysql_query($query2) or die(mysql_error());
while ($total2=mysql_fetch_array($resultado_query2))
	{
	$loja['Localidade']=$total2['Localidade'];
	$loja['Nome']=$total2['NomeLoja'];
	}
// Verificar número de encomendas pendentes e seus dados.
$query_encomendas=("SELECT PedidosEncomenda.Data AS Data, PedidosEncomenda.id AS Encomenda_Id, Lojistas.NomeLoja AS Nome_Loja, Lojistas.Morada AS Morada_Loja, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM PedidosEncomenda, Lojistas, Gerentes, Produtos
WHERE Estado !=  'Concluida'
AND Lojistas_id = Lojistas.id
AND Gerentes.id = $gerenteid
AND Gerentes.id = Gerentes_id
AND Produtos_id = Produtos.id ");
$res_encomendas=mysql_query($query_encomendas);
$num_encomendas=mysql_num_rows($res_encomendas);

// Verificar encomendas concluídas e seus dados.
$query_encomendas2=("SELECT PedidosEncomenda.Data AS Data, PedidosEncomenda.id AS Encomenda_Id, Lojistas.NomeLoja AS Nome_Loja, Lojistas.Morada AS Morada_Loja, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM PedidosEncomenda, Lojistas, Gerentes, Produtos
WHERE Estado =  'Concluida'
AND Lojistas_id = Lojistas.id
AND Gerentes.id = $gerenteid
AND Gerentes.id = Gerentes_id
AND Produtos_id = Produtos.id ");
$res_encomendas2=mysql_query($query_encomendas2);

//Obter número de e ganhos com as encomendas totais.
$num_enc = mysql_num_rows($res_encomendas2);
while ($res=mysql_fetch_array($res_encomendas2))
{
 $dinheiro_enc = ($res['Quantidade']*$res['Produto_Preco']) + $dinheiro_enc;
}
$dinheiro_desp = $dinheiro_enc * 0.3;
$saldo = $dinheiro_enc-$dinheiro_desp;

//Disponibilizar os resultados da query para uso futuro.
$res_encomendas2=mysql_query($query_encomendas2);

// Obter compras anuais e seus dados.
$query_compras3=("SELECT Compras.Data AS Data, Compras.id AS Compra_Id, Clientes.Nome AS Nome_Cliente, Clientes.Morada AS Morada_Cliente, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM Compras, Clientes, Fabricas, Produtos
WHERE Estado =  'Concluida'
AND Clientes_id = Clientes.id
AND Fabricas.id =  $gerenteid
AND Fabricas.id = Fabricas_id
AND Produtos_id = Produtos.id 
AND Compras.Data LIKE '%2014%'");
$res_compras3=mysql_query($query_compras3);
$num_compras_anual = mysql_num_rows($res_compras3);

while ($res=mysql_fetch_array($res_compras3))
{
 $dinheiro_compras_anual = ($res['Quantidade']*$res['Produto_Preco']) + $dinheiro_compras_anual;
}
$dinheiro_desp_anual = $dinheiro_compras_anual * 0.3;
$saldo_compras_anual = $dinheiro_compras_anual-$dinheiro_desp_anual;

// Obter encomendas anuais e seus dados.
$query_encomendas3=("SELECT PedidosEncomenda.Data AS Data, PedidosEncomenda.id AS Encomenda_Id, Lojistas.NomeLoja AS Nome_Loja, Lojistas.Morada AS Morada_Loja, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM PedidosEncomenda, Lojistas, Gerentes, Produtos
WHERE Estado =  'Concluida'
AND Lojistas_id = Lojistas.id
AND Gerentes.id =  $gerenteid
AND Gerentes.id = Gerentes_id
AND Produtos_id = Produtos.id 
AND PedidosEncomenda.Data LIKE '%2014%'");
$res_encomendas3=mysql_query($query_encomendas3);


//Obter número de e ganhos com as encomendas anuais.
$num_enc_anual = mysql_num_rows($res_encomendas3);
while ($res=mysql_fetch_array($res_encomendas3))
{
 $dinheiro_enc_anual = ($res['Quantidade']*$res['Produto_Preco']) + $dinheiro_enc_anual;
}
$dinheiro_despenc_anual = $dinheiro_enc_anual * 0.3;
$saldo_enc_anual = $dinheiro_enc_anual-$dinheiro_despenc_anual;
$impostos_anual = ($saldo_enc_anual + $saldo_compras_anual) * 0.23;
$salarios_anual = 90000.00;
$saldo_anual = $saldo_enc_anual + $saldo_compras_anual - $salarios_anual - $impostos_anual;

//Obter tabela de stock para a fábrica em questão.
$stock_query = ("SELECT stock.id as stock_id, Nome, Preco, Qtd_Stock FROM stock,produtos WHERE Fabricas_id=$gerenteid AND produtos.id = stock.produtos_id ");
$res_stock = mysql_query($stock_query);

// Verificar número de compras pendentes e seus dados.
$query_compras=("SELECT Compras.Data AS Data, Compras.id AS Compra_Id, Clientes.Nome AS Nome_Cliente, Clientes.Morada AS Morada_Cliente, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM Compras, Clientes, Fabricas, Produtos
WHERE Estado !=  'Concluida'
AND Clientes_id = Clientes.id
AND Fabricas.id = $gerenteid
AND Fabricas.id = Fabricas_id
AND Produtos_id = Produtos.id ");
$res_compras=mysql_query($query_compras);
$num_compras=mysql_num_rows($res_compras);

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
               echo '<li><a href="gerir_encomendas.php">Gerir Encomendas ('.$num_encomendas.')</a> </li>';
               echo '<li><a href="gerir_stock.php" class="selected">Stocks</a></li>';
               echo '<li><a href="compras.php">Compras ('.$num_compras.')</a></li>'; 
			    echo '<li><a href="contacto.php">Contactos</a></li>';
			   }
			   else
			   { 
			   echo '<li><a href="encomendar.php">Encomendar</a> </li>';
               echo '<li><a href="ver_encomendas.php" class="selected">Ver Encomendas</a> </li>';
                }
			?>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="pesquisa_func.php?" method="get">
              <input type="text" value="Introduza o NIF..." name="keyword" id="keyword" title="keyword" onfocus="if(this.value=='Introduza o NIF...') this.value='';"" onblur="clearText(this)" class="txt_field" />
			  <input type="submit" name="" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
</div> <!-- END of templatemo_menubar -->
    
<div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Compras anuais</h3>   
             <div class="content"> 
                	<ul class="sidebar_list">
					<?php echo "<li class='first'>Ganhos: <span STYLE='color:green'>" .number_format($dinheiro_compras_anual,2,',','.')." €  </span></li>";
					echo "<li>Despesa: <span STYLE='color:red'>" .number_format($dinheiro_desp_anual,2,',','.')." €  </span></li>";
					echo "<li>Nº Compras:<b> $num_compras_anual </b></li>"; 
					if ($saldo_compras_anual<0)
					echo "<li class='last'>Saldo:<span STYLE='color:red'> <b>".number_format($saldo_compras_anual,2,',','.')." €  </b></span></li>";
					else echo "<li class='last'><b>Saldo:<span STYLE='color:green'> ".number_format($saldo_compras_anual,2,',','.')." €  </b></span></li>";
					?>
					</ul>
                </div>
            </div>
			<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Encomendas anuais</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
					<?php echo "<li class='first'>Ganhos: <span STYLE='color:green'>" .number_format($dinheiro_enc_anual,2,',','.')." €  </span></li>";
					echo "<li>Despesa: <span STYLE='color:red'>" .number_format($dinheiro_despenc_anual,2,',','.')." €  </span></li>";
					echo "<li>Nº Encomendas:<b> $num_enc_anual </b></li>"; 
					if ($saldo_enc_anual<0)
					echo "<li class='last'>Saldo:<span STYLE='color:red'> <b>".number_format($saldo_enc_anual,2,',','.')." €  </b></span></li>";
					else echo "<li class='last'><b>Saldo:<span STYLE='color:green'> ".number_format($saldo_enc_anual,2,',','.')." €  </b></span></li>";
					?>
					</ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3>Fluxo caixa anual</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
					<?php
					echo "<li class='first'>Encomendas:<span STYLE='color:green'> ".number_format($saldo_enc_anual,2,',','.')." € </span></li>";
					echo "<li>Compras:<span STYLE='color:green'> ".number_format($saldo_compras_anual,2,',','.')." €  </span></li>";
					echo "<li>Impostos: <span STYLE='color:red'> ".number_format($impostos_anual,2,',','.')." € </span></li>";
					echo "<li>Salários: <span STYLE='color:red'> ".number_format($salarios_anual,2,',','.')." €  </span> </li>";
					if ($saldo_anual<0)
					{echo "<li class='last'><b>Saldo:<span STYLE='color:red'> ".number_format($saldo_anual,2,',','.')." €  </span></b></li>";
					echo "Situação financeira: <span STYLE='color:red'>Negativa</span>";}
					else 
					{echo "<li class='last'><b>Saldo:<span STYLE='color:green'> ".number_format($saldo_anual,2,',','.')." €  </span></b></li>";
					echo "Situação financeira: <span STYLE='color:green'>Positiva</span>";}
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
<h2>Stock de produtos</h2>
<form class="fieldset-auto-width" action="" method="get">
<table width="380px" border="0" cellspacing="0" cellpadding="5">
  <tr bgcolor="#ddd">
	<th width="160" align="center">PRODUTO</th>
    <th width="60" align="center">PREÇO</th>
    <th width="30" align="center">STOCK</th>
    <th width="100"></th>
	<th width="80"></th>
  </tr>
    <tr>
    <?php 
	while ($stock = mysql_fetch_array($res_stock))
	{
	echo "<td><div align='center'>".$stock['Nome']."</div></td>";
	echo "<td><div align='center'>".number_format($stock['Preco'],2,',','.')." €  </div></td>";
	echo "<td><div align='center'>".$stock['Qtd_Stock']."</div></td>";
	echo "<td><div align='center'><a href='gerir_stock.php?altera=true&id=".$stock['stock_id']."'>Alterar</a></div></td>";
		if($stock['Qtd_Stock']<=5)
		echo "<td><div align='center'><span STYLE='color:red'>ATENÇÃO!</span></div></td></tr>";
		else echo "<td></td></tr>";
	}
 ?>
</table>
</form>
<?php
$id_stock = $_GET['id'];
if($_GET['altera']=="true")
{
	echo "<br />";
	echo "<fieldset>";
	echo "<form action='gerir_stock.php?altera=ok' method='post'>";
	echo "Novo stock:";
	echo "<input type='hidden' value=$id_stock name='idstock' /> ";
	echo "<input type='text' size='1' name='novostock' /> ";
	echo "<input type='submit' name='alterastock' value='Alterar'/>";
	echo "</form>";
	echo "</fieldset>";
}
?>
<?php
$novostock = $_POST['novostock'];
$id_stock = $_POST['idstock'];
if($_POST['alterastock']=="Alterar")
{

	mysql_query("UPDATE stock SET Qtd_Stock=$novostock WHERE id=$id_stock");
	echo("<script>location.href = 'gerir_stock.php';</script>");
}
?>
</div>
<?php

?>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<div id="templatemo_footer">

Copyright © 2014 <a href="#">Foot-Tech Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>