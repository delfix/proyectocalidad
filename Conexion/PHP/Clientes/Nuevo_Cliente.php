<?php
	session_start();
	 
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	 //echo $_SESSION['id_user'];
	} else {
	   echo "Esta pagina es solo para usuarios registrados.<br>";
	   echo "<br><a href='Conexion/login.php'>Login</a>";
	 
	exit;
	}
?>
<!DOCTYPE HTML>
<html>
<head>

<title>INTERCEL Nuevo_Cliente</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Educator Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="applijegleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom Theme files -->
<link href="../../css/style.css" rel='stylesheet' type='text/css' />	
<link href="../../css/Formato.css" rel='stylesheet' type='text/css' />
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/dist/jquery.validate.js" type="text/javascript"></script>
<!--webfonts-->
 <link href='//fonts.googleapis.com/css?family=Poiret+One|Lily+Script+One|Raleway:400,300,500,600,200,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script type="text/javascript">
$(function(){
  var x;
  x=$("tr");
  x.mouseover(entraMouse);
  x.mouseout(saleMouse);
  //x.click();
});


function entraMouse()
{
    //#00CED1
  $(this).css("background-color","#D3D3D3");
}

function saleMouse()
{
  $(this).css("background-color","#fff");
}
</script>
</head>
<body>
<!--start-home-->
	<div class="head" id="home">
	    <div class="header-top">
		<div class="container">  
            <p class="col-md-6 location">
                <i class="glyphicon glyphicon-map-marker">
                </i>INTERCEL
            </p>
            <div class="clearfix"> </div>
        </div>
        </div>
        <div class="container">  
        <div class="main">	
		<div class="wht-head">	
        <div class="logo">
			<a href="index.html" >
                <h1><i class="glyphicon glyphicon-education"></i>INTERCEL</h1>
            </a>
        </div>
        <!--top-nav-->
            <span class="menu"> </span>
            <div class="top-menu">
                <nav>
                    <ul class="cl-effect-16">
                        <li><a class="active scroll" href="../../admin.php" data-hover="Inicio">Inicio</a></li>
                        
                         <li><a class="scroll" href="Cliente.php" data-hover="Cliente">Cliente</a></li>
                        <div class="clearfix"></div>
                    </ul>
				</nav>            
            </div>
			<!-- script-for-menu -->
            <script>
                $( "span.menu" ).click(function() {
				$( ".top-menu" ).slideToggle( "slow", function() {
				});
                });
            </script>
            <!-- script-for-menu -->
            <div class="clearfix"></div>
            </div>
            <div class="banner_2">
            <div class="banner-slider">
            <div  id="top" class="callbacks_container">
            <div class="cuerpo">
            <!-- segundo menu -->
            <div class="top-menu">
                <nav>
                    <ul class="cl-effect-16">
                                               
                    </ul>
                </nav>
         </div>
         <?php
                require_once "../../Conexion/Sentencias_sql.php"; 
                $datos = new Sentencias_sql(); 
                $datos->conexion();
                $datos->abrir_bd();
        ?>               
        <?php 
                try {
                    if (isset($_POST['Guardar'])) {
                        $municipio = $_POST['municipio'];
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
						$nit = $_POST['nit'];
						$direccion = $_POST['direccion'];
						$correo = $_POST['correo'];
						$telefono = $_POST['telefono'];
                        require_once "../../Conexion/Sentencias_sql.php"; 
                        $datos = new Sentencias_sql(); 
                        $datos->conexion();
                        $datos->abrir_bd();
                        $datos->sql("insert into cliente (c_municipio,c_nombre, c_apellido, c_nit, c_direccion, c_correo, c_telefono) Values "
                                            . "('$municipio','$nombre','$apellido','$nit','$direccion','$correo','$telefono')" ,"Ingreso Exitoso");
                        echo "<script type='text/javascript'>
                        alert('Ingreso exitoso');
                        </script>";
						$fecha = date("Y-m-d");
$hora  = date("H:i:s"); 
$motivo ="Insert en cliente ";
                                   
$sql="insert into auditoria "
. "(ad_usuario,ad_fecha,ad_hora,ad_motivo)"
. "Values"
. "('".$_SESSION['id_user']."',"
. "'".$fecha."',"
. "'".$hora."',"
. "'".$motivo
. "')";
$datos->sql($sql,"Ingreso Exitoso");
                        //$datos->cerrar_bd();
                    }else{
                ?>
         <form method="post"  style="float:center;" id="form"> 
                    <br>
					<script type="text/javascript">
$(document).ready(function() {
    $("#ok").hide();
    $("#form").validate({
        rules: {
            nombre: { required: true},//campos vacios
            apellido: { required: true},
            nit: { required:true, minlength: 6, maxlength: 13},//no vacios y con un minimo y maximo
            direccion: { required: true},
          correo: { required: true},
            telefono: { required: true,minlength: 8, maxlength: 8}
           
           
        },
        messages: {
            nombre: "Debe introducir un nombre valido.",
            apellido: "Debe introducir un apellido valido.",
            nit: "Debe introducir datos validos ",
            direccion: "Debe introducir datos validos ",
			correo: "Debe introducir email valido",
            telefono: "introduzca numero telefonico correcto"
       
            
        },
        submitHandler: function(form){
            form.submit();
        }
    });
});
</script>
                    <?php
                        require_once "../../Conexion/Sentencias_sql.php"; 
                        $datos = new Sentencias_sql(); 
                        $datos->conexion();
                        $datos->abrir_bd();
                        $resultado = $datos->query("select m_id, m_nombre from municipio"); 
                    ?> 
                    <h4><p> Municipio:</p></h4>
                    <select name="municipio">
                        <?php if ($resultado)
                        while($row = mysqli_fetch_array($resultado))
                        { 
                            $nombre = $row['m_nombre'];
                            $id = $row['m_id']; 
                            echo "<option value=".$id.">".$nombre."</option>";
                        }
                        $datos->cerrar_bd();
                        ?>
                    </select>
                    <br><h4><p> Nombre:</p></h4>
                    <input type="text" name="nombre" id ="nombre">
					<br><h4><p> Apellido:</p></h4>
                    <input type="text" name="apellido" id ="apellido">
					<br><h4><p> Nit:</p></h4>
                    <input type="text" name="nit" id ="nit" >
					<br><h4><p> Direccion:</p></h4>
                    <input type="text" name="direccion" id ="direccion">
					
					<br><h4><p> Correo:</p></h4>
                    <input type="email" name="correo" id ="correo" required="required">
                    <br><h4><p>Telefono:</p></h4>
                    <input type="text" name="telefono" id ="telefono">
                    <br>
                    <input type="Submit" name="Guardar" value="Guardar" id ="Guardar">
                </form>
                <?php
                    }
                } catch (Exception $e){
                    echo "<script type='text/javascript'>
                    alert('ocurrio un error' + $e);
                    </script>";
                }
                ?>
                <br>
                </div>
                </div>
                </div>
            </div>
            <!--banner-slide-->
            <script src="js/responsiveslides.min.js"></script>
            <script>
                // You can also use "$(window).load(function() {"
                $(function () {// Slideshow 4
                    $("#slider3").responsiveSlides({
                        auto: true,
				        pager:true,
				        nav:false,
				        speed: 500,
				        namespace: "callbacks",
				        before: function () {
				          $('.events').append("<li>before event fired.</li>");
				        },
				        after: function () {
				          $('.events').append("<li>after event fired.</li>");
                        }
                    });				
                });
            </script>
            <!--//banner-slide-->
            <!--end-banner-->
            <!--footer-->
            <div class="copy">
                <p>&copy; 2017 INTERCEL. Todos los derechos reservados </p>
            </div>
        </div>
        <link rel="stylesheet" href="css/swipebox.css">
        <script src="js/jquery.swipebox.min.js"></script> 
	    <script type="text/javascript">
            jQuery(function($) {
                $(".swipebox").swipebox();
			});
        </script>
	<!--//gallery-->
        </div>
    </div>	
    <!--start-smoth-scrolling-->
	<script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){		
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
	</script>
	<!--start-smoth-scrolling-->
    <script type="text/javascript">
        $(document).ready(function() {
            var defaults = {
                containerID: 'toTop', // fading element id
                //containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
    <a href="#home" id="toTop" class="scroll" style="display: block;"> 
        <span id="toTopHover" style="opacity: 1;"> 
        </span>
    </a>
    </body>
</html>