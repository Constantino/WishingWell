<?php

$puntos = $_COOKIE['puntos'];
$nivel = $_COOKIE['nivel'];

session_start();

if(empty($_SESSION['usuario'])){
   //echo 'NO existe sesion por lo tanto no se actualizan los datos';
}else{
	require_once('config.php');
	
	$idjuego = 2;

 	$sql = "SELECT id as Rankid, puntaje as RankPunt from platmat.ranking where platmat.ranking.juegos_id = {$idjuego} and platmat.ranking.usuarios_id = {$_SESSION['usuario']->id} limit 1";
 	

 	$result =  mysql_query($sql);
 	while($row=mysql_fetch_object($result)){
 		$idRanking = $row->Rankid;
 		$puntajeDB = $row->RankPunt; 	
 	}

 	if($puntos > $puntajeDB){
 		$sql = "UPDATE platmat.ranking SET puntaje = {$puntos} WHERE juegos_id = {$idjuego} AND usuarios_id = {$_SESSION['usuario']->id}";
 		$result = mysql_query($sql);
 		if ($result >0){
			echo "Se ha ingresado la informacion exitosamente";
		}else {
			echo "Existe una inconsistencia en informacion";
		}
 	}else{
 		echo "El puntaje fue menor o igual... por lo tanto no se actualizo :D";
 	}




}

?>
<!DOCTYPE hmtl>
<html>
<head>

  <title>Pozo de los deseos</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="animations.css">
  <script type="text/javascript" rel="jquery-1.10.2.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

	<script>
	    function allowDrop(ev)
	    {
	    ev.preventDefault();
	    }

	    function drag(ev)
	    {
	    ev.dataTransfer.setData("Text",ev.target.id);
	    }

	    function drop(ev)
	    {
	       ev.preventDefault();
	       var data=ev.dataTransfer.getData("Text");
	       ev.target.appendChild(document.getElementById(data));

	       

	       location.href = "index.php";

	    }


	  </script>


</head>
	<body>
	  <h1>FELICIDADES ! conseguiste</h1>
	  <h3>PUNTOS: <?php echo $puntos; ?></h3>
	  <h3>NIVEL: <?php echo $nivel; ?> </h3>
	  
	  <div id="div1"  ondrop="drop(event)" ondragover="allowDrop(event)"> </div>

		<table align=center cellspacing=2 cellpadding=5>
		    <tr> 
		      <td>
		    	 <div class='floating' id='jugar' draggable='true' ondragstart='drag(event)'><p>Inicio</p></div>
		      </td>
		    </tr>
		  </table>

	</body>
</html>