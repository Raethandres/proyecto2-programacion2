function print(arg){
	console.log(arg);
};


var vs=0;
$(".dropdown").click(function(){
	
	
	if(vs==0){
		vs=1;
		$(".dropdown-content").css({
        display: 'block'
    	});
	}else if (!($('.dropdown-content').is(':hover'))){
		vs=0;
		
		$(".dropdown-content").css({
        display: 'none'
    });
	}
	
	
});

$(".log").click(function(){
	if ($("#user").value() && $("#pasword").value() ) {
		$.ajax({
            type: 'post',
            url: 'form.php',
            data: $('#login').serialize(),
            dataType:'JSON',
            success: function (result) {
                if(result=="true"){
                	console.log(result);
                }
              
            }
          });
	}

});