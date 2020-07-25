<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FootTuristic Calçado | FAQ</title>
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
    $con = mysqli_connect($hostname_conn,$username_conn,$password_conn,$database_conn);
$carrinho= ("SELECT SUM(qtd) AS Total FROM carrinho WHERE sessao='".session_id()."'");
$resultado_carrinho = mysqli_query($con, $carrinho) or die(mysqli_error());
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
                <li><a href="faq.php" class="selected">FAQ</a></li>
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
     
            <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
            <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
            <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            </script>

<div id="content" class="float_r">
<h2>Perguntas frequentes</h2>
<?php
include "conn.php";
$con = mysqli_connect($hostname_conn,$username_conn,$password_conn,$database_conn);
?>
<b>1. Como posso visualizar os produtos?</b><br />
R: Acedendo á página "Produtos" ou clicando diretamente na categoria de produtos no menu que se encontra à esquerda.<br /><br />

<b>2. Como posso pesquisar um produto em específico?</b><br />
R: Poderá pesquisar produtos através do campo de pesquisa que se situa à direita da página, bastando introduzir o nome ou parte do nome do produto que pretende.<br /><br />

<b>3. Como posso ordernar os produtos mais caros/baratos?</b><br />
R: Poderá filtrar a lista de produtos utilizando o menu à esquerda na página "Produtos" ou nas páginas das categorias de produtos. <br /><br />

<b>4. Como posso ver só os produtos para homem/senhora?</b><br />
R: Poderá filtrar a lista de produtos utilizando o menu à esquerda na página "Produtos" ou nas páginas das categorias de produtos. <br /><br />

<b>5. Como posso comprar produtos?</b><br />
R: Terá de efectuar o registo e o login para poder adicionar produtos ao carrinho e proceder ao pagamento.<br /><br />

<b>6. Como vejo o meu carrinho?</b><br />
R: Com o login efectuado, no cabeçalho da página, em "Ver carrinho".<br /><br />

<b>7. Quantos produtos posso comprar?</b><br />
R: Não há limitação sobre a quantidade de produtos a comprar.<br /><br />

<b>8. Como adiciono um produto ao carrinho?</b><br />
R: Apenas e só depois de efectuar login, clicando no botão "Add to Cart" que está por baixo do nome do produto.<br /><br />

<b>9. Como actualizo o carrinho?</b><br />
R: Para actualizar o carrinho, terá de abri-lo em "Ver Carrinho" e depois introduza a quantidade desejada do produto em questão utilizando a caixa de texto correspondente e clicando depois no botão "Actualizar".<br /><br />

<b>10. Como elimino produtos do carrinho?</b><br />
R: Pode eliminar produtos do carrinho clicando no "X" referente ao produto que se pretende eliminar. Caso queira eliminar todo o conteúdo do carrinho também pode fazer logout.<br /><br />

<b>11. Como efectuo o pagamento das minhas compras?</b><br />
R: Terá de ter o login efectuado, e após adicionar os produtos ao carrinho, abrir o último e clicar em "Finalizar Compra".
O pagamento terá de ser feito através de Paypal.<br /><br />

<b>12. Quanto tempo terei de esperar até receber as minhas compras?</b><br />
R: Assim que os produtos estiverem prontos, serão imediatamente entregues ao cliente. Para efeitos de entrega mais rápida, solicita-se que o cliente escolha a fábrica mais próxima da sua residência.
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
