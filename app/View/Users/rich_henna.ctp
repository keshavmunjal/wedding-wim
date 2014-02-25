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