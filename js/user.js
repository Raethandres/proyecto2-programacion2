function print(arg){
	console.log(arg);
};

function crearTr(data){
	var tri="<tr id=";
	var tdi="<td>";
	var tre="</tr>";
	var tde="</td>";
	var da="";
	for (var i = 0; i < data.length; i++) {
		da+=tri+data[i].id_vo+">";
		da+=tdi+data[i].nom+tde;
		da+=tdi+"1"+tde;
		da+=tdi+data[i].ser+tde;
		da+=tdi+data[i].fecha+tde;
		da+=tdi+data[i].ubicacion+tde;
		da+=tre;
	}
	
	$(".table-hover").append("<tbody>"+da+"</tbody>");
	print("sd");

	$("tr").on('click',function(){
		alert($(this).attr("id"));
	});
	
	// $(".table-hover").
};

$(document).ready(function(){
	var id;
	var da="crsf=user";
	$.ajax({
			
            type: 'post',
            url: '../php/back.php',
            data: da,
            dataType:'JSON',
            success: function (result) {
                if(result.ok=="entro"){
                	print(result);
                	crearTr(result.row)
                	$("#user_n").html(result.row[1].nombre);
                	$("#user_np").html(result.row[1].nombre+" "+result.row[1].apellido);
                	id=result.row[1].id_us;


                }
              
            }
          });

	$("#user_n").click(function(){
		// if (!$("#c").children("#home")) {

			$("#c").load('../html/home.html');
			da="crsf=user";
			$.ajax({
			
            type: 'post',
            url: '../php/back.php',
            data: da,
            dataType:'JSON',
            success: function (result) {
                if(result.ok=="entro"){
                	print(result);
                	crearTr(result.row)
                	$("#user_n").html(result.row[1].nombre);
                	$("#user_np").html(result.row[1].nombre+" "+result.row[1].apellido);
                	id=result.row[1].id_us;


                }
              
            }
          });
		// }

	});
	$("#cargar-boleto").click(function(){
		$("#c").load('../html/voletos.html');
		$("#c").on('click',"#volet",function(){
			print("ss");
      
			$.ajax({
            type: 'post',
            url: '../php/back.php',
            data:$('#vole').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                	print(result);
                  print("sige");
                  


                }
              
            }
          });
		});
	});
	$("#btn-logup").click(function(){
  		print("asas");
  		var da="id="+id+"&crsf=chus"
		$("#c").load('../html/logup.html #sign-up');
		$.ajax({
            type: 'get',
            url: '../php/back.php',
            data:da,
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                	print(result);
                  print("sige");
                  $("#id_nombre").val(result.row[0].nombre);
                	

          			// print(result.row);
          			// $("#tik").html(result.row.nombre);
          			// $("#usul").html(result.row.nombre);
          			// $(".dropdown-content").css({display: 'none'});


                }
              
            }
          });
		$("#c").on('click',"#send-up",function(){
			print("ss");
      
			$.ajax({
            type: 'post',
            url: '../php/back.php',
            data:$('#logup').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                	print(result);
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
	



});