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
	 $(document).ready(function () {
		
			//setting height of inner content
			function setHeight()
			{
				//var height = window.innerHeight;
				//console.log("height:"+height);
				//$('#innerContent').css(
				//{'height':height+'px'});
			}
			setHeight();
			
			//end of setting height
			
			$(window).on('resize',function(){ setHeight(); });
		});
	</script>

</head>

<body>
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
    <div id="primaryContainer" class="primaryContainer1 clearfix">
		<div id="innerContent">
			<img id="image1" src="<?php echo base_url;?>img/logo.png" class="image" />
			<img id="image2" src="<?php echo base_url;?>img/getbeta_hover.png" class="image" />
			<p id="text">
				<span id="textspan">Invitation Record</span>
				<br />
			</p>
			
			
			<div class="clo-xs-12">
				<section class="col-md-7 center-align">
					<table class="table table-hover invite-table">
					  <thead>
						<tr>
						  <th></th>
						  <th>Friend Email</th>
						  <th>Event Name</th>
						  <th>Invite Time</th>
						</tr>
					  </thead>
					  <tbody>
						<?php 
						$count=0;
						foreach($invite as $i)
						{
						?>
						<tr>
						  <td><?php echo ++$count;?></td>
						  <td><?php echo $i['Invite_logs']['to']?></td>
						  <td><?php echo $i['Invite_logs']['event_id']?></td>
						  <td><?php echo $i['Invite_logs']['invite_time']?></td>
						</tr>
						<?php
						}?>
					  </tbody>
					</table>
				</section>
			</div>
			<div class="clo-xs-12 align_center" id="preloader" style="display:none;">
				<img src="img/preloader (1).gif" />
			</div>
				
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
</body>

</html>