// NEED JQUERY
$( document ).ready(function() {
	setTimeout(function() {
		if (($('#adblock').css('display') == 'none') || ($('#adblock').height() == 0)) {
		    	ab = 1; // adblock est present et actif
		    	console.log(ab);
		    }else{
		    	if ($('#adblock').css('-moz-binding')){
			    	ab = 2; // adblock est present mais desactive
			    	console.log(ab);
			    }else{
			    	ab = 0; // adblock absent
			    	console.log(ab);
			    }
		    }
		    $.ajax({
	            url: "a.php",
	            type: 'GET',
	            data: {
				  ab: ab,
				  site: "1"
				}
	        });
	}, 5000);
});