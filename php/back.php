<?php

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
		function Select(string $data){
			$data="\"$data\"";
			$sql="SELECT * FROM user WHERE uname=$data";
			$result=$this->coon->query($sql);
			if ($result->num_rows > 0) {
				return $row = $result->fetch_assoc();
    			
    			
    		}else{
    			echo json_encode(array("ok"=>"no","sql"=>$sql));
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
				echo json_encode(array("ok"=>$r,"info"=>$form));

				//  if ($this->coon->query($sql) === TRUE) {
   	// 				echo json_encode(array("ok"=>"si"));
				//  } else {
    // 				echo json_encode(array("ok"=>"no"));
				// }
		
	
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
			}
			// var_dump(tipo);
			// fu=$this->func[$this->tipo];
			// fu();
		}


		function do(){

		} 

		function Get(){

		}

		function Post(){
			if ($this->form["crsf"]=="login") {
				// echo json_encode(array("ok"=>$this->form["uname"],));
				$user=$this->db->Select($this->form["uname"]);
				
				if ($user["pass"]==$this->form["psw"]) {
					echo json_encode(array("ok"=>"entro","row"=>$user));
				}else{
					echo json_encode(array("ok"=>"denegado",));
				}

			}elseif ($this->form["crsf"]=="logup") {
				//echo json_encode(array("ok"=>$this->form));
				$user=$this->db->Insert($this->form,"logup");
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