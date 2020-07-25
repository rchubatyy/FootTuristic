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
$con = mysqli_connect($hostname_conn,$username_conn,$password_conn, $database_conn);
mysqli_query($con,"SET NAMES 'utf8'");
mysqli_query($con,'SET character_set_connection=utf8');
mysqli_query($con,'SET character_set_client=utf8');
mysqli_query($con,'SET character_set_results=utf8');

// Obter dados do gerente 
$query = ("SELECT fabricas.Localidade FROM gerentes,Fabricas WHERE username='".$_SESSION['Username']."' AND gerentes_id=Gerentes.id");
$resultado_query = mysqli_query($con, $query) or die(mysqli_error());
while ($total=mysqli_fetch_array($resultado_query))
	{
	$local_fabrica=$total['Localidade'];
	}
	
// Obter dados do gerente 
$query_ger = ("SELECT id FROM gerentes WHERE username='".$_SESSION['Username']."' ");
$res_q_ger = mysqli_query($con, $query_ger);
while ($gid=mysqli_fetch_array($res_q_ger))
	{
	$gerenteid=$gid['id'];
	}
	
// Verificar número de encomendas pendentes e seus dados.
$query_encomendas=("SELECT pedidosencomenda.Data AS Data, pedidosencomenda.id AS encomenda_Id, lojistas.NomeLoja AS Nome_Loja, lojistas.Morada AS Morada_Loja, produtos.Nome AS Produto_Nome, produtos.Preco AS produto_Preco, quantidade, estado
FROM PedidosEncomenda, Lojistas, Gerentes, Produtos
WHERE Estado !=  'Concluida'
AND Lojistas_id = Lojistas.id
AND Gerentes.id =  '1'
AND Gerentes.id = Gerentes_id
AND Produtos_id = Produtos.id ");
$res_encomendas=mysqli_query($query_encomendas);
$num_encomendas=mysqli_num_rows($res_encomendas);
?>
<body>
<div id="templatemo_body_wrapper2">
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
               echo '<li><a href="gerir_encomendas.php" class="selected">Gerir Encomendas</a> </li>';
               echo '<li><a href="gerir_stock.php">Stocks</a></li>';
               echo '<li><a href="compras.php">Compras</a></li>'; 
			    echo '<li><a href="contactos.php">Contactos</a></li>';
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
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style>
<div id="content" class="float_r">
<h2>Alterar estado da encomenda/compra</h2>
<div align="center">
<?php
$id = $_GET['id'];
if ($_GET['tipo']=="encomenda")
{
$queryenc = ("SELECT * FROM pedidosencomenda where id=$id");
$resqueryenc = mysqli_query($conn, $queryenc);
while ($row=mysqli_fetch_array($resqueryenc))
	{
	$prod_id = $row['Produtos_id'];
	$qtd_prod = $row['Quantidade'];
	$estado_actual = $row['Estado'];
	}
?>
<fieldset class="fieldset-auto-width">
	<form align="left" name="alterar_enc" id="alterar_enc" method="post" action="">
	Estado:<br />
	<select name="estado_enc">
	<option value=""></option><?php
	if ($estado_actual=="Em Espera")
	{
		echo '<option value="Em Curso">Em Curso</option>';
		echo '<option value="Por pagar">Por pagar</option>';
		echo '<option value="Entregar">Entregar</option>';
		echo '<option value="Concluida">Concluida</option>';
	}
	else if ($estado_actual=="Em Curso")
	{
		echo '<option value="Por pagar">Por pagar</option>';
		echo '<option value="Entregar">Entregar</option>';
		echo '<option value="Concluida">Concluida</option>';
	}
	else if ($estado_actual == "Pago")
	{
		echo '<option value="Entregar">Entregar</option>';
		echo '<option value="Concluida">Concluida</option>';
	}
	else if ($estado_actual == "Entregar")
	{
		echo '<option value="Concluida">Concluida</option>';
	}
	
	?>
	</select>

	
	<br />
	<br />
	  <center><input type="submit" name="alterar" id="alterar" value="Alterar Estado"  /></br></center>
	 </form>
</fieldset> 

<?php
}
else 
{
$querycomp = ("SELECT * FROM compras where id=$id");
$resquerycomp = mysqli_query($conn, $querycomp);
while ($row=mysqli_fetch_array($resquerycomp))
	{
	$prod_id = $row['Produtos_id'];
	$qtd_prod = $row['Quantidade'];
	$estado_actual = $row['Estado'];
	}
	?>
<fieldset class="fieldset-auto-width">
	<form align="left" name="alterar_enc" id="alterar_enc" method="post" action="">
	Estado:<br />
	<select name="estado_enc">
	<option value=""></option> <?php
	if ($estado_actual=="Em Espera")
	{
		echo '<option value="Em Curso">Em Curso</option>';
		echo '<option value="Entregar">Entregar</option>';
		echo '<option value="Concluida">Concluida</option>';
	}
	else if ($estado_actual=="Em Curso")
	{
		echo '<option value="Entregar">Entregar</option>';
		echo '<option value="Concluida">Concluida</option>';
	}
	else if ($estado_actual == "Entregar")
	{
		echo '<option value="Concluida">Concluida</option>';
	}
	
	?>
	</select>

	
	<br />
	<br />
	  <center><input type="submit" name="alterar" id="alterar" value="Alterar Estado"  /></br></center>
	 </form>
</fieldset>
<?php
}
$query_stock = ("SELECT * FROM stock WHERE Produtos_id=$prod_id AND Fabricas_id=$gerenteid ");
$res_q_stock = mysqli_query($query_stock);
while ($row=mysqli_fetch_array($res_q_stock))
	{
	$id_stock = $row['id'];
	$qtd_stock = $row['Qtd_Stock'];
	}

?>
</div>
<?php

$novo_estado = $_POST['estado_enc'];
if ($_POST['alterar']=="Alterar Estado" && $novo_estado!="Concluida" && $novo_estado!="Entregar" && $_GET['tipo']=="encomenda")
{
	mysqli_query("UPDATE pedidosencomenda SET Estado='".$novo_estado."' WHERE id='".$id."'") or die(mysqli_error());
	echo("<script>location.href = 'gerir_encomendas.php';</script>");
}
else if ($_POST['alterar']=="Alterar Estado" && $novo_estado=="Entregar" && $_GET['tipo']=="encomenda")
{
	if ($qtd_stock < $qtd_prod)
	{
		echo "<br />";
		echo "<center>";
		echo "Não há produtos suficientes em stock para fazer a entrega!";
		echo ("<a href ='gerir_stock.php'> Ver stock</a>. <br />");
		echo "<img src='imgs/aviso.png' height='230' width='230'/>";
		echo "</center>";
	}
	else 
	{
		mysqli_query("UPDATE PedidosEncomenda SET Estado='".$novo_estado."' WHERE id='".$id."'") or die(mysqli_error());
		mysqli_query("UPDATE Stock SET Qtd_Stock=Qtd_Stock-$qtd_prod WHERE id=$id_stock");
		echo("<script>location.href = 'gerir_encomendas.php';</script>");
	}
}
else if ($_POST['alterar']=="Alterar Estado" && $novo_estado=="Concluida" && $_GET['tipo']=="encomenda")
{
	mysqli_query("UPDATE PedidosEncomenda SET Estado='".$novo_estado."' WHERE id='".$id."'") or die(mysqli_error());
	echo("<script>location.href = 'gerir_encomendas.php';</script>");
}

else if ($_POST['alterar']=="Alterar Estado" && $novo_estado!="Concluida" && $novo_estado!="Entregar" && $_GET['tipo']=="compra")
{
	mysqli_query("UPDATE Compras SET Estado='".$novo_estado."' WHERE id='".$id."'") or die(mysqli_error());
	echo("<script>location.href = 'compras.php';</script>");
}

else if ($_POST['alterar']=="Alterar Estado" && $novo_estado=="Entregar" && $_GET['tipo']=="compra")
{
	if ($qtd_stock < $qtd_prod)
	{
		echo "<br />";
		echo "<center>";
		echo "Não há produtos suficientes em stock para fazer a entrega!";
		echo ("<a href ='gerir_stock.php'> Ver stock</a>. <br />");
		echo "<img src='imgs/aviso.png' height='230' width='230'/>";
		echo "</center>";
	}
	else 
	{
		mysqli_query("UPDATE Compras SET Estado='".$novo_estado."' WHERE id='".$id."'") or die(mysqli_error());
		mysqli_query("UPDATE Stock SET Qtd_Stock=Qtd_Stock-$qtd_prod WHERE id=$id_stock");
		echo("<script>location.href = 'compras.php';</script>");
	}
}
else if ($_POST['alterar']=="Alterar Estado" && $novo_estado=="Concluida" && $_GET['tipo']=="compra")
{
	mysqli_query("UPDATE Compras SET Estado='".$novo_estado."' WHERE id='".$id."'") or die(mysqli_error());
	echo("<script>location.href = 'compras.php';</script>");
}
?>
</div>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<div id="templatemo_footer">

Copyright © 2014 <a href="index.php">FootTuristic Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>
