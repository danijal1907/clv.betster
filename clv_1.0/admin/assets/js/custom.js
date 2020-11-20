$( document ).ready(function() {
	// close popup
	$('.close-icons').click(function(event) {
		if ($(this).closest('.popup-common').hasClass('active-popup')) {
			$(this).closest('.popup-common').removeClass('active-popup');
		}
	});
	// update cat 
	
	$(".get_img").change(function(e) {
		var geekss = e.target.files[0].name; 
		$(this).parents(".image-input").find(".display_img").text(geekss); 
	});	


	// add new cat popup
	var input1 = document.getElementById( 'file-upload-category' );
	var infoArea1 = document.getElementById( 'file-upload-filename-category' );
	input1.addEventListener( 'change', showFileName1 );

	function showFileName1( event ) {
	var input1 = event.srcElement;
		var fileName1 = input1.files[0].name;
		infoArea1.textContent =  fileName1;
	}
});

function get_id(c_id){
	document.getElementById("get_id").value = c_id;
}