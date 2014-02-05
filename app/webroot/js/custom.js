

$(document).ready(function(e) {
    
	//custom or override function here function here
	
	
	




        // Set general variables
        // ====================================================================
        var totalWidth = 0;

        // Total width is calculated by looping through each gallery item and
        // adding up each width and storing that in `totalWidth`
        $(".gallery__item").each(function(){
            totalWidth = totalWidth + $(this).outerWidth(true);
        });

        // The maxScrollPosition is the furthest point the items should
        // ever scroll to. We always want the viewport to be full of images.
        var maxScrollPosition = totalWidth - $(".gallery-wrap").outerWidth();


        // Basic HTML manipulation
        // ====================================================================
        // Set the carousel-indicators width to the totalWidth. This allows all items to
        // be on one line.
        $(".carousel-indicators").width(totalWidth);

        // Add active class to the first carousel-indicators item
        $(".gallery__item:first").addClass("active");

        // When the prev button is clicked
        // ====================================================================
		
		
		
		
        var gall_width =  $('.gallery-wrap').width();
		
		var gall_pos =  $('.gallery-wrap').position().left;
		
		
		
		var total_width = $('ol.carousel-indicators').width();
		
		
		var item_width =   $('ol.carousel-indicators').width() - gall_width;	

var per_item_scroll = 		$('ol.carousel-indicators li').width();

var gal_pos = $('ol.carousel-indicators li.active').position().left;
		
		
		
		$(".left").click(function(){
		
		
			
           $(".carousel-indicators").animate({
                        left : '-='+per_item_scroll
						
                    });
					
					
		
					
					
				 var newPositionWidth = $(".carousel-indicators").outerWidth()  ;
				 
				  var newPositionStop = $(".carousel-indicators").position().left;
				  
				  var realScrollData = - $(".carousel-indicators").outerWidth() + gall_width;
				 
				 
	
					//alert(newPositionStop);
					
					if(newPositionStop <= realScrollData){  $(".carousel-indicators").animate({
                        left :per_item_scroll
						
                    });}
					
					

					
					
					
					
					
					
			
				//var al = $('carousel-indicators li.active').position().left;
					
					//alert(al);
        });
		
		
		
		
		
		
		
		
		
		
		
			$(".right").click(function(){
            // Set target item to the item before the active item
			
	
					
					$("#up-down").hide();
			
		
			
           $(".carousel-indicators").animate({
                        left : '+='+per_item_scroll
						
                    });
					
				 var newPositionStop = $(".carousel-indicators").position().left;



					
				
					if(newPositionStop >= 0){ 
           $(".carousel-indicators").animate({
                        left : 0
						
                    });}
					
					
				
        });
		
		
		
		
			
		$('ol.carousel-indicators li').click(function(){
		
				
			
					var scrollPosition1 = $(this).position().left;
		
		
		var pogp = $("#up-down").position().left;
		
				
		
		var halfPerItem1 = per_item_scroll/2;
		
		
	 
		$("#up-down").show(1000);
		
		$("#up-down").animate({
                        left : scrollPosition1
						
                    })
		
		
	/*	var centerAlignActive = liFullCover - $(this).position().left + halfPerItem;
		
		//alert(centerAlignActive);
		
		//var liElementsPosition = 
		
		
		
		$(".carousel-indicators").animate({
                        left : centerAlignActive
						
                    })
		
		*/	
		 });
		
		
		

		
	/*
    setInterval(function() {
	
	
      		
					$("#up-down").show();
			
var gal_pos = $('ol.carousel-indicators li.active').position().left;


if(gal_pos == ){

		
					$("#up-down").animate({
                        left : gal_pos + per_item_scroll/2
						
                    });
		
		   }
    }, 500);
		return false;
		
				

*/
				
		
    });
   
