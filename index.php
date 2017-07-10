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

    /*echo sprintf($consulta, 0,10);*/

    $result1 = $db->query(sprintf($consulta, 0, 1000));

/*----------------------------/Busqueda---------------------------------------------------------------*/

   ?>

   <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
   <script src="script.js"></script>


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

        ?>



           <tr>



               <td class="estilo-tabla" align="center"><?=utf8_encode ($row['TITULO'])?></td>



               <td class="estilo-tabla" align="center"><?=utf8_encode ($row['AUTOR'])?></td>



               <td class="estilo-tabla" align="center"><?=utf8_encode ($row['EDITORIAL'])?></td>


                <td class="estilo-tabla" align="center">


                <div id="myModal=<?php echo $cont ?>" class="modal">



                  <div class="modal-content">


                    <img src=<?=utf8_encode ($row['URLSTAND'])?>>



                  </div>

                </div>
               
                <button id="myBtn=<?php echo $cont ?>" onclick="share(<?php echo $cont ?>)"><?=utf8_encode ($row['STAND'])?></button>
               
                </td>
                
           </tr>

           <?php
            
            $cont++;


    }

    ?>

    </table>

    <?php



}



?>

