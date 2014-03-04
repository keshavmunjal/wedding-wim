<!DOCTYPE html>
<html>
<!-- This code is only meant for previewing your Reflow design. -->

<head>
  <?php echo $this->Html->css('Page'); echo $this->Html->css('boilerplate'); echo $this->Html->css('animate'); //echo $this->Html->script('jquery-1.8.3.min'); ?>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
  <script src="http://use.typekit.net/lud5awy.js"></script>
  <script>
      try {
          Typekit.load();
      } catch (e) {}
  </script>
  <script>
    var base_url = '<?php echo base_url;?>';

    function testAnim(x,that) {
        that.removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd oAnimationEnd animationEnd', function () {
            $(this).removeClass();
        });
    };

    function show_form() {
        $("#beta_invite").hide();
        $('#form').show();
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
  $(document).ready(function () {	
	$('#form').validate({
        rules: {
            name: {
                minlength: 3,
                maxlength: 15,
                required: true
            },
            email: {
                minlength: 3,
                email: true,
                required: true
            },
						password: {
											minlength: 4,
											required: true
									},
						url:{
							required: true,
							remote: {
													url: base_url+'users/checkurl',
													type: 'GET',
													data:
								{
									url: function()
									{
										return $('#url').val();
									}
								}
											}
						},
							},
					messages: {
						name: {
							required:"Please Enter Your Name"
						},
						email: {
							required:"Please Provide Your Email"
						},
						password: {
							minlength:"Please Provide Secure Password",
							required:"Please Provide Password"
						},
						url:{
							required:"Choose a unique url for your site",
							remote: "This Url is already taken.",
						},
						
					},
							highlight: function(element) {
									$(element).closest('.form-group').addClass('has-error');
							},
							unhighlight: function(element) {
									$(element).closest('.form-group').removeClass('has-error');
							},
							errorElement: 'span',
							errorClass: 'help-block',
							errorPlacement: function(error, element) {
									if(element.parent('.input-group').length) {
											error.insertAfter(element.parent());
									} else {
											error.insertAfter(element);
									}
							},
					submitHandler: function(form) {
						//calling function for submitting data
						saveUser();
					}
					});
	
	$("#register-btn").on('click',function(){
		var action = $('#action').val();
		if(action==0){
			if($('.form-section').css('display')=='none')
			  {
				$('.main-middle').animate({margin:'0px'},function(){
					$("#headding-line").slideToggle(function(){$(".form-section").slideToggle('slow');});
					});
				$('#action').val('1');
			  }
			  else
			  {
			    $(".form-section").slideToggle('slow',function(){
					$('.main-middle').animate({margin:'80px 0px 0px'},function(){
						$("#headding-line").slideToggle();
					});
					});
			  }
		}else{
			$('#form').submit();
		}
			  
				
			});
		//setting height of inner content
		function setHeight(){
			var height = window.innerHeight;
			console.log("height:"+height);
			$('#innerContent').css(
			{'height':height-105+'px'});
		}
		setHeight();
		
		//end of setting height
		
		$(window).on('resize',function(){ setHeight(); });
		$('#email').keyup(function () {
      var email = $('#email').val();

      if (IsEmail(email)) {
          //alert('right');
          $('#email').removeClass('wrong');
          $('#email').addClass('right');
      } else {
          //alert('wrong');
          $('#email').removeClass('right');
          $('#email').addClass('wrong');

      }
    });
    $('#login').click(function () {
			var email = $('#loginEmail').val();
			var password = $('#loginPassword').val();
			var data = "loginEmail="+email+"&loginPassword="+password;
			$.ajax({
        url: '<?php echo base_url;?>users/login_new',
        type: 'POST',
        data: data,
        success: function (res) {
				console.log(res);
          if(res=='new_user'){
						window.location.href = '<?php echo  base_url;?>users/step1';
					}else if(res=='fail'){
						$('#alert').show();
						/*testAnim('pulse',$('#alert'));
						setTimeout(function () {
							$('#alert').fadeOut();
						}, 3000);*/
					}
					else{
						window.location.href = '<?php echo  base_url;?>home/sites/'+res;						
					}
				}
			});								
    });
		function saveUser(){		
		var data = 'user_name='+$("#name").val()+'&email='+$("#email").val()+'&password='+$("#password").val()+'&url='+$("#url").val()+'&themeId='+$("#themeId").val();
		$.post(base_url+'users/create',data,function(msg){
			//alert(msg);
			if(msg=='User_Exist')
			{
				$('#alert-register').html('Email already registered');
				$('#alert-register').fadeIn();
				setTimeout(function(){$('#alert-register').fadeOut()},3000);
			}
			else if(msg=='Url_Exist')
			{
				$('#alert-register').html('URL already used please choose another one');
				$('#alert-register').fadeIn();
				setTimeout(function(){$('#alert-register').fadeOut()},3000);
			}
			else
			{
				$(".form-section").slideToggle('slow',function(){
					$('.main-middle').animate({margin:'80px 0px 0px'},function(){
						$("#headding-line").slideToggle();
					});
				});
				$('#alert-register').removeClass('alert-danger');
				$('#alert-register').addClass('alert-success');
				$('#alert-register').html('Registerd successfully we have sent you mail, please activate your account');
				$('#alert-register').fadeIn();
				setTimeout(function(){$('#alert-register').fadeOut();$("#my_modal").modal('hide');},3000);
			}			
		});
	}
		
		
  });
  </script>

</head>

<body>

    <div id="primaryContainer" class="primaryContainer clearfix">
		<div id="innerContent">
			<img id="image" src="<?php echo base_url;?>img/header_bg.png" class="image" />
			<img id="image1" src="<?php echo base_url;?>img/logo.png" class="image" />
			<img id="image2" src="<?php echo base_url;?>img/getbeta_hover.png" class="image" />
			<div id="fail" class="" style="display:none;text-align:center;color:red;margin:15px 0px;">Invalid email and password. Try again.</div>
			<div class="modal fade bs-modal-lg"  id="my_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:400px;">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">LogIn</h4>
		  </div>
		  <div class="modal-body">
			<div id="fail" class="" style="display:none;text-align:center;color:red;margin:15px 0px;"></div>
			<div class="clo-xs-12">
				<section class="col-md-10 center-align">
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" name="loginEmail" class="form-control" id="loginEmail" placeholder="Enter email">
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="loginPassword" class="form-control" id="loginPassword" placeholder="Password">
					  </div>
					  <div class="checkbox">
						<label>
						  <input type="checkbox"> Remember me
						</label>
					  </div>
					  <button class="btn btn-default" id="login">Let me in</button>					
				</section>
			</div>
		  </div>
		  <div class="modal-footer">
			<div class="alert alert-danger fade in" id="alert-login" style="text-align:center;display:none">Invalid email and password. Try again.</div>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
			<div class="container login-container">
				<section class="col-md-6">
					<img src="<?php echo base_url;?>img/card.png" class="img-responsive center-align"/>
				</section>
				<section class="col-md-6 main-middle" style="margin-top:100px">
					<div class="col-md-9">
						<img src="<?php echo base_url;?>img/login-img.png" class="img-responsive center-align"/>
						<p class="text-center" id="headding-line">We match you better</p>
					</div>
					<div class="col-md-9">
					  <section class="col-md-10 center-align form-section">
						<input type="hidden" id="action" value="0" />
						<form role="form" id="form" method="post" >
						  <div class="form-group">
							<input name="name" type="text" class="form-control place" id="name" placeholder="Enter Name">
						  </div>
						  <div class="form-group">
							<input name="email" type="email" class="form-control place" id="email" placeholder="Enter Email">
						  </div>
						  <div class="form-group">
							<input type="password" name="password" class="form-control place" id="password" placeholder="New Password">
						  </div>
						  <div class="form-group">
							<input type="text" name="url" class="form-control place" id="url" placeholder="Enter Url">
						  </div>
							<input type="hidden" id="action" value="0" />
						  <div class="checkbox">
							<label>
							  <input type="checkbox"> Check me out
							</label>
						  </div>
						</form>
					  </section>
						<div class="alert alert-danger fade in" id="alert-register" style="text-align:center;display:none"></div>
					  <section  class="col-md-10 center-align">
						<button id="register-btn" class="btn btn-primary btn-lg register-btn center-align">Register</button>
						<button id="login-btn" class="btn btn-info btn-lg register-btn center-align pull-right" data-toggle="modal" data-target="#my_modal">Log-In</button>
						
					  </section>
					</div>
					<div class="col-md-9 text-center">
						<p><?php echo $this->Session->flash();?><p>
					</div>
				</section>
			</div>

			<div class="clo-xs-12 align_center" id="preloader" style="display:none;">
				<img src="img/preloader (1).gif" />
			</div>
				
		</div>
        <div id="box" class="clearfix">
            <p id="text3">
                Copyright 2014 Shaadi Season
                <br />
            </p>
        </div>
        <div id="box1" class="clearfix">
        </div>
    </div>
</body>

</html>