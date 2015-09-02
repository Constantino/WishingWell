<?php

$puntos = $_COOKIE['puntos'];
$vidas = $_COOKIE['vidas'];
$racha = $_COOKIE['racha'];
$rachaN = $_COOKIE['rachaN'];
$nivel = $_COOKIE['nivel'];

$deter = 5; //DETERMINANTE PARA BRINCAR DE NIVEL

$numerador = 0;
$denominador = 0;
$fraccion = 0;
$problema = "";

$indice = 0;

      function gen_faciles(){
        global $numerador, $denominador, $fraccion, $problema, $indice;

        $numerador = array( rand(1,5), rand(1,5), rand(1,5), rand(1,5), rand(1,5) );
        $denominador = array( rand(1,5), rand(1,5), rand(1,5), rand(1,5), rand(1,5) );

        $fraccion = array( $numerador[0]/$denominador[0], 
                           $numerador[1]/$denominador[1],
                           $numerador[2]/$denominador[2],
                           $numerador[3]/$denominador[3],
                           $numerador[4]/$denominador[4] );
        $indice = rand(0,4);
        $multiplicar = rand(2,4);

        $n_num = $numerador[$indice]*$multiplicar;
        $n_den = $denominador[$indice]*$multiplicar;

        $problema = "$n_num/$n_den";
      }

      function gen_medio_facil(){
        global $numerador, $denominador, $fraccion, $problema, $indice;

        $numerador = array( rand(6,10), rand(6,10), rand(6,10), rand(6,10), rand(6,10));
        $denominador = array( rand(6,10), rand(6,10), rand(6,10), rand(6,10), rand(6,10));

        $fraccion = array( $numerador[0]/$denominador[0], 
                           $numerador[1]/$denominador[1],
                           $numerador[2]/$denominador[2],
                           $numerador[3]/$denominador[3],
                           $numerador[4]/$denominador[4] );
        $indice = rand(0,4);
        $multiplicar = rand(3,7);

        $n_num = $numerador[$indice]*$multiplicar;
        $n_den = $denominador[$indice]*$multiplicar;

        $problema = "$n_num/$n_den";
      }

      function gen_medianos(){
        global $numerador, $denominador, $fraccion, $problema, $indice;

        $numerador = array( rand(7,15), rand(7,15), rand(7,15), rand(7,15), rand(7,15));
        $denominador = array(rand(7,15), rand(7,15), rand(7,15), rand(7,15), rand(7,15));

        $fraccion = array( $numerador[0]/$denominador[0], 
                           $numerador[1]/$denominador[1],
                           $numerador[2]/$denominador[2],
                           $numerador[3]/$denominador[3],
                           $numerador[4]/$denominador[4] );
        $indice = rand(0,4);
        $multiplicar = rand(4,10);

        $n_num = $numerador[$indice]*$multiplicar;
        $n_den = $denominador[$indice]*$multiplicar;

        $problema = "$n_num/$n_den";
      }

      function gen_medio_dificil(){
        global $numerador, $denominador, $fraccion, $problema, $indice;

        $numerador = array( rand(10,20), rand(10,20), rand(10,20), rand(10,20), rand(10,20));
        $denominador = array( rand(10,20), rand(10,20), rand(10,20), rand(10,20), rand(10,20));

        $fraccion = array( $numerador[0]/$denominador[0], 
                           $numerador[1]/$denominador[1],
                           $numerador[2]/$denominador[2],
                           $numerador[3]/$denominador[3],
                           $numerador[4]/$denominador[4] );
        $indice = rand(0,4);
        $multiplicar = rand(5,20);

        $n_num = $numerador[$indice]*$multiplicar;
        $n_den = $denominador[$indice]*$multiplicar;

        $problema = "$n_num/$n_den";
      }

      function gen_dificiles(){
        global $numerador, $denominador, $fraccion, $problema, $indice;

        $numerador = array( rand(21,100), rand(21,100), rand(21,100), rand(21,100), rand(21,100));
        $denominador = array( rand(21,100), rand(21,100), rand(21,100), rand(21,100), rand(21,100));

        $fraccion = array( $numerador[0]/$denominador[0], 
                           $numerador[1]/$denominador[1],
                           $numerador[2]/$denominador[2],
                           $numerador[3]/$denominador[3],
                           $numerador[4]/$denominador[4] );
        $indice = rand(0,4);
        $multiplicar = rand(21,30);

        $n_num = $numerador[$indice]*$multiplicar;
        $n_den = $denominador[$indice]*$multiplicar;

        $problema = "$n_num/$n_den";

      }

if ($racha == $deter) { // Si la racha es igual al determinante para brincar de nivel
  global $racha, $nivel;
  $racha = 0; //reset de racha
  $nivel += 1; //aumenta de nivel
  setcookie("nivel", $nivel, time()+3600); //actualiza la cookie
}
if ($rachaN == 3){
  global $rachaN, $nivel, $vidas;
  $rachaN = 0;
  $nivel -= 1;
  if($nivel <= 0){

    $nivel = 1;
  }
  $vidas -= 1;
  setcookie("nivel", $nivel, time()+3600);
  setcookie("vidas", $vidas, time()+3600);

}

switch ($nivel) { // genera problemas de acuerdo al nivel
  case 1:
    gen_faciles();
    break;
  case 2:
    gen_medio_facil();
    break;
  
  case 3:
    gen_medianos();
    break;
  case 4:
    gen_medio_dificil();
    break;

  case 5:
    gen_dificiles();
    break;

  default:
    gen_faciles();
    break;
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Pozo de los deseos</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/animations.css">
  <script src="js/jquery-1.10.2.js"></script>
  
  <script>

  var correcto = 0; // variable global para determinar si contesto correcta o incorrectamente

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
    
       if(data == <?php echo "'$fraccion[$indice]'"; ?>){ //checo si el dato soltado es igual a la fraccion

          correcto = 1; //contesto correctamente
          alert("CORRECTO :)"); 
          //actualizo las cookies
          setCookie("puntos", <?php echo $puntos+$nivel*5; ?>,1);
          setCookie("racha", <?php echo $racha+1; ?>,1);
          setCookie("rachaN", 0,1);

          location.reload();
    
      }else{
        correcto = 0; //contesto incorrecto
        //restamos puntos
        negativa();

      }
    }

    function negativa(){
          alert("La respuesta correcta es <?php echo "'$numerador[$indice]/$denominador[$indice]'"; ?> ");
          var rn = <?php echo $rachaN+1; ?>;
          setCookie("rachaN", <?php echo $rachaN+1; ?>,1);
          setCookie("racha", 0,1);

          if (<?php echo $vidas; ?> == 1 && rn == 2) {
            location.href = "gameover.php"

          }else{
            location.reload();  
          }

    }

    function setCookie(c_name,value,exdays)
    {
      var exdate=new Date();
      exdate.setDate(exdate.getDate() + exdays);
      var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
      document.cookie=c_name + "=" + c_value;
    }

    var now = new Date(); //checo el ahora
    var after = new Date(now.getTime()+ <?php echo $nivel;?>*10*1000); //checo 10 segundos despues de ahora

    function getTime() {
      x = new Date(); //genero fecha actual cada que se ingrese

      tiempo = after - x; // tiempo == tiempo inicial + 10 segundo menos el tiempo actual

      if(tiempo < 0 && correcto == 0){ //si se acaba el tiempo y no ha contestado o contesto incorrecto
        tiempo = 0; 
        negativa(); //resto puntos et al

      }

      if (tiempo >= 0) { //solo si el tiempo es mayor o igual a cero lo muestro en el conteo

        document.getElementById("counter").style.color = "#FACC2E";
        document.getElementById("counter").innerHTML = Math.round(tiempo/1000);
        newtime = window.setTimeout("getTime();", 1000);

      }


    }//fin de funcion



  </script>

</head>
<body onLoad="getTime()">
  <h1>El pozo de los deseos!</h1>
  <h3>Lanza la moneda que contenga una fracci&oacute;n equivalente a <?php echo "$problema"; ?> </h3>
  
  <table align=center cellspacing=2 cellpadding=5 border=0 >
    <tr> 
      <td id="datos" rowspan="2" width=125>
        <h3>
          VIDA: <br/><?php for($i=0; $i <  $vidas; $i++){ echo "<image src=img/corazon.jpg width=18/>";}  ?> <br/><br/>  
          PUNTOS: <?php echo $puntos; ?> <br/><br/>  
          NIVEL: <?php echo $nivel; ?> <br/> <br/> 
          RACHA: <?php echo $racha; ?>
          <table cellspacing=0>
            <tr>
              <?php 
              
                for($i =0; $i < $racha; $i++){
                  echo "<td><div id='racha'/></td>";
                 }
                for($i =0; $i < ($deter-$racha); $i++){
                  echo "<td><div id='faltante'/></td>";
                }
                
              ?>
            </tr> 
            <tr>
              <?php 
              
                for($i =0; $i < $rachaN; $i++){
                  echo "<td><div id='rachaN'/></td>";
                 }
                for($i =0; $i < (3-$rachaN); $i++){
                  echo "<td><div id='faltante'/></td>";
                }
                
              ?>
            </tr>
          </table>
        </h3>

      </td>
      <td colspan=<?php echo count($fraccion);?> height=200>
        <div id="div1"  ondrop="drop(event)" ondragover="allowDrop(event)"> </div>
      </td>
      <td width=90>
        <p id="counter"></p>
      </td>
      
    </tr>
    <tr>
      <?php
       for($i=0;$i<count($fraccion);$i++){
         echo "<td width=90>
         <div class='floating' id='$fraccion[$i]' draggable='true' ondragstart='drag(event)'> <p>$numerador[$i]/$denominador[$i]</p> </div>
         </td>";     
         }
      ?>
    </tr>
  </table>

</body>
</html>
