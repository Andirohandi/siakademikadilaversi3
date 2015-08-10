<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMP Negeri 19 Bandung</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?=base_url()?>asset/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=base_url()?>asset/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?=base_url()?>asset/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>asset/css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">PSB SMP Negeri 19 Bandung</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Tatacara Pendaftaran</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Jadwal</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#psb">Pendaftaran Online</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?=base_url()?>index.php/login">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h2>Selamat datang di Website SMPN 19 Bandung</h2>
                <hr>
                <h2>FOCUS</h2>
                <h2>Fashioner, Optimist, Creator, Unimpeachibilty, Statisfaction</h2>
                
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Bagaimana Cara Kamu Mendaftar?</h2>
                    <hr class="light">
                    <p class="text-faded">Pilih Form pendaftaran online --> Isi Form Pendaftaran --> Save -->Lengkapi Pesyaratan di SMPN 19 Bandung</p>
					
                    <a href="#psb" class="btn btn-default btn-xl">Daftar</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>Administrasi</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Seleksi</h3>
                        <p class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Pengumuman Kelulusan</h3>
                        <p align="justify" class="text-muted"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Registrasi Ulang</h3>
                        <p align="justify" class="text-muted"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
 <section id="psb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                 <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-xl" data-toggle="modal" data-target="#myModal">
                                Form Pendaftaran Online
                            </button>
                </div>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="Form-add-bank" id="myModalLabel">Form Pendaftaran Online</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo validation_errors(); ?>

                                            <?php echo form_open('welcome/daftar'); ?>
                                            
                                            <div class="form-group">
                                            <label>NISN</label>
                                            <input type="text" name="nisn" class="form-control" placeholder="NISN">
                                            </div>

                                            <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama">
                                            </div>

                                            <div class="form-group">
                                            <label>Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" class="form-control" placeholder="Asal Sekolah">
                                            </div>

                                            <div class="form-group">
                                            <label>NUN</label>
                                            <input type="text" name="NUN" class="form-control" placeholder="NUN">
                                            </div>

                                            <div class="form-group">
                                            <label>No. Ijazah</label>
                                            <input type="text" name="no_ijazah" class="form-control" placeholder="No. Ijazah">
                                            </div>





                                            <div class="form-group">
                                            <label>jenis_kelamin</label>
                                            <select class="form-control" name="jenis_kelamin">
                                            <option value="Pria">Laki-Laki</option>
                                            <option value="Wanita" >Perempuan</option>                                            
                                            </select> 
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" value="Save" class="btn btn-primary">
                                        
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
    </section>


    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <hr class="primary">
                    <p>Silahkan hubungi kami untuk keterangan lebih lanjut tentang pendaftaran siswa baru SMP Negeri 19 Bandung</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>(022)500657</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">SMPN19Bandung.sch.id</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="<?=base_url()?>asset/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>asset/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=base_url()?>asset/js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>asset/js/jquery.fittext.js"></script>
    <script src="<?=base_url()?>asset/js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>asset/js/creative.js"></script>

</body>

</html>
