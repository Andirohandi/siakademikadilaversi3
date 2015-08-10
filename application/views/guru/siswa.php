<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMP NEGERI 19 BANDUNG</title>

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="<?=base_url();?>">PSB SMP NEGERI 19 BANDUNG</a>
            </div>
            <!-- /.navbar-header -->
			<ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <?php echo $nm_guru; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=base_url();?>index.php/guru/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
						
                               <img  style="border-radius:50px;border:1px solid grey" width="50%" height="50%" src="<?=base_url();?>assets/img/guru/<?= $photo ?>"> 
                            </div>
                            <!-- /input-group -->
                        </li>
                       <li class="sidebar-search">
						<center><h4><?php echo $nm_guru; ?></h4></center>
					   </li>
                          <?= $this->load->view('guru/menu_groups'); ?>
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
                    <h1 class="page-header">List Siswa</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Latihan</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                            <th>Total</th>
                                            <th>Input Nilai</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                    <?php
                                    					$i = 1 ;
														$no = 1;
                                                        foreach ($listsiswa->result() as $rows) {
                                                    	?>
                                    										<tr>
											 <td><?= $no?></td>
												<td><?= $rows->nis_s?></td>
												<td><?= $rows->name?></td>
												<td><?= $rows->latihan?></td>
												<td><?= $rows->uts?></td>
												<td><?= $rows->uas?></td>
												<td><?= ($rows->uas + $rows->uts + $rows->latihan) / 3 ?></td>
				
												
												<td>
												<button class="btn btn-primary " data-toggle="modal" data-target="#myModal<?=$i?>">
													Nilai
													</button>
													<!-- Modal -->
													<div class="modal fade" id="myModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog">
													<div class="modal-content">
													<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="Form-add-Nilai" id="myModalLabel">Nilai Ulangan</h4>
													</div>
													<div class="modal-body">
													<?php echo validation_errors(); ?>

													<?php echo form_open('guru/updatedataulangan'); ?>
			
													<div class="form-group">
													
													<input type="hidden"  name="nis" value="<?= $rows->nis_s?>">
													
													<label>Nilai Latihan</label>
													<hr>
													<input type="hidden"  name="id_mapel"  value="<?= $id_mapel?>" hidden>
													<input type="hidden"  name="id_mengajar" class="form-control" placeholder="Nilai Tes" value="<?= $rows->id_mengajar?>" hidden>
													<input type="text"  name="n_latihan" class="form-control" placeholder="Nilai Ulangan" value="<?= $rows->latihan?>">
													</div>
													<hr>
													<div class="form-group">
													<label>Nilai UTS</label>
													<hr>
													<input type="text"  name="n_uts" class="form-control" placeholder="Nilai Ulangan" value="<?= $rows->uts?>">
													</div>
													<hr>
													<div class="form-group">
													<label>Nilai UAS</label>
													<hr>
													<input type="text"  name="n_uas" class="form-control" placeholder="Nilai Ulangan" value="<?= $rows->uas?>">
													</div>
													
													 <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<input type="submit" value="Save" class="btn btn-primary">
													
													</div>
													<?php echo form_close(); ?>
														
													</div>
		
													<!-- /.modal-content -->
													</div>
													</div>
													</div>
																											
												</td>
				
											</tr>
                                    <?php $i = $i + 1 ; } ?>
									</tbody>   
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
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
    <script src="<?=base_url();?>assets/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
