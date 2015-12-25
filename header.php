<?php
include_once dirname(__FILE__) . "/querys/getTM.php"; // aqui ya se incluye la conexion local
include_once dirname(__FILE__) . "/querys/getMedicos.php";
include_once dirname(__FILE__) . "/querys/getEcos.php";
include_once dirname(__FILE__) . "/querys/getEventos.php";
include_once dirname(__FILE__) . "/querys/getCentrosGroup.php";
include_once dirname(__FILE__) . "/querys/getPrestaciones.php";
include_once dirname(__FILE__) . "/Include/isAdmin.php";

if ($_SESSION ["usuario"]) {
    if (isAdmin($_SESSION ["idusuario"]) == 1) {
        $admin = 1;
    } else {
        $admin = 0;
    }
} else {
    //print_r($_SESSION);
    //si no hay sesion se envi al login
    header('Location:logIn.php');
}
?>
<head>
    <!-- title and meta -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TMTECNOMED APP</title>

    <script src="Include/jquery-2.1.4.min.js"></script>
    <script src="Include/bootstrap.js"></script>
    <script src="Include/jquery-ui.js"></script>
    <script src='calendario/lib/moment.min.js'></script>
    <script src='calendario/lib/jquery-ui.custom.min.js'></script>
    <script src='calendario/fullcalendar.min.js'></script>
    <script src='calendario/lang/es.js'></script>
    <script src='chart-master/Chart.js'></script>

    <!-- favico-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">


    <!-- css -->

    <link href='css/jquery-ui.css' rel='stylesheet'>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <link href='calendario/fullcalendar.css' rel='stylesheet'/>
    <link href='calendario/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href='css/style.css' rel='stylesheet'>

</head>
<body background="images/bg.gif">
    <div class="loading-screen" style="position: fixed; z-index: 9999; background: #FFFFFF; opacity: .95; width: 100%; height: 100%; display:none;">
        <center><img src="images/small-load.gif" style="position: relative; top: 100px;"></center>
    </div>
    <div class='row' align="left">
        <img src="images/logo.gif" alt="logo" />
    </div>
    <nav class="navbar navbar-default ">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse"
                 id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php
                    // MENU HORARIOS
                    if ($admin == 1) {
                        echo '<li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" role="button">Agenda<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu"><!-- empresas -->
                    <!-- <li class="dropdown-submenu">
                        <a tabindex="-1" href="#">More options</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                            <li><a href="#" tabindex="-1">Second level link</a></li>
                        </ul>
                    </li> -->
                        ';
                        foreach (getCentrosGroup() as $empresa => $centros) {
                            echo '<li class="dropdown-submenu  disabled"><a href="#" tabindex="-1">' . $empresa . '</a><!-- $empresa  -->
                            <ul class="dropdown-menu"><!-- menu $empresa -->
                                    ';
                            foreach ($centros as $centro) {
                                foreach ($centro as $datosCentro) {
                                    //echo $datosCentro['Nombre'] . '<br>';
                                    echo '<li><a href="calendario.php?idCentro=' . $datosCentro['idCentro'] . '&centro=' . $datosCentro['Nombre'] . ' (' . $datosCentro['Siglas'] . ')" tabindex="-1">' . $datosCentro['Nombre'] . ' <b>(' . $datosCentro['Siglas'] . ')</b></a></li>
                                        ';
                                }
                            }
                            echo '</ul><!-- menu $empresa-->
                                  </li><!-- dropdown-submenu -->
                                  ';
                        }
                        echo '</ul><!-- empresas -->
                          </li><!-- menu horarios-->
                          ';
                        /* while ($row = mysql_fetch_array($result)) {
                          echo "<li><a href='calendario.php?idCentro=" . $row['idCentro'] . "'>" . $row['Nombre'] . "</a></li>\n";
                          }
                          echo "</ul>\n</li>\n <!-- Dropdown honorarios -->\n";
                         */
                    } // si es admin ve esto
                    //MENU EMPRESAS
                    if ($admin == 1) {
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Empresas<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="Empresas.php">Perfiles Empresas</a></li>
                                <li><a href="agregarEmpresaR.php">Nueva Empresa</a></li>
                                <li><a href="agregarCentroNuevoR.php">Nuevo Centro</a></li>
                                <li><a href="agregarEcoNuevaR.php">Nuevas Ecos</a></li>
                            </ul>
                        </li>

                    <?php } // si es admin ve esto     ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Tecn&oacute;logos M&eacute;dicos<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a id="perfiles" href="Perfiles.php">Perfiles Tecn&oacute;logos M&eacute;dicos</a></li>
                            <?php
                            if ($admin == 1) {
                                echo "<li><a href='agregarTmR.php'>Nuevo Tecn&oacute;logo M&eacute;dico</a></li>";
                            } // si es admin ve esto
                            ?>
                        </ul>
                    </li>

                    <?php if ($admin == 1) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                M&eacute;dicos<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a id="perfiles" href="agregarDoctor.php">Nuevo M&eacute;dico</a></li>
                                <li><a id="perfiles" href="informacionMedicos.php">Editar M&eacute;dicos</a></li>
                            </ul>
                        <?php } ?>
                </ul>
           
                <!-- aqui termina -->

                <ul class="nav navbar-nav navbar-right">
           		     <li><a href="books/libreria.php">Librer&iacute;a</a></li>
           		     <?php if($_SESSION['super']!=1){ 
               		     echo '<li><a href="editarClave.php">Editar Clave</a></li>';
           		         echo '<li><a href="bugReport.php" ><font color="red">¡Reportar Error!</font></a></li>';
                    }?>
                    <li><button onClick="window.location.href = 'logOff.php'" class="btn btn-danger navbar-btn"><strong class=""><?php echo $_SESSION['usuario']; ?></strong> (Cerrar sesión)</button></li>
                </ul>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>