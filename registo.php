<!-- templatemo 367 shoes -->
<!-- 
Shoes Template 
http://www.templatemo.com/preview/templatemo_367_shoes 
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FootTuristic | Registo</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<script type="text/javascript" src="js/forms.js">	</script>
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
<body>
<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1><a href="index.php">Fábrica de calçado</a></h1></div>
        <div id="header_right">
        	<p>
	        <a href="registo.php">Registar</a> | <a href="login.php">Login</a></p>
            <p>
            	Registe-se para criar uma conta ou faça Login para iniciar sessão.
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
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style>
<h1>Registo</h1>
<div align="center">
<?php
include "conn.php";
$con = mysql_connect($hostname_conn,$username_conn,$password_conn);
$bd  = mysql_select_db($database_conn);
?>

<fieldset class="fieldset-auto-width">
	<legend><b>Formulário de Registo</b></legend>
	<font face="Arial">
	<form align="left" name="registo" id="registo" method="post" action="submeter_registo.php">
	  Nome completo:<br />
	  <input type="text" size="45" id="registo_nome" onBlur="verificar_nome(registo_nome,erro_nome)" name="registo_nome" autofocus=True/><br />
	  <div id="erro_nome" hidden="true"><font face="Arial" size="1px" color="red">Nome inválido!</font></div>
	 
	  Morada:<br />
	  <input type="text" size="70" id="registo_morada" onKeyUp="verificar_morada(registo_morada,erro_morada)" id="registo_morada" name="registo_morada" /><br />
	  <div id="erro_morada" hidden="true"><font face="Arial" size="1px" color="red">Morada inválida!</font></div>
	  
	  Localidade:<br />
	  <input type="text" size="35"id="registo_localidade" onKeyUp="verificar_localidade(registo_localidade,erro_localidade)" name="registo_localidade" /><br />
	  <div id="erro_localidade" hidden="true"><font face="Arial" size="1px" color="red">Localidade inválida!</font></div>
	 
	  Telefone:<br />
	  <input type="text" maxlength="9" onKeyUp="verificar_telefone(registo_telefone,erro_telefone)" id="registo_telefone" name="registo_telefone" /><br />
	  <div id="erro_telefone" hidden="true"><font face="Arial" size="1px" color="red">Número telefone inválido!</font></div>
	  
	  NIF:<br />
	  <input type="text" maxlength="9" onKeyUp="verificar_nif(registo_nif,erro_nif)" id="registo_nif" name="registo_nif" /><br />
	  <div id="erro_nif" hidden="true"><font face="Arial" size="1px" color="red">NIF inválido!</font></div>
	  <br>
	  
	  Username:<br />
	  <input type="text" onKeyUp="verificar_username(registo_username,erro_username)" id="registo_username" name="registo_username" /><br />
	  <div id="erro_username" hidden="true"><font face="Arial" size="1px" color="red">Username inválido</font></div>
	  
	  Password:<br />
	  <input type="password" onBlur="verificar_password(registo_pass,erro_pass)" id="registo_pass" name="registo_pass" /><br />
	  <div id="erro_pass" hidden="true"><font face="Arial" size="1px" color="red">Password inválida! Tem de ter pelo menos 4 caracteres.</font></div>
	  
	  Confirmar password:<br />
	  <input type="password" value="" onKeyUp="verificar_confirmacao_password(registo_pass,registo_pass_conf,erro_confirmacao)" id="registo_pass_conf" name="registo_pass_conf" /><br />
	  <div id="erro_confirmacao" hidden="true"><font face="Arial" size="1px" color="red">Passwords diferentes!</font></div>
	  <br>
	   <input type="button" name="Limpar" id="limpar" value="Limpar dados" onclick="limpar_form()"/>
	  <input type="submit" name="Registar" id="submeter" value="Registar"  /></br>
	  <br /><div id="submeter2" align="right"><font face="Arial" size="1px" >Todos os campos são obrigatórios!</font></div>
	 </form>
</fieldset>
</div>
<div class="cleaner"></div>
</div> <!-- END of templatemo_main -->
<div id="templatemo_footer">
<p><a href="index.php">Home</a> | <a href="produtos.php">Produtos</a> | <a href="sobre.php">Sobre nós</a> | <a href="faq.php">FAQ</a> | <a href="contacto.php">Contactos</a>
</p>
Copyright © 2014 <a href="index.php">Foot-Tech Calçado</a> <!-- Credit: www.templatemo.com -->
</div> <!-- END of templatemo_footer -->

</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->
</body>
</html>