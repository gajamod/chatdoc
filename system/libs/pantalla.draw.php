<?php 
require('basics.draw.php');
if (!function_exists("configFile")) {
	if (file_exists("../config.php")) {
		require("../config.php");
	}else{
		require("config.php");
	}
	
}
define("opc_bienvenido",0,false);
define("opc_reservaciones",1,false);
define("opc_eventos",2,false);
define("opc_boletos",3,false);
define("opc_impresion",4,false);
define("opc_maletas",5,false);
define("opc_cerrar",6,false);
define("opc_login",7,false);
define("opc_turnos",8,false);
//define("opc_bienvanido",7,false);
/**
 * 
 */
class Pantalla extends BasicDraw
{
	function head(){
		?>
		<title><?php echo $this->title; ?></title>
		<!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.3.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="<?php echo BASE_URL ?>js/basicos.js"></script>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<script src="https://use.fontawesome.com/a8eef6966f.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/footer.css">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/miestilo.css">
		<script src="<?php echo BASE_URL ?>js/bootstrap.min.js" ></script>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/loading.css"/>
		<!---https://loading.io/animation/-->
		<base href="<?php echo BASE_URL ?>">
		<?php 
	}

	function header(){
		?>
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="<?php echo BASE_URL."home"; ?>"><img src="http://mviqueretaro.org/wp-content/uploads/2017/03/LogoMVIq_Azul.png" alt="SV Soporte y Ventas"class="normal-logo" height="71" style="padding: 2px 0; max-height: 71px;"></a>
					</div>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="http://www.soporteyventas.com"><img src="http://www.soporteyventas.com/img/logo.png" alt="MVI Querétaro" class="normal-logo" height="71" style="padding: 5px ; max-height: 71px;"></a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<?php 
	}


	function left_menu(){
		$Bienvenido= BASE_URL."home";
		$Reservaciones= BASE_URL."reservaciones";
		$Venta= BASE_URL."eventos";
		$Boletos= BASE_URL."Boletos";
		$Impresion= BASE_URL."impresion";
		$Maletas= BASE_URL."maletas";
		$Turnos= BASE_URL."turnos";
		$Cerrar= BASE_URL."login/logout";

		$Bien='';
		$Rese='';
		$Vent='';
		$Bole='';
		$Impr='';
		$Male='';
		$Turn='';
		switch ($this->opcion) {
			case opc_bienvenido:
				$Bienvenido="home#";
				$Bien='class="active"';
				break;
			case opc_reservaciones:
				$Reservaciones="reservaciones#";
				$Rese='class="active"';
				break;
			case opc_eventos:
				$Venta="eventos#";
				$Vent='class="active"';
				break;
			case opc_boletos:
				$Boletos="boletos#";
				$Bole='class="active"';
				break;
			case opc_impresion:
				$Impresion="impresion#";
				$Impr='class="active"';
				break;
			case opc_maletas:
				$Maletas="maletas#";
				$Male='class="active"';
				break;
			case opc_turnos:
				$Turnos="turnos#";
				$Turn='class="active"';
				break;
			case opc_cerrar:
				$Bienvenido="#";
				break;
			default:
				# code...
				break;
		}

		?>
		<ul class="nav nav-pills nav-stacked">
			<li role="presentation" <?php echo $Bien; ?> ><a href="<?php echo $Bienvenido ?>" >Bienvenido</a></li>
			
			<li role="presentation" <?php echo $Vent; ?> ><a href="<?php echo $Venta ?>">Venta Boletos</a></li>
			<li role="presentation" <?php echo $Rese; ?> ><a href="<?php echo $Reservaciones ?>">Reservaciones</a></li>
			<li role="presentation" <?php echo $Bole; ?> ><a href="<?php echo $Boletos ?>">Boletos</a></li>
			<li role="presentation" <?php echo $Impr; ?> ><a href="<?php echo $Impresion ?>">Impresion</a></li>
			<li class="divider"></li>
			<li role="presentation" <?php echo $Male; ?>><a href="<?php echo $Maletas ?>">Maletas</a></li>
			<li role="presentation" <?php echo $Turn; ?> ><a href="<?php echo $Turnos ?>">Turnos</a></li>
			<li role="presentation"><a href="<?php echo $Cerrar ?>">Cerrar Sesion</a></li>
		</ul>

		<div class="panel hidden-xs">
			<div class="panel-heading">
				<h3>Codigo de Color</h3>
			</div>
			<div class="panel-body">
				<div class="panel panel-success">
					<div class="panel-heading">
					<h5>Boleto Liberado</h5>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					<h5>Pago Completo</h5>
					</div>
				</div>
				<div class="panel panel-deudor">
					<div class="panel-heading">
					<h5>En Deuda</h5>
					</div>
				</div>
				<div class="panel panel-warning">
					<div class="panel-heading">
					<h5>Pago Incompleto</h5>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
					<h5>Para Revision</h5>
					</div>
				</div>
				<div class="panel panel-danger">
					<div class="panel-heading">
					<h5>Pago Pendiente</h5>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					<h5>Cancelado</h5>
					</div>
				</div>
			</div>
		</div>
			
		<?php 
	}

	function footer(){
		?>
		<footer class="page-footer">
		    <div class="footer" id="footer">
		        <div class="container">
		            <div class="row">
		                <div class="col-lg-2  col-md-3 col-sm-6 col-xs-12">
		                    <h3>MVI Datos de contacto</h3>
		                    <ul>
		                        <li> <p>Telefonos: </p></li>
		                        <li> <a href="tel:014422121125"><span itemprop="telephone">01 (442) 212 1125</span></a> </li>
		                        <li> <p>Correo: </p></li>
		                        <li> <a><span itemprop="email">oficinamviqueretaro@gmail.com</span></a> </li>
		                    </ul>
		                </div>
		                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
		                    <h3> Ministerios Vision Internacional </h3>
		                    <ul class="social">
		                        <li> <a href="https://www.facebook.com/MVIQUERETARO" target="_blank"> <i class=" fa fa-facebook">   </i> </a> </li>
		                        <li> <a href="https://twitter.com/MVIQUERETARO" target="_blank"> <i class="fa fa-twitter">   </i> </a> </li>
		                        <li> <a href="https://www.instagram.com/mviqueretaro/" target="_blank"> <i class="fa fa-instagram">   </i> </a> </li>
		                        <li> <a href="https://www.youtube.com/user/mviqueretaro" target="_blank"> <i class="fa fa-youtube">   </i> </a> </li>
		                        <li> <a href="http://mviqueretaro.org/" target="_blank"> <i class="fa fa-globe">   </i> </a> </li>
		                    </ul>
		                </div>
		                
		                <div class="col-lg-2  col-md-3 col-sm-6 col-xs-12">
		                    <h3>SV Datos de contacto</h3>
		                    <ul>
		                        <li> <p>Telefonos: </p></li>
		                        <li> <a href="tel:4426298541"><span itemprop="telephone">(442) 629 8541</span></a> </li>
		                        <li> <p>Correo: </p></li>
		                        <li> <a><span itemprop="email">contacto@soporteyventas.com</span></a></li>
		                        
		                    </ul>
		                </div>
		                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
		                    <h3> SV Soporte y ventas </h3>
		                    <ul class="social">
		                        <li> <a href="https://www.facebook.com/2408SV" target="_blank"> <i class=" fa fa-facebook">   </i> </a> </li>
		                        <!--<li> <a href="#"> <i class="fa fa-google-plus" target="_blank">   </i> </a> </li>-->
		                        <li> <a href="http://soporteyventas.com" target="_blank"> <i class="fa fa-globe" target="_blank">   </i> </a> </li>
		                    </ul>
		                </div>
		                
		            </div>
		            <!--/.row--> 
		        </div>
		        <!--/.container--> 
		    </div>
		    <!--/.footer-->
		    <div class="footer-bottom">
		        <div class="container">
		            <p class="pull-left"> Copyright © SV Soporte y ventas. </p> 
		        </div>
		    </div>
		    <!--/.footer-bottom--> 
		</footer>
		<?php 
	}
}
 ?>