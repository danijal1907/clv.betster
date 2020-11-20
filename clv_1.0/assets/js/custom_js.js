$( document ).ready(function() {

	

	// Scroll on button click (move on contact form on click button)

    $(".scroll_to_form").click(function (){

        $('html, body').animate({

            scrollTop: $("#movetocontact").offset().top

        }, 1500);

    });

    

	// Scroll to top 

 	$('#scroll').fadeOut(); 

 	$(window).scroll(function(){ 

        if ($(this).scrollTop() > 500) { 

            $('#scroll').fadeIn(); 

        } else { 

            $('#scroll').fadeOut(); 

        } 

    }); 

    $('#scroll').click(function(){ 

        $("html, body").animate({ scrollTop: 0 }, 600); 

        return false; 

    }); 



	

	// number count for stats, using jQuery animate

	$('.count').each(function () {

	    $(this).prop('Counter',0).animate({

	        Counter: $(this).text()

	    }, {

	        duration: 5000,

	        easing: 'swing',

	        step: function (now) {

	            $(this).text(Math.ceil(now));

	        }

	    });

	});





	//Same Height

	$('.same_height').each(function(){  

		var highestBox = 0;

		$('.same_height_single', this).each(function(){

			if($(this).height() > highestBox) {

				highestBox = $(this).height(); 

			}

		});  



		// Set the height of all those children to whichever was highest 

		$('.same_height_single',this).height(highestBox);



	}); 





	if ($(window).width() >= 481) {  

		$('.development_services').each(function(){  

			var highestBox = 0;

			$('.same_height_single', this).each(function(){

				if($(this).height() > highestBox) {

					highestBox = $(this).height(); 

				}

			});  

			$('.same_height_single',this).height(highestBox);

		}); 

   	}else{

   		$('.development_services').each(function(){  

			$('.same_height_single').css('height','auto');

		}); 

   	}



   	// Select Color

	  $('#select').css('color','gray');

		$('#select').change(function() {

			var current = $('#select').val();

			if (current != 'null') {

				$('#select').css('color','black');

			} else {

				$('#select').css('color','gray');

			}

		}); 



});



// manage top right image

$(window).on('resize load', function () {

	if ($(window).width() >= 768) {  

		var wminus =  $( window ).width() - $('.container').width();

		$('.site_info_section .contact_and_image .right_img img').css('right',- (wminus+10)/2);

	}

});