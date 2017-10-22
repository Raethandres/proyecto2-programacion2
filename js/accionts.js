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


$(".btn-logup").click(function(){
  print("asas");
		$("#c").load('html/logup.html #sign-up');
		$("#c").on('click',"#send-up",function(){
			print("ss");
      
			$.ajax({
            type: 'post',
            url: '../php/back.php',
            data: $('#logup').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok==true){
                	print(result);
                  print("sige");
                  
                	location.reload();

          			// print(result.row);
          			// $("#tik").html(result.row.nombre);
          			// $("#usul").html(result.row.nombre);
          			// $(".dropdown-content").css({display: 'none'});


                }
              
            }
          });
		});

		}
);

	$("#send").click(function(){
	print($('#login').serialize());
	if ($("#user").val()!=" " && $("#pasword").val()!=" " ) {
		print("ajax");
		$.ajax({
            type: 'post',
            url: '../php/back.php',
            data: $('#login').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                  if (result.row[0].admin==1) {
                    location.href="/html/admin.html";
                  }
                	else{
                    location.href="/html/user.html";

                  }

                }
              
            }
          });
	}


});
