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

// Verificar compras totais concluídas e seus dados.
$query_compras2=("SELECT Compras.Data AS Data, Compras.id AS Compra_Id, Clientes.Nome AS Nome_Cliente, Clientes.Morada AS Morada_Cliente, Produtos.Nome AS Produto_Nome, Produtos.Preco AS Produto_Preco, Quantidade, Estado
FROM Compras, Clientes, Fabricas, Produtos
WHERE Estado =  'Concluida'
AND Clientes_id = Clientes.id
AND Fabricas.id = $gerenteid
AND Fabricas.id = Fabricas_id
AND Produtos_id = Produtos.id ");
$res_compras2=mysql_query($query_compras2);
$num_compras_total=mysql_num_rows($res_compras2);

//Obter número de e ganhos com as compras totais.
$num_comp = mysql_num_rows($res_compras2);
while ($res=mysql_fetch_array($res_compras2))
{
 $dinheiro_compras = ($res['Quantidade']*$res['Produto_Preco']) + $dinheiro_compras;
}
$dinheiro_desp = $dinheiro_compras * 0.3;
$saldo = $dinheiro_compras-$dinheiro_desp;

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
$num_enc_anual = mysql_num_rows($res_encomendas3);
while ($res=mysql_fetch_array($res_encomendas3))
{
 $dinheiro_enc_anual = ($res['Quantidade']*$res['Produto_Preco']) + $dinheiro_enc_anual;
}
$dinheiro_despenc_anual = $dinheiro_enc_anual * 0.3;
$saldo_enc_anual = $dinheiro_enc_anual-$dinheiro_despenc_anual;


//Obter fluxo de caixa anual
$num_compras_anual = mysql_num_rows($res_compras3);
while ($res=mysql_fetch_array($res_compras3))
{
 $dinheiro_compras_anual = ($res['Quantidade']*$res['Produto_Preco']) + $dinheiro_compras_anual;
}
$dinheiro_desp_anual = $dinheiro_compras_anual * 0.3;
$saldo_compras_anual = $dinheiro_compras_anual-$dinheiro_desp_anual;
$impostos_anual = ($saldo_compras_anual + $saldo_enc_anual) * 0.23;
$salarios_anual = 90000.00;
$saldo_anual = $saldo_compras_anual + $saldo_enc_anual - $salarios_anual - $impostos_anual;

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
               echo '<li><a href="gerir_stock.php">Stocks</a></li>';
               echo '<li><a href="compras.php" class="selected">Compras ('.$num_compras.')</a></li>';
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
            	<h3>Compras totais</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
					<?php echo "<li class='first'>Ganhos: <span STYLE='color:green'>" .number_format($dinheiro_compras,2,',','.')." €  </span></li>";
					echo "<li>Despesa: <span STYLE='color:red'>" .number_format($dinheiro_desp,2,',','.')." €  </span></li>";
					echo "<li>Nº Compras:<b> $num_compras_total </b></li>"; 
					if ($saldo<0)
					echo "<li class='last'>Saldo:<span STYLE='color:red'> <b>".number_format($saldo,2,',','.')." €  </b></span></li>";
					else echo "<li class='last'><b>Saldo:<span STYLE='color:green'> ".number_format($saldo,2,',','.')." €  </b></span></li>";
					?>
					</ul>
                </div>
            </div>
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
<h2>Lista de compras dos clientes</h2>
<form class="fieldset-auto-width" action="" method="get">
<table width="700px" border="0" cellspacing="0" cellpadding="5">
  <tr bgcolor="#ddd">
	<th width="100" align="center">DATA</th>
	<th width="90" align="center">CLIENTE</th>
	<th width="170" align="center">MORADA</th>
	<th width="100" align="center">PRODUTO</th>
    <th width="60" align="center">PREÇO</th>
    <th width="30" align="center">QTD</th>
	<th width="70" align="center">TOTAL</th>
    <th width="60" align="center">ESTADO</th>
    <th width="100"></th>
  </tr>
  <tr>
 <?php 
	while ($rows = mysql_fetch_array($res_compras))
	{
	echo "<td><div align='center'>".$rows['Data']."</div></td>";
	echo "<td><div align='center'>".$rows['Nome_Cliente']."</div></td>";
	echo "<td><div align='center'>".$rows['Morada_Cliente']."</div></td>";
	echo "<td><div align='center'>".$rows['Produto_Nome']."</div></td>";
    echo "<td><div align='center'>".number_format($rows['Produto_Preco'],2,',','.')." € </div></td>";
	echo "<td><div align='center'>".$rows['Quantidade']."</div></td>";
	echo "<td><div align='center'>".number_format($rows['Produto_Preco']*$rows['Quantidade'],2,',','.')." € </div></td>";
	echo "<td><div align='center'>".$rows['Estado']."</div></td>";
	if($rows['Estado']=="Entregar" || $rows['Estado']=="Pago" || $rows['Estado']=="Concluido")
	{echo "<td><div align='center'><a href='alterar_estado.php?tipo=compra&id=".$rows['Compra_Id']."&acao=alterar'>Alterar</a></tr>";}
	else 
	echo "<td><div align='center'><a href='alterar_estado.php?tipo=compra&id=".$rows['Compra_Id']."&acao=alterar'>Alterar</a>|<a href='compras.php?id=".$rows['Compra_Id']."&acao=excluir'>Remover</a></div></td></tr>";
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
$acao = $_GET['acao'];
$id =  $_GET['id'];
if ($acao=="excluir")
{
$query_compras_excluir = ("DELETE FROM Compras WHERE id ='".$id."'");
$exec_query_excluir = mysql_query($query_compras_excluir) or die(mysql_error());
echo ("<script>location.href = 'compras.php';</script>");
}
?>

</div>
<?php

?>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<div id="templatemo_footer">
Copyright © 2014 <a href="#">FootTuristic Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>