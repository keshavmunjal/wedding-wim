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
			function setHeight()
			{
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
							/***********Sending mail to welcome the user*************/
              $.ajax({
                  url: '<?php echo base_url;?>users/login_new',
                  type: 'POST',
                  data: data,
                  success: function (res) {
                    if(res!='fail'){
											window.location.href = '<?php echo  base_url;?>home/sites/'+res;
										}
										else{
											$('#fail').show();
											testAnim('pulse',$('#fail'));
											setTimeout(function () {
												$('#fail').fadeOut();
											}, 3000);
										}
									}
							});								
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
			<p id="text">
				<span id="textspan">Login</span>
				<br />
			</p>
			
			<div id="fail" class="" style="display:none;text-align:center;color:red;margin:15px 0px;">Invalid email and password. Try again.</div>
			<div class="clo-xs-12">
				<section class="col-md-4 center-align">
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