<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PSB SMP NEGERI 19 BANDUNG</title>
    <link rel="icon" href="<?=base_url()?>/assets/img/logo.png" type="image/png">
    
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
     <!-- DataTables CSS -->
    <link href="<?=base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?=base_url();?>assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Date Picker -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-ui.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        #container, #sliders {
            min-width: 310px; 
            max-width: 800px;
            margin: 0 auto;
        }
        #container {
            height: 400px; 
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="<?=base_url();?>">SELAMAT DATANG DI HALAMAN SISWA WEBSITE SMP NEGERI 19 BANDUNG</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                       
                                    
                        <li><a href="<?=base_url();?>index.php/login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form text-center" align="center">
                               <img  alt="Brand" width="80%" height="80%" src="<?=base_url();?>assets/img/logo.png"> 
                            </div>
                            <!-- /input-group -->
                        </li>
                       
                        <?= $this->load->view('menu_groups'); ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <div class="col-lg-12">
                    <h1 class="page-header">Data Personal</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-default">
                        <!-- panel-heading -->
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Form Update
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php                                                        
                                foreach ($datapersonal->result() as $rows) {
                            ?>
                                

                                <?php echo form_open('home/Update'); ?>
                                            
                                            <div class="form-group">
                                            
                                            <img  alt="Foto" width="150" height="200" src="<?=base_url();?>uploads/F<?= $rows->nisn?>.jpg">
                                            </div>

                                            <div class="form-group">
                                            <label>NISN</label>
                                            <input type="hidden" name="id_pendaftaran" class="form-control"  value="<?= $rows->id_pendaftaran?>">
                                            <input type="text" readonly name="nisn" class="form-control" placeholder="NISN" value="<?= $rows->nisn?>">
                                            </div>

                                            <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Nama" value="<?= $rows->name?>">
                                            </div>

                                            <div class="form-group">
                                            <label>Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" class="form-control" placeholder="Asal Sekolah" value="<?= $rows->asal_sekolah?>">
                                            </div>

                                            <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?= $rows->tempat_lahir?>">
                                            </div>    

                                            <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="text" name="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?= $rows->tanggal_lahir?>">
                                            </div>   

                                            <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?= $rows->alamat?>">
                                            </div>

                                            <div class="form-group">
                                            <label>nun</label>
                                            <input type="text" name="nun" class="form-control" placeholder="nun" value="<?= $rows->nun?>">
                                            </div>

                                            <div class="form-group">
                                            <label>No Ijazah</label>
                                            <input type="text" name="no_ijazah" class="form-control" placeholder="no_ijazah" value="<?= $rows->no_ijazah?>">
                                            </div>

                                            <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="password" class="form-control" placeholder="Password" value="<?= $rows->password?>">
                                            </div>
                                            
                                            <div class="form-group">
                                            <input type="submit" value="Save" class="btn btn-primary">
                                            
                                            <a href="<?=base_url();?>index.php/upload"><input type="button" value="Upload Foto" class="btn btn-success"></a>
                                            </div>
                                <?php echo form_close(); ?>
                                <?php } ?>  
                        </div>                        
            </div>
            
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url();?>assets/dist/js/sb-admin-2.js"></script>
	
	 <!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script src="<?=base_url();?>assets/js/highcharts.js"></script>
    <script src="<?=base_url();?>assets/js/highcharts-3d.js"></script>
    <script src="<?=base_url();?>assets/js/exporting.js"></script>

    <!-- Datepicker -->
    
    <script src="<?=base_url();?>assets/js/jquery-ui.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

    $(function() {
            $( "#tanggal_lahir" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd"


            });
        });
    </script>

</body>

</html>
