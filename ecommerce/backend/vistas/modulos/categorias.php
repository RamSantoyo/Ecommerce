<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Gestor categorías
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor categorías</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
         
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

            Agregar categoría

          </button>

      </div>

      <div class="box-body">
         
        <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">#</th>
              <th>Categoría</th>
              <th>Ruta</th>
              <th>Estado</th>
              <th>Descripción</th>
              <th>Palabras Claves</th>
              <th>Portada</th>
              <th>Tipo de Oferta</th>
              <th>Valor Oferta</th>
              <th>Imagen Oferta</th>
              <th>Fin Oferta</th>
              <th>Acciones</th>

            </tr>

          </thead>

        </table> 

      </div>
        
    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="box-body">

            <!--=====================================
            ENTRADA DEL TITULO DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoria" name="tituloCategoria" required> 

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-link"></i></span>

                <input type="text" class="form-control input-lg rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly required> 

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LA DESCRIPCIÓN DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                <textarea maxlength="120" class="form-control input-lg" name="descripcionCategoria"  rows="3" placeholder="Ingresar descripción categoría" required></textarea>

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LAS PALABRAS CLAVES DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsinput" placeholder="Ingresar palabras claves" name="pClavesCategoria" required> 

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA SUBIR FOTO DE PORTADA
            ======================================-->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

               <input type="file" class="fotoPortada" name="fotoPortada">

               <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>

            <!--=====================================
            ENTRADA PARA TIPO DE OFERTA
            ======================================-->

            <div class="form-group">
              
              <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
                
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>

              </select>

            </div>

            <div class="datosOferta" style="display:none">
              
              <!--=====================================
              ENTRADA PARA EL VALOR DE LA OFERTA
              ======================================-->

              <div class="form-group row">
                 
                <div class="col-xs-6">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg valorOferta" id="precioOferta" name="precioOferta" min="0" step="any" placeholder="Precio"> 

                  </div>

                </div>

                <div class="col-xs-6">

                  <div class="input-group">
                      
                    <input type="number" class="form-control input-lg valorOferta" id="descuentoOferta" name="descuentoOferta" min="0" placeholder="Descuento"> 

                     <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

              <!--=====================================
              ENTRADA PARA LA FECHA FIN OFERTA
              ======================================-->

              <div class="form-group">
                
                <div class="input-group date">
                  
                  <input type='text' class="form-control datepicker input-lg valorOferta" name="finOferta">

                  <span class="input-group-addon">
                        
                    <span class="glyphicon glyphicon-calendar"></span>
                    
                  </span>                  

                </div>

              </div>

              <!--=====================================
              ENTRADA PARA SUBIR FOTO DE OFERTA
              ======================================-->

              <div class="form-group">
                
                <div class="panel">SUBIR FOTO OFERTA</div>

                 <input type="file" class="fotoOferta" name="fotoOferta">

                 <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                  <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

      </form>

      <?php

        
          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="box-body">

            <!--=====================================
            ENTRADA DEL TITULO DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoria" name="editarTituloCategoria" required> 

                <input type="hidden" class="editarIdCategoria" name="editarIdCategoria">
                <input type="hidden" class="editarIdCabecera" name="editarIdCabecera">

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-link"></i></span>

                <input type="text" class="form-control input-lg rutaCategoria" placeholder="Ruta url para la categoría" name="rutaCategoria" readonly required> 

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LA DESCRIPCIÓN DE LA CATEGORÍA
            ======================================-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                <textarea maxlength="120" class="form-control input-lg descripcionCategoria" name="descripcionCategoria"  rows="3" placeholder="Ingresar descripción categoría" required></textarea>

              </div> 

            </div>

            <!--=====================================
            ENTRADA PARA LAS PALABRAS CLAVES DE LA CATEGORÍA
            ======================================-->

             <div class="form-group editarPalabrasClaves">
               


             </div>

           <!--  <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsinput" placeholder="Ingresar palabras claves" name="pClavesCategoria" required> 

              </div> 

            </div> -->

            <!--=====================================
            ENTRADA PARA SUBIR FOTO DE PORTADA
            ======================================-->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

               <input type="file" class="fotoPortada" name="fotoPortada">
               <input type="hidden" class="antiguaFotoPortada" name="antiguaFotoPortada">

               <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>

            <!--=====================================
            ENTRADA PARA TIPO DE OFERTA
            ======================================-->

            <div class="form-group">
              
              <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
                
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>

              </select>

            </div>

            <div class="datosOferta" style="display:none">
              
              <!--=====================================
              ENTRADA PARA EL VALOR DE LA OFERTA
              ======================================-->

              <div class="form-group row">
                 
                <div class="col-xs-6">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg valorOferta" id="precioOferta" name="precioOferta" min="0" step="any" placeholder="Precio"> 

                  </div>

                </div>

                <div class="col-xs-6">

                  <div class="input-group">
                      
                    <input type="number" class="form-control input-lg valorOferta" id="descuentoOferta" name="descuentoOferta" min="0" placeholder="Descuento"> 

                     <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

              <!--=====================================
              ENTRADA PARA LA FECHA FIN OFERTA
              ======================================-->

              <div class="form-group">
                
                <div class="input-group date">
                  
                  <input type='text' class="form-control datepicker input-lg valorOferta finOferta" name="finOferta">

                  <span class="input-group-addon">
                        
                    <span class="glyphicon glyphicon-calendar"></span>
                    
                  </span>                  

                </div>

              </div>

              <!--=====================================
              ENTRADA PARA SUBIR FOTO DE OFERTA
              ======================================-->

              <div class="form-group">
                
                <div class="panel">SUBIR FOTO OFERTA</div>

                 <input type="file" class="fotoOferta" name="fotoOferta">
                  <input type="hidden" class="antiguaFotoOferta" name="antiguaFotoOferta">

                 <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                  <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios categoría</button>

        </div>

      </form>

      <?php

        
          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

      ?>

    </div>

  </div>

</div>

 <?php

        
    $eliminarCategoria = new ControladorCategorias();
    $eliminarCategoria -> ctrEliminarCategoria();

  ?>


<!--=====================================
BLOQUEO DE LA TECLA ENTER
======================================-->

<script>
  
$(document).keydown(function(e){

  if(e.keyCode == 13){

    e.preventDefault();

  }

})


</script>


