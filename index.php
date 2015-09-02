<!DOCTYPE HTML>
<html>
<head>
  <title>Pozo de los deseos</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/animations.css">
  <script type="text/javascript" rel="js/jquery-1.10.2.js"></script>
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

       setCookie("puntos", 0,1);
       setCookie("vidas", 3,1);
       setCookie("nivel", 1,1);
       setCookie("racha", 0,1);
       setCookie("rachaN", 0,1);


       location.href = "game.php";

    }

function setCookie(c_name,value,exdays)
{
  var exdate=new Date();
  exdate.setDate(exdate.getDate() + exdays);
  var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
  document.cookie=c_name + "=" + c_value;
}


  </script>

</head>
<body>
  <h1>El pozo de los deseos!</h1>
  <h3>Lanza la moneda para jugar</h3>
  <div id="div1"  ondrop="drop(event)" ondragover="allowDrop(event)"> </div>
  <table align=center cellspacing=2 cellpadding=5>
    <tr> 
      <td>
    	 <div class='floating' id='jugar' draggable='true' ondragstart='drag(event)'><p>$</p></div>
      </td>
    </tr>
  </table>
</body>
</html>
