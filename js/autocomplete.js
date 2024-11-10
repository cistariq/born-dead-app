$(document).ready(function(){	

        var $input = $("#autocomplete"), $list = $("#autoCompleteList");
		
		$input.attr("value","");
		
		var autoCompleteFocusOut = [true, true];
		
		$input.keyup(function(event) {
			
			var key = String.fromCharCode(event.keyCode).match(/\w/);
						
			if (key==null && event.keyCode!=8) return 0;
			
			$list.css("display", "inline-block");
            $list.hide();
			
            if ($(this).attr("value")!=="") {
				$list.width($(this).width()+3);      
				$list.css("margin-left",$ ("#acLodingImg").outerWidth(true) + 3 + "px");  
				
				var val = $(this).attr("value");
				
				$("#acLodingImg").css("visibility", "visible");
				
				$.ajax({
				type: "GET",
				url: "Tags.php",
				data: "job=" + val,
				dataType: "html",
				success: function(data) {
					$("#acLodingImg").css("visibility", "hidden");
					if (data!=="blank") {
						$list.show();
						var re = new RegExp("(" + val + ")", "gi");						
						data = data.replace(/[^<>]+(?=[<])/g, function(m) {
						   return m.replace(re, "<b>$1</b>");
						});

						$list.html(data);
						
						$list.children("li").click(function() {
							$input.attr("value", $(this).text());
							$list.hide();
						});

					} else {
						$list.hide();
					}
				}
				}); 
			}
		});   
		
		$input.focusin(function() { autoCompleteFocusOut[0] = false; });
		$list.focusin(function() { autoCompleteFocusOut[1] = false; });
		$list.focusout(function() { autoCompleteFocusOut[1] = true; });
		$input.focusout(function() { autoCompleteFocusOut[0] = true; });
		
		$(window).bind('click hover resize scroll mouseup', function() {
			if(autoCompleteFocusOut=="true,true") { $list.hide(); }
		});
	
});