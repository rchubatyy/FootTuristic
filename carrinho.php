<?php
// Iniciamos nossa sessão que vai indicar o usuário pela session_id
session_start();
include "conn.php";
    $con = mysqli_connect($hostname_conn,$username_conn,$password_conn,$database_conn);
// Recuperamos os valores passados por parametros
if (isset($_GET['acao']))
$acao = $_GET['acao'];
    if (isset($_GET['id']))
$id =  $_GET['id'];

// Verificamos se a acao é igual a incluir
if ($acao == "incluir")
{    
    // Verificamos se cod do produto é diferente de vazio
    if ($id != '')
    {
        // Se for diferente de vazio verificamos se é numérico
        if (is_numeric($id))
        {    
            // Tratamos a variavel de caracteres indevidos
            $id = addslashes(htmlentities($id));
            // Verificamos se o produto referente ao $id já está no carrinho para o session id correnpondente
            $query_rs_carrinho = "SELECT * FROM carrinho WHERE carrinho.cod = '".$id."'  AND carrinho.sessao = '".session_id()."'";
            $rs_carrinho = mysqli_query($con,$query_rs_carrinho) or die(mysqli_error($con));
            $row_rs_carrinho = mysqli_fetch_array($rs_carrinho);
            $totalRows_rs_carrinho = mysqli_num_rows($rs_carrinho);

            // Se o total for igual a zero é sinal que o produto ainda não está no carrinho
            if ($totalRows_rs_carrinho == 0)
            {
                // Aqui pegamos os dados do produto a ser incluido no carrinho
                $query_rs_produto = "SELECT * FROM produtos WHERE id = '".$id."'";
                $rs_produto = mysqli_query($con,$query_rs_produto) or die(mysqli_error($con));
                $row_rs_produto = mysqli_fetch_array($rs_produto);
                $totalRows_rs_produto = mysqli_num_rows($rs_produto);

                // Se total for maior que zero esse produto existe e então podemos incluir no carrinho
                if ($totalRows_rs_produto > 0)
                {
                    var_dump($row_rs_produto);
                    $registro_produto = mysqli_fetch_array($rs_produto);
                    // Incluimos o produto selecionado no carrinho de compras
                    $add_sql = "INSERT INTO carrinho (id, cod, nome, preco, qtd, sessao, img) 
                   VALUES
                   ('".$id."','".$row_rs_produto['id']."','".$row_rs_produto['Nome']."','".$row_rs_produto['Preco']."','1','".session_id()."','".$row_rs_produto['Imagem']."')";
                    $rs_produto_add = mysqli_query($con,$add_sql) or die(mysqli_error($con));
                }
            }        
        }
    }
}    

// Verificamos se a acao é igual a excluir
if ($acao == "excluir")
{
    // Verificamos se cod do produto é diferente de vazio
    if ($id != '')
    {
        // Se for diferente de vazio verificamos se é numérico
        if (is_numeric($id))
        {    
            // Tratamos a variavel de caracteres indevidos
            $id = addslashes(htmlentities($id));
            // Verificamos se o produto referente ao $id  está no carrinho para o session id correnpondente
            $query_rs_car = "SELECT * FROM carrinho WHERE cod = '".$id."'  AND sessao = '".session_id()."'";
            $rs_car = mysqli_query($con,$query_rs_car) or die(mysqli_error());
            $row_rs_carrinho = mysqli_fetch_array($rs_car);
            $totalRows_rs_car = mysqli_num_rows($rs_car);

            // Se encontrarmos o registro, excluimos do carrinho
            if ($totalRows_rs_car > 0)
            {
                $sql_carrinho_excluir = "DELETE FROM carrinho WHERE cod = '".$id."' AND sessao = '".session_id()."'";    
                $exec_carrinho_excluir = mysqli_query($con,$sql_carrinho_excluir) or die(mysqli_error());
            }
        }
    }
}

// Verificamos se a ação é de modificar a quantidade do produto
if ($acao == "modifica")
{
    if(isset($_POST['qtd']))
    $quant = $_POST['qtd'];
        // Se for diferente de vazio verificamos se é numérico
        if (is_array($quant))
        {    
            // Aqui percorremos o nosso array
            foreach($quant as $id => $qtd)
            {
                // Verificamos se os valores são do tipo numeric
                if(is_numeric($id) && is_numeric($qtd))
                {
                    // Fazemos nosso update nas quantidades dos produtos
                    $sql_modifica = "UPDATE carrinho SET qtd='".$qtd."' WHERE  cod='".$id."' AND sessao = '".session_id()."' ";
                    $rs_modifica = mysqli_query($con,$sql_modifica) or die(mysqli_error());
                }
            }
        }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Foot Turistic | Carrinho de Compras</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/forms.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">
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
$resultado_carrinho = mysqli_query($conn,$carrinho) or die(mysqli_error());
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
<h2>Carrinho de compras</h2>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style>
<div id="content" class="float_r">
<form class="fieldset-auto-width" action="carrinho.php?acao=modifica" method="post">
<table width="680px" border="0" cellspacing="0" cellpadding="5">
  <tr bgcolor="#ddd">
    <th width="220" align="center">IMAGEM </th>
	<th width="180" align="center">PRODUTO</th>
    <th width="100" align="center">PREÇO</th>
    <th width="60" align="center">QUANTIDADE</th>
    <th width="60" align="center">SUBTOTAL</th>
    <th width="90"></th>
  </tr>

  <?php
  $sql_meu_carrinho = "SELECT * FROM carrinho WHERE  sessao = '".session_id()."' ORDER BY nome ASC";
  $exec_meu_carrinho =  mysqli_query($conn,$sql_meu_carrinho) or die(mysqli_error());
  $qtd_meu_carrinho = mysqli_num_rows($exec_meu_carrinho);
  
  if ($qtd_meu_carrinho > 0)
  {
      $soma_carrinho = 0;
      while ($row_rs_produto_carrinho = mysqli_fetch_array($exec_meu_carrinho))
    {
        $soma_carrinho += ($row_rs_produto_carrinho['preco']*$row_rs_produto_carrinho['qtd']);
  ?>
    <tr>
    <?php 
	echo "<td><div align='center'><img height='140' width='160' src=produtos/".$row_rs_produto_carrinho['img'].">";
	echo "<td><div align='center'>".$row_rs_produto_carrinho['nome']."";
    echo "<td><div align='center'>".number_format($row_rs_produto_carrinho['preco'],2,',','.')." € </div></td>";
	echo '<td><div align="center">';
	echo "<input type='text' size='2' ";
	echo 'name= "qtd['.$row_rs_produto_carrinho['cod'].']" '; 
	echo "value='".$row_rs_produto_carrinho['qtd']."' /></div></td>";
	echo "<td><div align='center'>".number_format($row_rs_produto_carrinho['preco']*$row_rs_produto_carrinho['qtd'],2,',','.')." €</div></td>";
	echo "<td><div align='center'><a href='carrinho.php?id=".$row_rs_produto_carrinho['cod']."&acao=excluir'><img src='images/remove_x.gif' /><br />Remover</a></div></td></tr>";
  }
}
 ?>
    <tr>
	  <td colspan="3" align="right"  height="30px">Alterou o seu carrinho? Clique aqui para  <input type="submit"  value="Actualizar" name="imageField" /></td>
      <td align="right" style="background:#ddd; font-weight:bold"><strong>TOTAL:</strong>        
      <td align="center" style="background:#ddd; font-weight:bold"><strong>
      <?php
          if(isset($soma_carrinho))
	  echo number_format($soma_carrinho,2,",",".");
          else echo '0,00';
	  echo " €";
	  ?>
	  </strong>
	  </td>
	  <td style="background:#ddd; font-weight:bold"> </td>
	</tr>
	</table>
	</form>
    <div style="float:right; width: 215px; margin-top: 20px;">  
	<form method="post" action="checkout.php">
	<?php
        if (isset($soma_carrinho))
	echo "<input type='hidden' name='total_pagar' value='".$soma_carrinho."'>" ?>
	<input type="submit" name="finalizar" value="Finalizar compra">
	<p><a href='javascript:history.back()'>Continuar a comprar</a></p>	
	</form>
    </div>
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
