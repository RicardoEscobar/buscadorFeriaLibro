<?php 
include("inc/connection.php");
include("inc/BuscadorFullText.php");
header('Content-Type: text/html; charset=utf8');

?>
<link href="style.css" type="text/css" rel="stylesheet">



<div class="formulario-busqueda">

<form id="searchform" method="POST" action="index.php" onSubmit="return validarForm(this)">



    <input type="text" placeholder="Buscar titulo, autor, editorial..." name="palabra" required>



    <button type="submit" value="burcar" name="buscar">Buscar</button>

</form>

</div>

<?php 
if(isset($_POST['buscar'])){
/*----------------------------Busqueda----------------------------------------------------------------*/
    $obj2 = new BuscadorFullText($_POST['palabra'], 'libros');
    
    $obj2->addCamposFullText('TITULO, AUTOR, EDITORIAL, STAND');  
    $obj2->addCamposResultado(array('idLibro','TITULO', 'AUTOR', 'EDITORIAL', 'STAND', 'URLSTAND'));
    $consulta   = $obj2->getConsultaMysql();
    /*echo sprintf($consulta, 0,10); */
    $result1 = $db->query(sprintf($consulta, 0,10));
/*----------------------------/Busqueda---------------------------------------------------------------*/
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

                    <img src=<?=utf8_encode ($row['URLSTAND'])?>>

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

    ?>

    </table>



    <?php

}

?>

