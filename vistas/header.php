<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema Académico</title>
        <meta content="width=device-width, initial-scale =1, maximum-scale =1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
        <link rel="stylesheet" href="../public/css/font-awesome.css">
        <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
        <link rel="stylesheet" href="../public/css/_all-skins.min.css">
        <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
        <link rel="shortcut icon" href="../public/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
        <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
        <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
        <script src="../public/datatables/jquery.dataTables.min.js"></script>
        <script src="../public/datatables/dataTables.buttons.min.js"></script>
        <script src="../public/datatables/buttons.html5.min.js"></script>
        <script src="../public/datatables/jszip.min.js"></script>
        <script src="../public/datatables/pdfmake.min.js"></script>
        <script src="../public/datatables/vfs_fonts.js"></script>

        <!-- bootbox -->
        <script src="../public/js/bootbox.min.js"></script>

    
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
    <header class="main-header">
        <a href="index2.html" class="logo">
            <span class="logo-mini"><b>USB</b>Sistema</span>
            <span class="logo-lg"><b>Sistema Academico</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navegación</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Pablo</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="../public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    www.Ingenieria de Sistemas.com - Desarrollando Software
                                    <small>www.youtube.com/sistemas</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-success">Cerrar</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header"></li>
                <li>
                    <a href="#">
                        <i class="fa fa-tasks"></i> <span>Escritorio</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Estudiantes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="estudiante.php"><i class="fa fa-user-plus"></i>
                        Registro de Estudiantes</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user-secret"></i>
                        <span>Docentes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="docente.php"><i class="fa fa-user-plus"></i>
                        Registro de Docentes</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-university"></i>
                        <span>Académico</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="materia.php"><i class="fa fa-circle-o"></i> Materias</a></li>
                        <li><a href="grado.php"><i class="fa fa-circle-o"></i> Grados</a></li>
                        <li><a href="carrera.php"><i class="fa fa-circle-o"></i> Carreras</a></li>
                        <li><a href="turno.php"><i class="fa fa-circle-o"></i> Turnos</a></li>
                        <li><a href="aula.php"><i class="fa fa-circle-o"></i> Aulas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="curso.php">
                        <i class="fa fa-arrow-right"></i>
                        <span>Cursos</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="Inscripcion.php">
                        <i class="fa fa-arrow-right"></i>
                        <span>Inscripción</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>Notas</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Acceso</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                        <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart"></i> <span>Consulta Inscripcion</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="consultacompras.php"><i class="fa fa-circle-o"></i>
                        Consulta Inscripción</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart"></i> <span>Consulta Notas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>
                        Notas Estudiantes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="login.php">
                        <i class="fa fa-info-circle"></i> <span>Logout</span>
                        <small class="label pull-right bg-yellow">SALIR</small>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
</html>