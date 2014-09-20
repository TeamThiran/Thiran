<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thiran</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo asset_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo asset_url();?>css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo asset_url();?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Thiran -strength & grace</a>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div style="padding-top: 119px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>Please fill in your details.</h3>
			<p>We'll be using this to complete basic information to join Thiran!</p>
			<br>
                        <div class="alert alert-danger fade in" style="display:none;" id="error_signup">
                            <button style="margin-top:0px" type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>Please fill the fields completely.</strong> College, Mobile and Year passout should be valid.
                                
			</div>
			<?php echo form_open('social/signup',array('class'=>'form-horizontal','role'=>'form')); ?>
                        <div class="form-group">
				<label for="name" class="col-lg-2 control-label">Name</label>
				<div class="col-lg-10">
                                    <input disabled="disabled" class="form-control" id="fname" name="fname" value="<?php echo $this->session->userdata('name'); ?>">
				</div>
			</div>
                         
			<div class="form-group">
				<label for="college" class="col-lg-2 control-label">College</label>
				<div class="col-lg-10">
					 <select id="college" name="college_id" class="form-control">
                                            <option value="ACCET">ACCET</option>
                                            <option value="TC">TC</option>
                                        </select>
				</div>
			</div>
                        <div class="form-group">
				<label for="email" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10">
                                    <input disabled="disabled" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('email'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="mobile" class="col-lg-2 control-label">Mobile</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="mobile" name="phone_no" placeholder="Your mobile number">
				</div>
			</div>
                        <div class="form-group">
				<label for="ypassout" class="col-lg-2 control-label">Year of passout</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="ypassout" name="ypassout" placeholder="Year Passout">
				</div>
			</div>
			 <div class="form-group">
				<label for="utype" class="col-lg-2 control-label">User_Type</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="utype" name="utype" placeholder="User type">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" id="signup_submit" class="btn btn-lg btn-info">Start <i class="glyphicon glyphicon-chevron-right"></i></button>
				</div>
			</div>
			<?php echo form_hidden('signup','true'); ?>
			<?php echo form_close(); ?>			
		</div>
	</div>
</div>
        </div>
    </header>

   
   <script>
$(document).ready(function() {

	$('#signup_submit').click(function(e){
		if($('#college').val().length <3 || $('#mobile').val().length < 9 || $('#email').val().length < 4){
			
			$('#error_signup').show();
			e.preventDefault();
				return false;
		}
	});
});
</script>

   
</body>

</html>