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
            $('#send_email').click(function () {

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
                if (IsEmail(email)) {
                    data = 'email=' + email;


                    /***********Sending mail to welcome the user*************/
                    $.ajax({
                        url: 'home/sendInvite',
                        type: 'POST',
                        data: data,
                        beforeSend: function () {
                            $('#form').hide();
                            $("#beta_invite").show();
                            //$('#preloader').show();
                        },
                        success: function (res) {
                            if(res=='Success')
							{
								$('#welcome_message').show();
								testAnim('pulse',$('#welcome_message'));
								setTimeout(function () {
									$('#welcome_message').fadeOut();
								}, 3000);
							}
							else
							{
								$('#exist_message').show();
								testAnim('pulse',$('#exist_message'));
								setTimeout(function () {
									$('#exist_message').fadeOut();
								}, 3000);
							}
                        }
                    });

                    //alert('<?php echo base_url;?>');
                }
            });
        });
    </script>

</head>

<body>

    <div id="primaryContainer" class="primaryContainer clearfix">
		<div id="innerContent">
			<img id="image" src="img/header_bg.png" class="image" />
			<img id="image1" src="img/logo.png" class="image" />
			<img id="image2" src="img/getbeta_hover.png" class="image" />
			<p id="text">
				<span id="textspan">Beautiful &amp; Simple</span>
				<br />
			</p>
			<p id="text1">
				<span id="textspan1">Wedding Invites</span>
				<br />
			</p>
			<div class="col-xs-12 align_center">
				<button value="" id="beta_invite" onclick="show_form();"></button>
			</div>
			<div id="form" class="email_form">
				<input type="text" name="email" placeholder="Email" id="email" class="email" autocomplete="off">
				<button id="send_email" class="send_email"></button>
			</div>
			<div class="clo-xs-12 align_center" id="preloader" style="display:none;">
				<img src="img/preloader (1).gif" />
			</div>
			<div class="clo-xs-12 align_center">
				<p id='welcome_message' style="display:none;">
					Awesome! Keep a check on your mailbox.
				</p>
				<p id='exist_message' style="display:none;">
					You have already register.
				</p>
			</div>
			<p id="text2">
				<span id="textspan2">We are currently in the process of building this incredible and simple to use system to create wedding invites.<br />If you wish to be amongst the first few lucky ones to get the FREE access, send us your details.</span>
				<br
				/>
			</p>
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