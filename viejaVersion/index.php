<link href="style.css" type="text/css" rel="stylesheet">

<div class="formulario-busqueda">
<form id="searchform" method="POST" action="index.php" onSubmit="return validarForm(this)">
    <input type="text" placeholder="Buscar titulo, autor, editorial..." name="palabra" required>
    <button type="submit" value="Buscar" name="buscar">Buscar</button>
</form>
</div>

<?php 

header('Content-Type: text/html; charset=utf8');

//cadena de conexion

$server="localhost";
$dbuser="mlportaldb";
$dbpass="mlportaldb";
$dbname="mlportaldb";

$db=new mysqli($server,$dbuser,$dbpass,$dbname);

if($db->connect_errno>0){
    die("No fue posible conectarse a la base de datos. Error: ".$db->connect_error);
}

if(isset($_POST['buscar']))
{

    $buscar = $_POST["palabra"];
    $sql1 = "SELECT * FROM libros WHERE TITULO like '%$buscar%' or AUTOR like '%$buscar%' or EDITORIAL like '%$buscar%'";
    
    // imprime el query
    echo "<h2>$sql1</h2>";
    $result1 = $db->query($sql1);

    $row=$result1->fetch_assoc();
      // imprime el row
    echo "<h2>$row</h2>";
    if($row['TITULO']!=null){
   ?>



   <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">



       <tr>



            <td align="center"><strong>Titulo</strong></td>



            <td align="center"><strong>Autor</strong></td>



            <td align="center"><strong>Editorial</strong></td>



            <td align="center"><strong>STAND</strong></td>



       </tr>



       <?php



    //Construir y ejecutar el query

        $cont=0;

    while($row=$result1->fetch_assoc()){

        $cont++;

        ?>



           <tr>



               <td class="estilo-tabla" align="center"><?=utf8_encode ($row['TITULO'])?></td>



               <td class="estilo-tabla" align="center"><?=utf8_encode ($row['AUTOR'])?></td>



               <td class="estilo-tabla" align="center"><?=utf8_encode ($row['EDITORIAL'])?></td>



               <!-- Trigger/Open The Modal -->



                <td class="estilo-tabla" align="center">



                <button id="myBtn=<?php echo $cont ?>"><?=utf8_encode ($row['STAND'])?></button>



                <div id="myModal=<?php echo $cont ?>" class="modal">



                  <div class="modal-content">



                    <span class="close">&times;</span>



                    <img src=<?=utf8_encode ($row['URL-STAND'])?>>



                  </div>



                <script>

            // Get the modal



            var modal = document.getElementById('myModal=<?php echo $cont ?>');



            // Get the button that opens the modal



            var btn = document.getElementById("myBtn=<?php echo $cont ?>");



            // Get the <span> element that closes the modal



            var span = document.getElementsByClassName("close")[0];



            // When the user clicks the button, open the modal



            btn.onclick = function() {



                modal.style.display = "block";



            }



            // When the user clicks on <span> (x), close the modal



            span.onclick = function() {



                modal.style.display = "none";



            }



            // When the user clicks anywhere outside of the modal, close it



            window.onclick = function(event) {



                if (event.target == modal) {



                    modal.style.display = "none";



                }



            }

        </script>



                </div>



                </td>



           </tr>



           <?php



    }



    }



    ?>



    </table>







    <?php



}



?>



