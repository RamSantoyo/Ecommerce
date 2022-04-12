<!--=====================================
PÁGINA DE INICIO
======================================-->

<!-- content-wrapper -->
<div class="content-wrapper">

  <!-- content-header -->
  <section class="content-header">
    
    <h1>
    Tablero
    <small>Panel de Control</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tablero</li>

    </ol>

  </section>
  <!-- content-header -->

  <!-- content -->
  <section class="content">
    
    <!-- row -->
    <div class="row">

       <?php

        if($_SESSION["perfil"] == "administrador"){

        include "inicio/cajas-superiores.php";

        }
      
      ?>

    </div>
    <!-- row -->

    <!-- row -->
    <div class="row">

      
        
         <?php

         if($_SESSION["perfil"] == "administrador"){

          echo '<div class="col-lg-6">';
       
          include "inicio/grafico-ventas.php";
          include "inicio/productos-mas-vendidos.php";

          echo '</div>';

          }      

        ?>

     


        
         <?php

          if($_SESSION["perfil"] == "administrador"){

            echo ' <div class="col-lg-6">';
         
            include "inicio/grafico-visitas.php";
            include "inicio/ultimos-usuarios.php";

            echo '</div>'; 

          }else{

          echo ' <div class="col-lg-12">';
       
          include "inicio/grafico-visitas.php";
          include "inicio/ultimos-usuarios.php";

          echo '</div>';

          }         

        ?>

       <div class="col-lg-12">

        <?php

        include "inicio/productos-recientes.php";

        ?>

      </div>

    </div>
    <!-- row -->

 </section>
  <!-- content -->

</div>
<!-- content-wrapper -->

  