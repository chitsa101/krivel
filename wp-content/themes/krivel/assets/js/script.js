
//	jQuery Validate example script
//
//	Prepared by David Cochran
//
//	Free for your use -- No warranties, no guarantees!
//

$(document).ready(function(){

// 	// Validate
// 	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
// 	// http://docs.jquery.com/Plugins/Validation/
// 	// http://docs.jquery.com/Plugins/Validation/validate#toptions

		$('#contact-form').validate({
	    rules: {
	      name: {
	        minlength: 2,
	        required: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      subject: {
	      	minlength: 2,
	        required: true
	      },
	      message: {
	        minlength: 2,
	        required: true
	      }
	    },
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.form-group').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready


$(document).ready(function() {
		$('.nav_main').scrollToFixed();
});

$('[data-target="feedback"]').on('submit', function(e){ 
  e.preventDefault(); 
  var form = $(this).serializeArray(); 
  $.post( 
    myajax.url, { 
      form: form, 
      action: 'form_otk' 
    }, 
    function(data){ 
      alert(data); 
      $('.reset').val('');
    } 
  ) 
});

	$(document).ready(function() {
		var offset = $(".blog_nav").offset(); 
		if(offset) {
			$(window).scroll(function() {
				if ($(window).scrollTop() > offset.top) { 
						$(".blog_nav").stop().animate({marginTop: $(window).scrollTop() - offset.top}); 
				}else{ 
						$(".blog_nav").stop().animate({marginTop: 0}); 
				}
		});
		}
	});







 

