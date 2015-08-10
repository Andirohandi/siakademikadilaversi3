<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Siakad - SMP NEGERI 19 BANDUNG</title>

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

        <?= $this->load->view('nav'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                     <div class="col-lg-12">
                    <h1 class="page-header">Upload Data Calon Siswa</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!-- Button trigger modal -->
                                            <button class="btn btn-primary " data-toggle="modal" data-target="#datasiswa">
                                                Create Tahun Ajaran
                                            </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="datasiswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="Form-add-level" id="myModalLabel">Penerimaan Siswa Baru</h4>
                                                </div>
                                                <div class="modal-body">
                                                <?php echo validation_errors(); ?>

                                                <?php echo form_open('tahun_ajaran/insert'); ?>
                                                
                                                
                                                <div class="form-group">
                                                <label>Tahun Masuk</label>
                                                <input type="text" name="tahun" class="form-control" placeholder="Tahun Masuk" value="" maxlength="4" id="tahun" onchange="cek_tahun()">
                                                </div>
                                                
                                                <div class="form-group">
                                                <label>Jumlah Kelas</label>
                                                <input type="text" name="kelas" class="form-control" placeholder="Jumlah Kelas" value="" maxlength="2">
                                                </div>

                                                <div class="form-group">
                                                <label>Kuota</label>
                                                <input type="text" name="kuota" class="form-control" placeholder="Kuota" value="" maxlength="4">
                                                </div>
                                                
                                                
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" value="Save" class="btn btn-primary" id="tom_save" disabled>
                                                <input type="hidden" name="id_pendaftaran" class="form-control" value="" >
                                                <?php echo form_close(); ?>
                                                </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        </div> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tahun</th>
                                            <th>Kelas</th>
                                            <th>Kuota</th>
                                             <th>Status</th>
                                            <th>Options</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                    <?php
                                    	$no = 0;				
                                        foreach ($tahun_ajaran->result() as $rows):$no++;
                                         ?>
											<tr>
												<td width='10%'><?= $no ?></td>
												<td width='20%'><?= $rows->tahun?></td>
												<td width='10%'><?= $rows->kelas?></td>
												<td width='20%'><?= $rows->kuota?></td>
												<td width='10%'><?= $rows->status?></td>
												<td width='30%'>
													 <a href="upload?xYx=<?= base64_encode($rows->tahun)?>">
													<button class="btn btn-primary" >
														Upload
													</button></a>
													<a href="calon_siswa/detail_calon?thn=<?= $rows->tahun?>">
														<button class="btn btn-primary" >
															Detail
														</button>
													</a> 
													<a href="tahun_ajaran/close/<?= $rows->id_tahun_ajaran?>">
														<button class="btn btn-primary" >
															Close
														</button></a>
													<a href="tahun_ajaran/delete/<?= $rows->id_tahun_ajaran?>">
													<button class="btn btn-primary" >
														Delete
													</button></a>
												</td>
				
											</tr>
                                    <?php endforeach; ?>
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
	
	
	function cek_tahun()
	{
		var tahun = $('#tahun').val();
		
		$.ajax({
			url : 'tahun_ajaran/cek_tahun',
			dataType : 'json',
			type : 'POST',
			data : {tahun:tahun},
			beforeSend : function()
			{
			
			},
			success : function(result)
			{
				if(result.rs==0)
				{
					$('#tom_save').prop('disabled',false);
				}else{
					$('#tom_save').prop('disabled',true);
					alert('Maaf ! Tahun yang anda inputkan sudah ada');
				}
			}	
		});
	}
    </script>

</body>

</html>
