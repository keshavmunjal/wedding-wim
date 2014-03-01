<!DOCTYPE html>
<html>
<!-- This code is only meant for previewing your Reflow design. -->

<head>
  <?php echo $this->Html->css('Page'); echo $this->Html->css('boilerplate'); echo $this->Html->css('animate'); echo $this->Html->script('jquery-1.8.3.min'); ?>

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
          if(res!='fail'){
						window.location.href = '<?php echo  base_url;?>home/sites/'+res;
					}
					else{
						$('#alert').show();
						/*testAnim('pulse',$('#alert'));
						setTimeout(function () {
							$('#alert').fadeOut();
						}, 3000);*/
					}
				}
			});								
    });
		$('#submit').click(function(){
			var action = $('#action').val();
			alert(action);
			if(action==0){
				$('#register').show();
				$('#action').val('1');
			}else{
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
			}	
				
		});
		
		
  });
  </script>

</head>

<body>

    <div id="primaryContainer" class="primaryContainer clearfix">
		<div id="innerContent">
			<img id="image" src="<?php echo base_url;?>img/header_bg.png" class="image" />
			<img id="image1" src="<?php echo base_url;?>img/logo.png" class="image" />
			<img id="image2" src="<?php echo base_url;?>img/getbeta_hover.png" class="image" />
			
			
			<div class="row" >
				
				<section class="col-md-4 center-align" style="background:cornsilk;margin-top:50px;">
					<form role="form" id="form" method="post" >
						<div id="register" style="display:none;">
						<h4>Register</h4>
						<div class="form-group">
							<label for="exampleInputEmail1">Name</label>
							<input name="name" type="text" class="form-control" id="name" placeholder="Enter Name">
							</div>
							<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input name="email" type="email" class="form-control" id="email" placeholder="Enter Email">
							</div>
							<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="New Password">
							</div>
							<div class="form-group">
							<label for="exampleInputPassword1">Unique Url</label>
							<input type="text" name="url" class="form-control" id="url" placeholder="New Password">
							</div>
						</div>
						<div  id="" class="col-md-6">
							<input type="hidden" id="action" value="0" />
							<button class="btn btn-primary btn-register" id="submit">Register</button>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#my_modal">Login</a>
						</div>
					  <!--<button type="submit" class="btn btn-default">Register</button>-->
					</form>
					
				</section>
			</div>
			
			
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
			<div class="alert alert-danger fade in" id="alert" style="text-align:center;display:none">Invalid email and password. Try again.</div>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
			
			
			
			
				
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