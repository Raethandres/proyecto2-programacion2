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
                if(result.ok=="entro"){
                	print(result);
                  print("sige");
                  // $("#c").load('html/listo.html');
                  print("sige");
                
                		$("#id_nombre").html(result.info.nombre);
						        $("#id_apellido").html(result.info.apellido);
						        $("#id_cedula").html(result.info.cedula);
						        $("#id_direccion").html(result.info.direccion);
						        $("#id_email").html(result.info.email);
						        $("#id_telefono").html(result.info.telefono);
						        $("#id_username").html(result.info.username);
						        $("#id_pass").html(result.info.pass);
                  print("sige");
                	

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
                	location.href="/html/user.html";



                }
              
            }
          });
	}


});
