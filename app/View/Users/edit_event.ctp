<!DOCTYPE html>
<html>
<head>
<title>Shadi Season Step-2</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript">
var base_url  = '<?php echo base_url;?>';
var editable = true;
	$(document).ready(function(){
		
	/***validation**/
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
	
	
	/***validation**/
	$('#loginForm').validate({
        rules: {
            loginEmail: {
				email: true,
                required: true
            },
			loginPassword: {
                required: true
            }
        },
		messages: {
			loginEmail: {
				email:"Please Provide Email",
				required:"Please Provide Valid Email"
			},
			loginPassword: {
				required:"Please Provide Password"
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
			//saveUser();
			login();
		}
    });
	
	/*****end*****/
	
	
	function login()
	{
		var data = 'username='+$('#loginEmail').val()+'&password='+$('#loginPassword').val();
		$.post(base_url+'users/login',data,function(res){
			if(!(res == 'FAIL'))
			{
				//alert(res);
				$('#alert').html('Incorrect details or account not activated.');
				$('#alert').show();
				setTimeout(function(){$('#alert').alert('close')},3000);
				userId = res;
				$("#my_modal").modal('hide');
				saveEvent(userId);
			}
		});
	}
	
	function saveUser()
	{
		
		var data = 'user_name='+$("#name").val()+'&email='+$("#email").val()+'&password='+$("#password").val()+'&url='+$("#url").val()+'&themeId='+$("#themeId").val();
		$.post(base_url+'users/create',data,function(msg){
		//alert(msg);
		if(msg=='User_Exist')
		{
			$('#alert').html('Email allready registerd');
			$('#alert').fadeIn();
			setTimeout(function(){$('#alert').fadeOut()},3000);
		}
		else if(msg=='Url_Exist')
		{
			$('#alert').html('URL allready used please choose another one');
			$('#alert').fadeIn();
			setTimeout(function(){$('#alert').fadeOut()},3000);
		}
		else
		{
			$('#alert').removeClass('alert-danger');
			$('#alert').addClass('alert-success');
			$('#alert').html('Registerd successfully we have sent you mail, please activate your account');
			$('#alert').fadeIn();
			setTimeout(function(){$('#alert').fadeOut();$("#my_modal").modal('hide');},3000);
			var userId = msg;
			$('#user_id').val(userId);
			$(".datepicker" ).datepicker('enable');
			$( "#wedding_date" ).datepicker('enable');
			$("#wedding").ajaxForm();     
			$("#wedding").submit();
			$(".datepicker" ).datepicker('disable');
			$( "#wedding_date" ).datepicker('disable');
			
			
			//saveEvent(userId);
		}
			
		});
	}
	
	/*function saveEvent(userId)
	{
			var validate = true;
			var groom = $('#input_groom').val();			
			var bride = $('#input_bride').val();
			var weddingdate = $('#weddingdate').val();
			var wedding_date_text = $('#wedding_date_text').val();
			localStorage.setItem("url", $('#url').val());
			$('input.wedding').each(function() {
				if(this.value==''){
					validate = false;
					alert('Please fill all the details.');
					return false;
				}			
			});			
			if(validate){
				var data = 'userId='+userId+'&groom='+groom+'&bride='+bride+'&wedding_date='+weddingdate+'&wedding_date_text='+wedding_date_text+'&'+$('#wedding').serialize();
				console.log(data);
				$.ajax({
					url:base_url+"events/add_event",
					data:data,
					type:"POST",
					beforeSend:function(){
						//$('#publish').html('Publishing..');
						//$('#preloader').css('display','block');								
					},
					success: function(msg){
						//$('body').html(msg); return;						
						//$('#preloader').css('display','none');	
						//$('#publish').html('Published');
						//window.location.href = "step3";
						
					}
			});
			};
	}
*/	
	
	
		var geocoder;
		var map;
		var last_id = <?= count($events);?>;
		$(".datepicker" ).datepicker({dateFormat: 'DD dd MM yy',
				onSelect: function (dateText) {
				/* get the selected date */
				var selectedDate = $(this).datepicker('getDate');
				/* get the array of day names and month names from the date picker */
				var dayNames = $(this).datepicker('option', 'dayNames');
				/* default dayNames can be accessed using $.datepicker._defaults.dayNames; */
				var monthNames = $(this).datepicker('option', 'monthNames');
				/* default monthNames can be accessed using $.datepicker._defaults.monthNames; */
				/* assign are vars */
				var date = selectedDate.getDate();
				var month = selectedDate.getMonth(); // taking the month name from the array of month names
				var year = selectedDate.getFullYear();
				/* update the ui */
				//alert(year+'-'+month+'-'+ date);
				$(this).next('input').val(year+'-'+month+'-'+ date);
				}
		});
		$( "#wedding_date" ).datepicker({dateFormat: 'DD dd MM yy',
				onSelect: function (dateText) {
				/* get the selected date */
				var selectedDate = $(this).datepicker('getDate');
				/* get the array of day names and month names from the date picker */
				var dayNames = $(this).datepicker('option', 'dayNames');
				/* default dayNames can be accessed using $.datepicker._defaults.dayNames; */
				var monthNames = $(this).datepicker('option', 'monthNames');
				/* default monthNames can be accessed using $.datepicker._defaults.monthNames; */
				/* assign are vars */
				var date = selectedDate.getDate();
				var month = selectedDate.getMonth(); // taking the month name from the array of month names
				var year = selectedDate.getFullYear();
				/* update the ui */
				//alert(year+'-'+month+'-'+ date);
				$(this).next('input').val(year+'-'+month+'-'+ date);
				}});
		$('.editable').addClass('hide');
		$('.edit_text').click(function(){
			if(editable)
			{
				$('#'+this.id).addClass('hide');
				var id = this.id.replace('span', '');			
				$('#input'+id).val($(this).html());
				$('#input'+id).removeClass('hide').focus();	
			}
		});
		$('.title_weds').focus(function(){
			//console.log(this.id);
			$('.edit-text-same').removeClass('edit-keyword');
			$("#"+this.id).next('span').addClass('edit-keyword');
		});
		$('.editable').focusout(function(){
			$('.edit-text-same').removeClass('edit-keyword');
			var id = this.id.replace('input', '');
			$('#span'+id).html(this.value);
			$('#'+this.id).addClass('hide');
			//$('.editable').removeClass('show');
			$('.edit_text').removeClass('hide');
			//$('#span'+id).addClass('show');		
		});
		$('.event').click(function(){
			if(editable)
			{			
				var id = this.id;
				$('.edit_event').addClass('hide');
				$('.edit_'+id).removeClass('hide');				
				$('.event').removeClass('border-blue');
				$('.event').addClass('border-gray');
				$('#'+id).removeClass('border-gray');	
				$('#'+id).addClass('border-blue');
				id = id.replace('event_','');
				initFileUploads(id);
			}
				
		});
		$('.addEventButton').click(function(){
			$.ajax({
					url:"edit_new_event",
					data:{id:last_id},
					type:"GET",
					beforeSend:function(){
						//$('#loadgif').show();				
					},
					success: function(msg){
						//$('body').html(msg); return;
						//alert(msg);
						$('.event').last().after(msg);
						last_id++;
						var num = $('#no_of_events').val();
						$('#no_of_events').val(++num);
						
					}
				});
		});
		
		$('.deleteEventButton').click(function(){
			var id = "id="+this.id;
			$.ajax({
				url: '<?= base_url;?>events/delete_event',
				data: id,
				type: 'POST',		
				context: $(this),
				success: function(res){
					//alert(res);
					if(res=='true'){
						this.closest('.event').fadeOut();
						var num = $('#no_of_events').val();
						$('#no_of_events').val(--num);
					}
				}
			});
						
		});
		
		$(".map-image").click(function(){
			if(editable)
			{			
				var id = this.id;
				$('#zoom_map_'+id).css('display','block')
				initialize_map('map_canvas_'+id);
				$('html').click(function (e){
				var container = $(".zoom_map");
				if (container.has(e.target).length === 0)
				{
						container.hide();
				}
				});
				
				event.stopPropagation();
			}
				
		});
		
		
		$('.address_input').keyup(function(){
			codeAddress(this.id);
		});
		$('.save_address').click(function(){
				var id = this.id.replace('save_', '');
				var address = $('#address'+id).val();
				$('#add_'+id).text(address);
				$(".zoom_map").hide();
				//event.stopPropagation();
		});
		
		$('#preview').on('click',function(){
			$('#header-wrapper').fadeOut();
			editable = false;
			$(".datepicker" ).datepicker('disable');
			$( "#wedding_date" ).datepicker('disable');
			$('#enter-details').removeClass('enter-details1').addClass('enter-details');
			$('.event').removeClass('border-blue');
			$('.event').addClass('border-gray');
		});
		$('#edit-mode-link').click(function(){
			$('#header-wrapper').fadeIn();
			editable = true;
			$(".datepicker" ).datepicker('enable');
			$( "#wedding_date" ).datepicker('enable');
			$('#enter-details').removeClass('enter-details').addClass('enter-details1');
		});
		
		/********Publish button work*******/
		$('#update').on('click', function() {
			var options = { 
				success: function(data) 
				{
				//alert(data);return false;
					window.location.href = "<?php echo base_url;?>home/sites/<?php echo $url?>";
				},
				error: function()
				{
					alert('not updated');
				}				 
			};
			$("#wedding").ajaxForm(options);     
			$("#wedding").submit();	
			
     }); 
		 
		//$("#wedding").ajaxForm();     
	
});
	var W3CDOM = (document.createElement && document.getElementsByTagName);
function initFileUploads(id){
	var rel = $('#div'+id).attr('rel');
	if(rel==1){
		$('#div'+id).attr('rel', ++rel);
		if (!W3CDOM) return;
		var image = document.createElement('input');
		image.type = 'file';
		image.id = 'file_'+id;
		image.name = 'image'+$('#fileinputs'+id).attr('rel');
		document.getElementById('fileinputs'+id).appendChild(image);
		$('#file_'+id).addClass('file');
		var fakeFileUpload = document.createElement('div');
		fakeFileUpload.className = 'fakefile';
		var href = document.createElement('em');
		href.href='#';
		href.id = 'attach_image';
		href.class = 'edit_event';
		href.class = 'edit_event_1';
		href.innerHTML = "Upload photo";
		
		
		fakeFileUpload.appendChild(href);
		var file = document.createElement('input');
		file.className = 'display';
		file.id = 'fake_image';
		fakeFileUpload.appendChild(file);
		var x = document.getElementsByTagName('input');
		for (var i=0;i<x.length;i++) {
			if (x[i].type != 'file') continue;
			if (x[i].parentNode.className != 'fileinputs') continue;
			x[i].className = 'file';
			var clone = fakeFileUpload.cloneNode(true);
			x[i].parentNode.appendChild(clone);
			x[i].relatedElement = clone.getElementsByTagName('input')[0];
			x[i].onchange = function () {	
				var ext = this.value.substring(this.value.lastIndexOf(".") + 1);
				if((ext=='jpg')||(ext=='jpeg')||(ext=='png')||(ext=='bmp')||(ext=='gif')){
					this.relatedElement.value = (this.value).replace("C:\\fakepath\\", '');
					//$('#attach_image').remove();			
					//$('#fake_image'+a).addClass('enlarge');
				}else{
						alert('Attach only image files');
				}			
			}
		}		
	}
	$('.file').one('change', function(ev) {
    var f = ev.target.files[0];
    var fr = new FileReader();
    
    fr.onload = function(ev2) {
        console.dir(ev2);
        $('#event_image_'+id).attr('src', ev2.target.result);
    };
    
    fr.readAsDataURL(f);
		});
}
	function initialize_map(id) {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(28.667696,77.093969);
    var mapOptions = {
      zoom: 11,
      center: latlng
    }
    map = new google.maps.Map(document.getElementById(id), mapOptions);
  }

  function codeAddress(id) {	
    var address = document.getElementById(id).value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
			console.log(results[0]);
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      }
    });
  }	
</script>
</head>
<body id="step2" >
	
<!-- top navigation and logo -->
<header role = "banner">
  <div class="container">
    <div class="row">
      <article class="col-md-6 col-lg-6 col-sm-6"> <img src="<?php echo base_url;?>img/logo.png" class="img-responsive" alt="" id="logo"> </article>
      <aside class="col-md-6 col-lg-6  col-sm-6 text-right" id="user-input"> 
				<a href="javascript:void(0)" id="edit-mode-link">Edit Mode</a> 
				<a href="javascript:void(0)" id="update">Update</a>
				<?php $userId = $this->Session->read('userId');
				if($userId){
				?>
					<span class="dropdown text-left">
						<button type="button" class="btn btn-default dropdown-toggle header-option" data-toggle="dropdown">
							Hello <?php echo $this->Session->read('user_name')?> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu clearfix header-ul" role="menu">
						  <li><a href="<?php echo base_url.'home/sites/'.$websiteDetails['url']?>">Your Site</a></li>
						  <li><a href="<?php echo  base_url;?>users/edit_event">Edit Site</a></li>
						  <li><a href="<?php echo  base_url;?>users/step3">Invite Friends</a></li>
						  <li><a href="<?php echo  base_url;?>users/invite_log">Invite Log</a></li>
						  <li><a href="<?php echo  base_url;?>users/logout">Logout</a></li>
						</ul>
					</span>
				<?php }?>
			</aside>
    </div>
    <!--end row--> 
    
  </div>
  <!-- end container --> 
  
</header>
<!--end header -->

<div id="header-wrapper" >
  <div id="edit-mode-box">
    <div class="black-bg">
      <section class="container">
        <article class="row ">
          <div class="col-md-8 center-align">
            <p>Now simply change the data in the design by clicking on it, yes and it auto saves</p>
          </div>
          <div class="row">
            <div class="col-md-4 center-align">
              <div class="row">
                <div class="col-md-6 col-xs-6 col-sm-6 ">
                  <button type="button" class="btn btn-info full-width initial-button-blue">Edit Mode</button>
                </div>
                <div class="col-md-6 col-xs-6 col-sm-6 ">
                  <button type="button" class="btn btn-default full-width no-bg  pr-button" id="preview">Preview Mode</button>
                </div>
								<img src="<?php echo base_url;?>img/ajax-loader.gif" id="preloader"/>                
							</div>
            </div>
          </div>
        </article>
      </section>
    </div>
    <div class="container">
      <aside class="row" id="current-theme">
        <div class="col-md-8  center-align" id="theme-status">
          <p class="">Your Current Theme</p>
          <h3 class=""> <?php echo $theme['theme_name']?> </h3>
          <p class=" "> <a href="<?php echo base_url;?>users/step1">Change Theme</a> </p>
		  <input type="hidden" id="themeId" name="themeId" value="<?php echo $themeId;?>">
        </div>
      </aside>
    </div>
  </div>
</div>
<form id="wedding" name="wedding" method="post" enctype="multipart/form-data" action="<?php echo base_url;?>events/update_event">
<div role="main" id="main" class=" clearfix" >
  <div class="container">
	
    <header id="enter-details" class="row enter-details1">
	
	<!-- <div class="col-md-8  center-align ">-->
      <div class="center-align ">
        <hgroup class="row text-center" >				
          <h3 class="col-md-4" id="man-name">
			<span id="span_groom" class="edit_text wedding"><?php echo $wedding['groom'];?></span>
			<input type="text" name="groom"   id="input_groom" class="editable title_weds" value="<?php echo $wedding['groom'];?>">
			<span class="edit-text-same"></span>
		  </h3>
          <h3 class="col-md-4" id="weds"><span>Weds</span></h3>
          <h3 class="col-md-4" id="woman-name">
			<span id="span_bride" class="edit_text wedding"><?php echo $wedding['bride'];?></span>
			<input type="text" name="bride"  id="input_bride" class="editable title_weds" value="<?php echo $wedding['bride'];?>">
			<span class="edit-text-same"></span>
		  </h3>
        </hgroup>
        <div class="row">
          <h4 class="col-md-12 text-center">
		  <input name="wedding_date_text" id="wedding_date_text" class="datepicker" value="<?php echo $wedding['wedding_date_text'];?>">
		  <input type="hidden" name="wedding_date" id="weddingdate" value="<?php echo $wedding['wedding_date'];?>">
		  </h4>
        </div>
      </div>
    </header>
  </div>
  <!--<aside class="container">
    <nav class="relative-links">
      <ul>
        <li><span></span><a href="#">Details</a></li>
        <li><span></span><a href="#">Venue</a></li>
        <li><span></span><a href="#">RSVP</a></li>
      </ul>
    </nav>
  </aside>-->
  <div class="main-wrapper clearfix">
    <section  class=" container clearfix">
      <div class="row">
        <article id="content" class="col-md-9 center-align">
          <div class="row paddingBottom-3">
            <div class="col-md-10 center-align">
						
						<input type="hidden" name="no_of_events" id="no_of_events" value="<?php echo count($events);?>"/>
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $events[0]['Events']['user_id'];?>"/>
            <?php for($i=0; $i<count($events); $i++){?>
							<section name="event[]" id="event_<?php echo $i+1;?>" class="final-template border-gray event clearfix  ">
                <div class="row">
                  <button type="button" class="btn btn-default deleteEventButton hide edit_event edit_event_<?php echo $i+1;?>" id="<?php echo $events[$i]['Events']['id'];?>">Delete Event X</button>
                  <div class="col-md-12 text-center">
										<input type="hidden" name="event_id[]" id="event_id<?php echo $i+1;?>" value="<?php echo $events[$i]['Events']['id'];?>"/>
                    <div class="horz-border"></div>
                    <div class="up-textContainer"> 
											<!--<em class="edit_event edit_event_<?php echo $i+1;?> hide" id="upload">Upload Photo</em>-->
											<div class="image-div" id="div<?php echo $i+1;?>" rel="1">
												<div class="fileinputs" id="fileinputs<?php echo $i+1;?>" rel="<?php echo $events[$i]['Events']['id'];?>"></div>
											</div>
											<span class="upload-photo">
											<?php
												if($events[$i]['Events']['event_image']!=''){
													$src = "files/images/big/".$events[$i]['Events']['event_image'];
												}else{
													$src = "img/noimage.jpg";
												}
											?>
												<img src="<?php echo base_url.$src;?>" class="img-circle img-responsive center-align main-template-image" id="event_image_<?php echo $i+1;?>"> 
											</span>
										</div>
                    <hgroup class="template-heading">
                      <h2><span class="edit_text" id="span_event_name_<?php echo $i+1;?>"><?php echo $events[$i]['Events']['event_title'];?></span>
												<input type="text" name="event_name[]" id="input_event_name_<?php echo $i+1;?>" class="editable event_text wedding text-center" value="<?php echo $events[$i]['Events']['event_title'];?>">
											</h2>
                      <h3>
                        <input type="text" name="datepicker[]" id="datepicker_<?php echo $i+1;?>" class="datepicker wedding" value="<?php echo $events[$i]['Events']['event_date_text'];?>" />
												<input type="hidden" name="date[]" value="<?php echo $events[$i]['Events']['event_date'];?>">
                      </h3>
                    </hgroup>
                    <!--<div class="up-textContainer cal-text-gray"> <em>Add to calendar</em>
                      <div class="calendar center-align"> <span class="glyphicon glyphicon-calendar"></span> </div>
                    </div>-->
                    <div class="horz-border"></div>
                    <img src="<?php echo base_url;?>img/torino_google-map.png" class="img-circle  center-align map-image" id="<?php echo $i+1;?>">
										<div class="zoom_map" id="zoom_map_<?php echo $i+1;?>">																						
											<textarea name="address[]" id="address<?php echo $i+1;?>" type="textbox" class="address_input wedding"><?php echo $events[$i]['Events']['venue'];?></textarea>												
											<div id="map_canvas_<?php echo $i+1;?>" class="map_canvas"></div>
											<input type="button" value="save" class="btn btn-info save_address" id="save_<?php echo $i+1;?>"/>
										</div>	
										<div class="row">
											<address class="col-md-4 center-align">
											<p id="add_<?php echo $i+1;?>"><?php echo $events[$i]['Events']['venue'];?></p>
											<p> RSVP: <span class="edit_text" id="span_rsvp_<?php echo $i+1;?>"><?php echo $events[$i]['Events']['rsvp'];?></span>
												<input type="text" name="rsvp[]" id="input_rsvp_<?php echo $i+1;?>" class="editable event_text wedding" value="<?php echo $events[$i]['Events']['rsvp'];?>" style="width:90px;">
											</p>
											</address>
										</div>
                    <div class=" phone-direction  col-md-5 col-md-offset-2">
                      <p>Get direction on phone <span class="glyphicon glyphicon-phone "></span> </p>
                    </div>
                  </div>
                </div>
                <br>
              </section>            
			<?php }?>
              <div class="row">
                <div class="col-md-12 text-center">
                  <button type="button" class="btn btn-info addEventButton  initial-button-blue">Add Another Event</button>
                </div>
              </div>
              <!--end one event loop--> 							
            </div>
						
					</div>
        </article>
      </div>
    </section>
  </div>
</div>
</form>
<!--footer-->
<footer class="clearfix" id="step-2-footer">
  <article id="footer-bottom" class=" clearfix">
    <h4>You are just a step away now</h4>
    <button type="button" class="btn btn-info my-button auto-height1 ">
    <div>Register </div>
    <span>Keep saving your work and edit any time</span></button>
    <div id="footer-text">
      <p><small>Copyright 2014 Shaadi Season<br>
        <a href="#">About</a> | <a href="#">Contact</a></small></p>
    </div>
  </article>
</footer>


</body>
</html>
