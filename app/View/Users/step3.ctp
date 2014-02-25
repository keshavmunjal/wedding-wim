<body id="step3">

<!--<div class="modal fade bs-modal-lg in" >-->
	<div class="modal fade bs-modal-lg"  id="my_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Send Invite to your gmail friends</h4>
		  </div>
		  <div class="modal-body" style=" max-height: 234px; overflow: overlay; ">
			<div class="row">
			<div class="col-md-10 center-align">
			<table class="table table-hover" id="contact_list">
			   <thead>
				<tr>
				   <th><span class="glyphicon glyphicon-envelope"></span></th>
				   <th>Email</th>
				   <th><input type="checkbox" checked value="1"></th>
				</tr>
			   </thead>
			   <tbody>
				<?php if($contact){
				foreach($contact as $c){
				?>
				<tr class="warning">
				   <td><span class="glyphicon glyphicon-user"></span></td>
				   <td><?php echo $c['name'].' "'.$c['email'].'"';?></td>
				   <td><input type="checkbox" checked value="<?php echo $c['email']?>"><span class="glyphicon glyphicon-ok" style="color:green;display:none;"></span></td>
				</tr>
				<?php }}?>
				</tbody>
			</table>
			</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" id="send">Send Invites</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


<!-- top navigation and logo -->
<header role = "banner">
  <div class="container">
    <div class="row">
      <article class="col-md-6 col-lg-6 col-sm-6"> <img src="../img/logo.png" class="img-responsive" alt="" id="logo"> </article>
      <aside class="col-md-6 col-lg-6  col-sm-6 text-right" id="user-input"> 
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
					  <li><a href="<?php echo  base_url;?>users/login_new">Logout</a></li>
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





<div role="main" id="welcome-user">


<header>



<div class="container initial-relative">



<form class="form-inline" role="form" id="topEditLink">
<button type="button" class="btn btn-link redBu">Edit site and change theme!</button>
  
</form>


<article class="row">

<div class="col-md-12 text-center text-white">

<hgroup class="welcome-user">

<h1>Awesome</h1>
<h2>Your beautiful Invite and Site is ready</h2>

</hgroup>


<div class="row">

<section id="site-link" class="col-md-7 col-sm-7 center-align">
<p>Your site is at</p>

<div class="row text-box-design">

<span>

<div class="col-md-8 col-sm-8 text-right ">

<form class="form-inline" role="form">
 <em>www.shaadiseason.in/sites/</em>
 <input type="text" class="form-control" id="user-link" placeholder="<?php echo $websiteDetails['url']?>" value="<?php echo $websiteDetails['url']?>">
 <!--<input type="text" class="form-control" id="user-link" placeholder="<?php echo $websiteDetails['url']?>" disabled>-->
  
</form>


</div>
<div class="col-md-4"><button type="button" class="btn btn-link redBu">Change</button></div>

</span>

</div>

</section>

</div>



</div>


</article>


</div>

</header>











<section id="mainContentView" >



<article class="container">


<div class="row">

<div class="col-md-8 center-align">




<div class="row">

<!--choose design menu-->
<div class="col-md-8" id="chooseDesignNav">

<div class="row">


<div class="btn-group col-md-6">
  
  
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Your Invite Card <span class="caret"></span>
  </button>
  <ul class="dropdown-menu clearfix" role="menu">
  <?php 
	foreach($events as $key=>$value){
  ?>
    <li><a href="javascript:void(0);" id="<?php echo $key;?>" onclick="changeEvent(this.id);"><?php print($value['Events']['event_title']);?></a></li>
   <?php }?>
  </ul>
  
  
  
  
  </div>
  
  
  


<div class="btn-group col-md-6">
  
  <button type="button" class="btn btn-default dropdown-toggle gray" data-toggle="dropdown">
    Your Website Card <span class="caret"></span>
  </button>
  <ul class="dropdown-menu clearfix" role="menu">
    <li><a href="#">Design 1</a></li>
    <li><a href="#">Design 2 </a></li>
   
   
  </ul>


</div></div>

</div>






<!--frend reauest-->

<div class="col-md-4" id="friend-request">

<button type="button" class="btn  btn-info  my-button" id="send_to_friend">Send to Friend</button>
<!--<a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $token;?>" type="button" class="btn  btn-info  my-button" id="send">Send to Friend</a>-->
</div>




			
			
			

</div>





<br>
 
 
<section class="row" style="margin:0;">

 


<section class="row" style="margin:0;">

<div class="col-md-12 grey-box" style="display:none">
	<div class="clear">
		<div class="clearfix" style="overflow:hidden;">
			<a href="#" class="cross-icon"><img src="<?php echo base_url;?>img/cross.jpg" class="pull-right cross"></a>
			<br>
			<p class="social"> Select friends from 
			<a href="javascript:void(0)" onclick="FacebookInviteFriends();"><img src="<?php echo base_url;?>img/grey-facebook.jpg" style="margin-left:10px; margin-right:9px;"></a>
			<a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $token;?>"><img src="<?php echo base_url;?>img/google.jpg" style="margin-right:9px"></a>
			Select friends from Gmail.</p>
		</div>
		<div class="clearfix" style="overflow:hidden"> <hr/></div>
		<div class="email-txt">
			<input type="text" id="friends_email" placeholder="Enter emails here(ajay@gmail.com, mukesh@gm..."><img src="<?php echo base_url;?>img/icon-maildict.jpg">
		</div>
		<div class="choices">
		<?php
		$temp=0;$i=0;
			foreach($events as $e)
			{
		?>
			<input type="checkbox" class="event-checkbox" id="check<?= $i;?>" value="<?php print($e['Events']['id'])?>" <?php if(!$temp){echo "checked";$temp++;}?>>&nbsp;<?php print($e['Events']['event_title'])?>&nbsp;&nbsp;&nbsp;
		<?php $i++;}?>	
		
		</div>
		<div class="button">
			<input type="image" id="sendinvite" src="<?php echo base_url;?>img/send-btn.jpg">
		</div>
		<div class="alert alert-danger fade in" id="event-error" style="display:none;">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		  <p>Select an event to invite.</p>
		</div>
		<div class="alert alert-danger fade in" id="invite-error" style="display:none;">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		  <p>Enter friends Email first</p>
		</div>
		<div class="alert alert-success fade in" id="invite-success" style="display:none;">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		  <p>Invites Sent Successfully.</p>
		</div>
	</div>
</div>


 <div class="col-md-12 content">
              <h3>YOU ARE CORDIALLY INVITED </h3>
              <address>
              <p>To:  Friend Email <br>
                <time><?php echo date("j F, Y, g:i a")?></time>
              </p>
              </address>
            </div>
			
			</section>
 
 
 
 
 
 

	<section class="final-template border-gray clearfix" id="invite_card" style="margin-top:0;">
		<div class="row">
			<!--<button type="button" class="btn btn-default deleteEventButton ">Delete Event X</button>-->
			<div class="col-md-12 text-center">
				<div class="horz-border"></div>
				<span class="upload-photo"> 
					<?php
						if($event['event_image']!=''){
							$src = "files/images/big/".$event['event_image'];
						}else{
							$src = "img/noimage.jpg";
						}
					?>
					<img src="<?php echo base_url.$src;?>" class="img-circle img-responsive center-align main-template-image"> </span>
				<hgroup class="template-heading">
					<h2><?php echo $event['event_title']?></h2>
					<h3>
						<date><?php echo $event['event_date_text']?></date>
					</h3>
				</hgroup>
				<div class="calendar center-align"> <span class="glyphicon glyphicon-calendar"></span> </div>
				<div class="horz-border"></div>
				<img src="../img/torino_google-map.png" class="img-circle  center-align map-image">
				<address class="col-md-4 center-align">
				<p><?php echo $event['venue']?>
				</p>
				<p> RSVP: <?php echo $event['rsvp']?></p>
				</address>
				<div class=" phone-direction  col-md-5 col-md-offset-2">
					<p>Get direction on phone <span class="glyphicon glyphicon-phone "></span> </p>
				</div>
			</div>
		</div>
	</section>
			  
			  
			  
			  
			  
			  
			  
			  <section class="row" id="shareAwesomness">
			  
			  <div class="col-md-12 text-center">
			  
			  <ul id="social-link">
			  <h3>
			  Share Awesomness
			  </h3>
			  <li id="facebook"><a href="javascript:void(0)" onclick="FacebookInviteFriends();"></a></li>
			   <li id="gplus"><a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $token;?>"></a></li>
			  
			  </ul>
			  
			  
			 
			 
			 
			 
			 <aside class="row screen-img clearfix" >
			 
			 <div class="col-md-12 text-center">
			 <img src="../img/screen.jpg" class="img-responsive ">
			 </div>
			 
			 
			 
			 </aside>
			 
			  </div>
			 
			 
			 
			 
			 
			  
			  </section>
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  


</div>

</div>

</article>











</section>

</div>




















<!--footer-->
<footer class="clearfix  step-3-footer" id="step-2-footer">
  <article id="footer-bottom" class=" clearfix">
   
    <div id="footer-text">
      <p><small>Copyright 2014 Shaadi Season<br>
        <a href="#">About</a> | <a href="#">Contact</a></small></p>
    </div>
  </article>
</footer>


<!-- Custom JavaScript --> 
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
	appId:'219248094942150',
	cookie:true,
	status:true,
	xfbml:true
	});

	function FacebookInviteFriends()
	{
	FB.ui({
	method: 'apprequests',
	message: 'Visit to out site, and create your own wedding site. http://shaadiseason.in/'
	});
	}
	function changeEvent(id){
		var data = "id="+id;
		$.post('<?= base_url;?>+users/rich_henna', data, function(data){
			$('#invite_card').html(data);
			$('.event-checkbox').prop('checked', false);
			$('#check'+id).prop('checked', true);
		});
	}
$(document).ready(function(){
var base_url = '<?php echo base_url;?>';


	

	<?php if(isset($contact)){?>
	$('#my_modal').modal('show');
	<?php }?>
	
	$('#send').click(function(){
		$('#contact_list').find('tbody tr > td:last-child input:checkbox')
		.each(function(){
			if(this.checked)
			{
				//alert($(this).val());
				email = $(this).val();
				var that = this;
				$('.event-checkbox').each(function(){
					if(this.checked)
					{
						eventId = $(this).val();
						$.get(base_url+'events/sendInvite','email='+email+'&eventId='+eventId,function(res){
							//alert('sent successfully');
							$(that).hide();
							$(that).next('.glyphicon').fadeIn();
							$(that).remove();
						});
					}
				});
			}
		});
	});
	
	$('#contact_list th input:checkbox').on('click' , function(){
	//alert("sdfds");
		var that = this;
		$(this).closest('table').find('tr > td:last-child input:checkbox')
		.each(function(){
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
			
	});
	
	$("#send_to_friend").on('click',function(){
		$(".grey-box").slideToggle('slow');
		
	});
	
	$("#sendinvite").on('click',function(){
	
		var email = $('#friends_email').val();
		if(email==''|| email==null)
		{
			//alert("Enter friends email first");
			$('#invite-error').fadeIn();
			setTimeout(function(){$('#invite-error').fadeOut('slow')},3000);
			return false;
		}
		flag = 0;
		$('.event-checkbox').each(function(){
			if(this.checked)
			{
				flag=1;
				eventId = $(this).val();
				$.get(base_url+'events/sendInvite','email='+email+'&eventId='+eventId,function(res){
					//alert('sent successfully');
					$('#invite-success').fadeIn();
					setTimeout(function(){$('#invite-success').fadeOut('slow')},3000);
				});
			}
		});
		if(flag==0)
		{
			$('#event-error').fadeIn();
			setTimeout(function(){$('#event-error').fadeOut('slow')},3000);
		}
	});

});
</script>
</body>
</html>