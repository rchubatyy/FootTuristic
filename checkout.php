<?php
session_start();
include "conn.php";
$con = mysql_connect($hostname_conn,$username_conn,$password_conn);
$bd  = mysql_select_db($database_conn);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FootTuristic Calçado </title>
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

// Obter fábricas
$query_fabricas = ("SELECT * From Fabricas");
$res_q_fabricas = mysql_query($query_fabricas);
	
//Obter dados do utilizador
$username = $_SESSION['Username'];
$q_cliente = ("SELECT * FROM Clientes WHERE Username='".$username."' ");
$res_cliente = mysql_query($q_cliente);
while ($linha = mysql_fetch_array($res_cliente))
{
	$cliente['Nome'] = $linha['Nome'];
	$cliente['NIF'] = $linha['NIF'];
	$cliente['Morada'] = $linha['Morada'];
	$cliente['Localidade'] = $linha['Localidade'];
	$cliente['Telefone'] = $linha['Telefone'];
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
			</p>
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
                <li><a href="contacto.php">Contacte-nos</a></li>
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
<div id="content" class="float_r">
<h2>Pagamento</h2>
<h5><strong>Informação do utilizador</strong></h5>
			<div class="content_half float_l checkout">
			<fieldset><?php
			echo "<b>Nome: </b>";
			echo $cliente['Nome'];
			echo "<br />";
			echo "<b>Morada: </b>";
			echo $cliente['Morada'];
			echo "<br />";
			echo "<b>Localidade: </b>";
			echo $cliente['Localidade'];
			echo "<br />";
			echo "<b>NIF: </b>";
			echo $cliente['NIF'];
			echo "<br />";
			echo "<b>Telefone: </b>";
			echo $cliente['Telefone'];
			echo "<br />";
			?>
			</fieldset><br />
			Selecione a fábrica de onde quer efectuar a compra:<br />
				<?php
			echo "<form action='finalizar_compra.php?tipo=compra method='GET' >";
			echo '<select name="fabrica">';
			while ($rowf = mysql_fetch_array($res_q_fabricas)){
			echo "<option value='".$rowf['id']."'>".$rowf['Localidade']."</option>";
			} 
			?> 
			</select>
			</div>
            <div class="cleaner h50"></div>
            <h3>CARRINHO DE COMPRAS</h3>
            <h4>TOTAL A PAGAR: <strong>	
			<?php
			$total=$_POST['total_pagar'];
			if($total==null)
			$total=0;
			echo number_format($total,2,",","."); 
			echo " €";
			?>
			</strong></h4>
            <table style="border:1px solid #CCCCCC;" width="100%">
                <tr>
                    <td height="80px"> <img src="images/paypal.gif" alt="paypal" /></td>
                    <td width="400px;" style="padding: 0px 20px;">Recomendado se tem uma conta PayPal. Entrega mais rápida.
                    </td><?php
					if ($total==0)
                    echo "";
					else echo "<td><input type='submit' name='finalizar' value='FINALIZAR' /></td>";
					?>
                </tr> 
            </table> 
			<p><a href="produtos.php">Continuar a comprar</a></p>	
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