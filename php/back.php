<?php
	session_start();
	/**
	* 
	*/
	/**
	* 
	*/
	class DataBase 
	{
		public $servername = "localhost";
		public $username = "root";
		public $password = "kara";
		public $coon;
		public $dbname = "siket";

		function __construct()
		{
			$x=1;
			$this->conexion();
		}
		function conexion(){
			
			$this->coon = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
			
// Check connection
			if ($this->coon->connect_error) {
    			echo json_encode(array("ok"=>"conection fail",));
			}
		}
		function Select($data,string $tipo,string $table,string $spec){
			if ($spec!="0") {
				$result=$this->coon->query($spec);

				if ($result->num_rows > 0) {
					mysqli_close($this->coon);
					$row=array();
					$x=0;
					while ($x!=$result->num_rows) {
						$row[$x]=$result->fetch_assoc();
						$x+=1;
				}
					return array("ok"=>"entro","row"=>$row,"nr"=>$result->num_rows );
    			
    			
    			}else{
    				mysqli_close($this->coon);
    				return array("ok"=>"no-entro","row"=>"no");
    			}			

			}
			$data="\"$data\"";
			$sql="SELECT * FROM $table WHERE $tipo=$data";
			$result=$this->coon->query($sql);

			if ($result->num_rows > 0) {
				mysqli_close($this->coon);
				$row=array();
				$x=0;
				while ($x!=$result->num_rows) {
					$row[$x]=$result->fetch_assoc();
					$x+=1;
				}
				return array("ok"=>"entro","row"=>$row,"nr"=>$result->num_rows );
    			
    			
    		}else{
    			mysqli_close($this->coon);
    			return array("ok"=>"no-entro","row"=>"no");
    		}			
			
			// if($conn->query($sql)){
				
			// }
		}
		function Insert($form,string $tipo){
			// echo json_encode(array("ok"=>$form));
			if($tipo=="logup"){
				
				$id=1;
				$nombre=$form['nombre'];
				$cedula=(int)$form['cedula'];
				$email= $form['email'];
				$sexo=$form['sexo'];
				$dire=$form['direccion'];
				$telefono=(int)$form['telefono'];
				$user=$form['username'];
				$pass=$form['pass'];
				$admin=0;
				$apellido=$form['apellido'];
				// echo json_encode(array("ok"=>$form));

				$sql = "INSERT INTO user (nombre,apellido, cedula , email, sexo , dire, telefono , user , pass,admin)
						VALUES ('$nombre','$apellido','$cedula','$email','$sexo','$dire','$telefono','$user','$pass','$admin')";
				$r=$this->coon->query($sql);
				mysqli_close($this->coon);
				echo json_encode(array("ok"=>$r,"info"=>$form));

				//  if ($this->coon->query($sql) === TRUE) {
   	// 				echo json_encode(array("ok"=>"si"));
				//  } else {
    // 				echo json_encode(array("ok"=>"no"));
				// }
		
	
			}elseif ($tipo=="volet") {
				$serial=$form['serial'];
				$evento=$form['evento'];
				$fecha= $form['fecha'];
				$ubicacion=$form['ubicacion'];
				// echo json_encode(array("ok"=>$form));

				$sql = "INSERT INTO voleto (serial,evento, fecha , ubicacion,)
						VALUES ('$serial','$evento','$fecha','$ubicacion')";
				$r=$this->coon->query($sql);
				//aqui selecciona eventos, relaciona, luego creas un registro,relaciona y cierra
				mysqli_close($this->coon);
				echo json_encode(array("ok"=>$r,"info"=>$form));
			}
		}
	}
	class Request
	{
		public $tipo;
		public $form;
		public $accion;
		public $db;
		// public $func= array('GET' =>this->Get() ,'POST'=>this->Post() );

		
		function __construct(string $tipo,array $form)
		{
			$this->tipo=$tipo;
			$this->form=$form;
			$this->db=new DataBase();
			// echo json_encode(array("ok"=>$this->form,));
			if($this->tipo=="Post"){
				$this->Post();
			}elseif ($this->tipo=="Get") {
				$this->Get();
			}
			// var_dump(tipo);
			// fu=$this->func[$this->tipo];
			// fu();
		}


		function do(){

		} 

		function Get(){
			if ($this->form["crsf"]=="chus") {
				$user=$this->db->Select($this->form["id"],"id","user","0");
				if ($user["ok"]=="entro") {
					
					$_SESSION["user"]=$user["row"][0]["id"];
				}
				
				echo json_encode($user);
			}
		}

		function Post(){
			if ($this->form["crsf"]=="login") {

				// echo json_encode(array("ok"=>$this->form["uname"],));
				$user=$this->db->Select($this->form["uname"],"user","user","0");
				if ($user["ok"]=="entro") {
					
					$_SESSION["user"]=$user["row"][0]["id"];
				}
				
				echo json_encode($user);
				// if ($user["pass"]==$this->form["psw"]) {
				// 	echo json_encode(array("ok"=>"entro","row"=>$user));
				// }else{
				// 	echo json_encode(array("ok"=>"denegado",));
				// }

			}elseif ($this->form["crsf"]=="logup") {
				//echo json_encode(array("ok"=>$this->form));
				$user=$this->db->Insert($this->form,"logup");
			}elseif ($this->form["crsf"]=="user") {
				$user=$_SESSION["user"];
				$regis=$this->db->Select($_SESSION["user"],"id_us","registros","SELECT ser,fecha,ubicacion,nom,nombre,apellido,id_vo,id_us FROM user A0, registros A1,voleto A2,evento A3 WHERE A0.id=$user and A1.id_us=A0.id and A2.id=A1.id_vo and A3.id=A1.id_eve");
				echo json_encode($regis);
			}elseif ($this->form["crsf"]=="volet") {
				$user=$this->db->Insert($this->form,"volet");
			}

		}



	}

if ($_POST) {
	// echo json_encode(array("ok"=>"1",));
	$reg=new Request("Post",$_POST);   

}elseif ($_GET) {
	$reg=new Request("Get",$_GET);
}elseif ($_PUT) {
	$reg=new Request("Put",$_PUT);
}elseif ($_DELETE) {
	$reg=new Request("Delete",$_DELETE);
}else{
	echo "nada";
}

?>