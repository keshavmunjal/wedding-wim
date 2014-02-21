<script type="text/javascript">
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
				id = id.replace('event_', '');
				initFileUploads(id);
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
		$('.save_address').click(function(){
				var id = this.id.replace('save_', '');
				var address = $('#address'+id).val();
				$('#add_'+id).text(address);
				$(".zoom_map").hide();
				//event.stopPropagation();
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

<section id="event_<?= $_GET['id']+1;?>" class="final-template border-gray event clearfix  ">
                <div class="row">
                  <button type="button" class="btn btn-default deleteEventButton hide edit_event edit_event_<?= $_GET['id']+1;?>">Delete Event X</button>
                  <div class="col-md-12 text-center">
										<input type="hidden" name="event_id[]" id="event_id<?= $_GET['id']+1;?>" value="<?= $id;?>"/>
                    <div class="horz-border"></div>
                    <div class="up-textContainer">
											<!--<em class="edit_event edit_event_<?= $_GET['id']+1;?> hide">Upload Photo</em> -->
											<div class="image-div" id="div<?= $_GET['id']+1;?>" rel="1">
												<div class="fileinputs" id="fileinputs<?= $_GET['id']+1;?>" rel="<?= $id;?>"></div>
											</div>
											<span class="upload-photo">
												<img src="../img/Wendills.jpg" class="img-circle img-responsive center-align main-template-image" id="event_image_<?= $_GET['id']+1;?>">
											</span> 
										</div>
                    <hgroup class="template-heading">
                      <h2><span class="edit_text" id="span_event_name_<?= $_GET['id']+1;?>">Event Name</span>
												<input name="event_name[]" id="input_event_name_<?= $_GET['id']+1;?>" class="editable event_text hide wedding" value="Event Name">
											</h2>
                      <h3>
                        <input type="text" name="datepicker[]" id="datepicker_<?= $_GET['id']+1;?>" class="datepicker wedding" value="Monday 14 April 2014"/>
												<input type="hidden" name="date[]" value="2014-3-14">
                      </h3>
                    </hgroup>
                    <div class="up-textContainer cal-text-gray"> <em >Add to calendar</em>
                      <div class="calendar center-align"> <span class="glyphicon glyphicon-calendar"></span> </div>
                    </div>
                    <div class="horz-border"></div>
                    <img src="../img/torino_google-map.png" class="img-circle  center-align map-image" id="<?= $_GET['id']+1;?>">
										<div class="zoom_map" id="zoom_map_<?= $_GET['id']+1;?>">
											<textarea name="address[]" id="address<?= $_GET['id']+1;?>" type="textbox" class="address_input wedding">New Address</textarea>												
											<div id="map_canvas_<?= $_GET['id']+1;?>" class="map_canvas"></div>
											<input type="button" value="save" class="btn btn-info save_address" id="save_<?= $_GET['id']+1;?>"/>
										</div>
										<div class="row">					
											<address class="col-md-4 center-align">
                        <p id="add_<?= $_GET['id']+1;?>">Maharaja Grand Banquets
												A6.28 Paschim Vihar
												New Delhi
												110076												
											</p>
										</div>
                    <p> RSVP: <span class="edit_text" id="span_rsvp_<?= $_GET['id']+1;?>">6584456555</span>
											<input name="rsvp[]" id="input_rsvp_<?= $_GET['id']+1;?>" class="editable event_text hide wedding" style="width:90px;" value="6584456555">
										</p>
                    </address>
                    <div class=" phone-direction  col-md-5 col-md-offset-2">
                      <p>Get direction on phone <span class="glyphicon glyphicon-phone "></span> </p>
                    </div>
                  </div>
                </div>
                <br>
              </section>