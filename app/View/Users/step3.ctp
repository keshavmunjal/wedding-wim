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
      <aside class="col-md-6 col-lg-6  col-sm-6 text-right" id="user-input"> Hello <?php echo $this->Session->read('user_name')?> </aside>
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
    <li><a href="#">Engagement</a></li>
    <li><a href="#">Cocktail </a></li>
    <li><a href="#">Weddings</a></li>
   
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

<button type="button" class="btn  btn-info  my-button">Send to Friend</button>
<!--<a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=<?php echo $token;?>" type="button" class="btn  btn-info  my-button" id="send">Send to Friend</a>-->
</div>




			
			
			

</div>





<br>
 
 
<section class="row" style="margin:0;">

 


<section class="row" style="margin:0;">

 <div class="col-md-12 content">
              <h3>YOU ARE CORDIALLY INVITED </h3>
              <address>
              <p>To:  Sachin Kumar <br>
                <time>25 Jan 2014 10:00 am</time>
              </p>
              </address>
            </div>
			
			</section>
 
 
 
 
 
 

 <section class="final-template border-gray clearfix"  style="margin-top:0;">
 
 
                <div class="row">
                  <!--<button type="button" class="btn btn-default deleteEventButton ">Delete Event X</button>-->
                  <div class="col-md-12 text-center">
                    <div class="horz-border"></div>
                    <span class="upload-photo"> <img src="../img/mehndi.jpg" class="img-circle img-responsive center-align main-template-image"> </span>
                    <hgroup class="template-heading">
                      <h2>Mehndi</h2>
                      <h3>
                        <date>Thursday 15 December 2013</date>
                      </h3>
                    </hgroup>
                    <div class="calendar center-align"> <span class="glyphicon glyphicon-calendar"></span> </div>
                    <div class="horz-border"></div>
                    <img src="../img/torino_google-map.png" class="img-circle  center-align map-image">
                    <address>
                    <p>Maharaja Grand Banquets<br>
                      A6.28 Paschim Vikar<br>
                      New Delhi<br>
                      110076<br>
                      <br>
                    </p>
                    <p> RSVP: 8989893234</p>
                    </address>
                    <div class=" phone-direction  col-md-5 col-md-offset-2">
                      <p>Get direction on phone <span class="glyphicon glyphicon-phone "></span> </p>
                    </div>
                  </div>
                </div>
                <br>
				
			
				
				
				
				
				
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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://code.jquery.com/jquery.js"></script> 
<!-- Latest compiled and minified JavaScript --> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 
<!-- Custom JavaScript --> 
<script src="js/custom.js"></script>
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
$(document).ready(function(){
var base_url = '<?php echo base_url;?>';


	

	<?php if(isset($contact)){?>
	$('#my_modal').modal('show');
	<?}?>
	
	$('#send').click(function(){
		$('#contact_list').find('tbody tr > td:last-child input:checkbox')
		.each(function(){
			if(this.checked)
			{
				//alert($(this).val());
				email = $(this).val();
				var that = this;
				$.get(base_url+'events/sendInvite','email='+email,function(res){
					$(that).hide();
					$(that).next('.glyphicon').fadeIn();
					$(that).remove();
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

});
</script>
</body>
</html>
