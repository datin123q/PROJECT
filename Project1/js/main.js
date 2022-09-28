(function($) {
   
	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);
function openForm() {
	document.getElementById("popupForm").style.display = "block";
  }
function closeForm() {
	document.getElementById("popupForm").style.display = "none";
  }
    
