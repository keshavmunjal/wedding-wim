<script type="text/javascript">

		$(".datepicker" ).datepicker({dateFormat: 'DD dd MM yy'});
		$('.editable').addClass('hide');
		$('.edit_text').click(function(){
			$('#'+this.id).addClass('hide');
			var id = this.id.replace('span', '');			
			$('#input'+id).val($(this).html());
			$('#input'+id).removeClass('hide').focus();						
		});
		$('.editable').focusout(function(){
			var id = this.id.replace('input', '');
			$('#span'+id).html(this.value);
			$('#'+this.id).addClass('hide');
			$('.edit_text').removeClass('hide');
					
		});
		$('.event').click(function(){
				var id = this.id;
				$('.edit_event').addClass('hide');
				$('.edit_'+id).removeClass('hide');				
				$('.event').removeClass('border-blue');
				$('.event').addClass('border-gray');
				$('#'+id).removeClass('border-gray');	
				$('#'+id).addClass('border-blue');	
				
			});	
		$('.deleteEventButton').click(function(){
			$(this).closest('.event').fadeOut();
			var num = $('#no_of_events').val();
			$('#no_of_events').val(--num);
		});
		$(".map-image").click(function(){
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
				
			});
			$('.address_input').keyup(function(){
			codeAddress(this.id);
		});
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

<section id="event_<?= $_GET['id']+1;?>" class="final-template border-gray event clearfix  ">
                <div class="row">
                  <button type="button" class="btn btn-default deleteEventButton hide edit_event edit_event_<?= $_GET['id']+1;?>">Delete Event X</button>
                  <div class="col-md-12 text-center">
                    <div class="horz-border"></div>
                    <div class="up-textContainer"> <em class="edit_event edit_event_<?= $_GET['id']+1;?> hide">Upload Photo</em> <span class="upload-photo"> <img src="../img/Wendills.jpg" class="img-circle img-responsive center-align main-template-image"> </span> </div>
                    <hgroup class="template-heading">
                      <h2><span class="edit_text" id="span_event_name_<?= $_GET['id']+1;?>">Event Name</span>
												<input name="event_name_<?= $_GET['id']+1;?>" id="input_event_name_<?= $_GET['id']+1;?>" class="editable event_text hide wedding">
											</h2>
                      <h3>
                        <input type="text" id="datepicker_<?= $_GET['id']+1;?>" class="datepicker black wedding" placeholder="Event Date"/>
                      </h3>
                    </hgroup>
                    <div class="up-textContainer cal-text-gray"> <em >Add to calendar</em>
                      <div class="calendar center-align"> <span class="glyphicon glyphicon-calendar"></span> </div>
                    </div>
                    <div class="horz-border"></div>
                    <img src="../img/torino_google-map.png" class="img-circle  center-align map-image" id="<?= $_GET['id']+1;?>">
										<div class="zoom_map" id="zoom_map_<?= $_GET['id']+1;?>">
											<textarea id="address<?= $_GET['id']+1;?>" type="textbox" class="address_input wedding"></textarea>												
											<div id="map_canvas_<?= $_GET['id']+1;?>" class="map_canvas"></div>
											<input type="button" value="save" class="btn btn-info save_address" />
										</div>
                    <address>
                    <p>Maharaja Grand Banquets<br>
                      A6.28 Paschim Vihar<br>
                      New Delhi<br>
                      110076<br>
                      <br>
                    </p>
                    <p> RSVP: <span class="edit_text" id="span_rsvp_<?= $_GET['id']+1;?>">Contact no.</span>
											<input name="rsvp_<?= $_GET['id']+1;?>" id="input_rsvp_<?= $_GET['id']+1;?>" class="editable event_text hide wedding">
										</p>
                    </address>
                    <div class=" phone-direction  col-md-5 col-md-offset-2">
                      <p>Get direction on phone <span class="glyphicon glyphicon-phone "></span> </p>
                    </div>
                  </div>
                </div>
                <br>
              </section>