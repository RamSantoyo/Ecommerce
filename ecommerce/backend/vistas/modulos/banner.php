<div class="content-wrapper">
    
  <section class="content-header">
    
    <h1>
      Gestor banner
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor banner</li>
      
    </ol>

  </section>

  <section class="content">
    
    <div class="box">
       
      <div class="box-header with-border">
         
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarBanner">

            Agregar banner

        </button>

      </div>

      <div class="box-body">
          
        <table class="table table-bordered table-striped dt-responsive tablaBanner" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Estado</th>
              <th>Ruta</th>
              <th>Tipo</th>
              <th>Acciones</th>

            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR BANNER
======================================-->

<div id="modalAgregarBanner" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">
      
      <form method="post" enctype="multipart/form-data">
        
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar banner</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            
            <!--=====================================
            ENTRADA PARA SUBIR IMAGEN DEL BANNER
            ======================================-->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN BANNER</div>

                <input type="file" class="fotoBanner" name="fotoBanner" required>

                <p class="help-block">Tamaño recomendado 550px * 1600px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/banner/default/default.jpg" class="img-thumbnail previsualizarBanner" width="100%">

            </div>

            <!--=====================================
            SELECCIONAR TIPO BANNER
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg seleccionarTipoBanner" name="tipoBanner" required>
                  
                  <option value="">Selecionar tipo</option>
                  <option value="sin-categoria">Sin Categoría</option>
                  <option value="ofertas">Oferta</option>
                  <option value="categorias">Categorías</option>
                  <option value="subcategorias">SubCategorías</option>            
  
                </select>

              </div>

            </div>

            <!--=====================================
            AGREGAR RUTA DEL BANNER
            ======================================-->

            <div class="form-group  entradaRutaBanner" style="display:none">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg seleccionarRutaBanner" name="rutaBanner">

                </select>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar banner</button>

        </div>
  
      </form>

      <?php
       
          $crearBanner = new ControladorBanner();
          $crearBanner -> ctrCrearBanner();

      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR BANNER
======================================-->

<div id="modalEditarBanner" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar banner</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EDITAR FOTO DE BANNER
            ======================================-->

            <div class="form-group">

              <input type="hidden" class="idBanner" name="idBanner">
              
              <div class="panel">CAMBIAR IMAGEN DE BANNER</div>

               <input type="file" class="fotoBanner" name="fotoBanner">
               <input type="hidden" class="antiguaFotoBanner" name="antiguaFotoBanner">

               <p class="help-block">Tamaño recomendado 550px * 1600px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/banner/default/default.jpg" class="img-thumbnail previsualizarBanner" width="100%">

            </div>

           <!--=====================================
            ENTRADA PARA SELECCIONAR EL TIPO DE BANNER
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span> 

                   <select type="text" class="form-control input-lg seleccionarTipoBanner" required name="editarTipoBanner">

                    <option class="optionEditarTipoBanner"></option>
                    <option value="sin-categoria">Sin Categoría</option>
                    <option value="ofertas">Oferta</option>
                    <option value="categorias">Categorías</option>
                    <option value="subcategorias">SubCategorías</option>     

                   </select>

                </div>

            </div>

            <!--=====================================
            EDITAR RUTA BANNER
            ======================================-->

            <div class="form-group entradaRutaBanner" style="display:none">
                
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg seleccionarRutaBanner">
                  
                   

                  </select>

                </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios banner</button>

        </div>

      </form>

      <?php
        
        $editarBanner = new ControladorBanner();
        $editarBanner -> ctrEditarBanner();

      ?>

    </div>

  </div>

</div>

 <?php
        
    $eliminarBanner = new ControladorBanner();
    $eliminarBanner -> ctrEliminarBanner();

  ?>

