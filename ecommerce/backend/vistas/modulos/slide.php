<?php

 $slide = ControladorSlide::ctrMostrarSlide();

?>

<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      Gestor Slide
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Slide</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary agregarSlide">
          
          Agregar slide

        </button>

      </div>

      <div class="box-body">

        <ul class="todo-list">

<?php

foreach ($slide as $key => $value) {  

  $estiloImgProducto = json_decode($value["estiloImgProducto"], true);
  $estiloTextoSlide = json_decode($value["estiloTextoSlide"], true);
  $titulo1 = json_decode($value["titulo1"], true);
  $titulo2 = json_decode($value["titulo2"], true);
  $titulo3 = json_decode($value["titulo3"], true);

  echo '<li class="itemSlide" id="'.$value["id"].'">

          <div class="box-group" id="accordion">

            <!--=====================================
            CAJA GESTOR SLIDE
            ======================================-->                  

            <div class="panel box box-info">

              <!--=====================================
              CABEZA DE LA CAJA GESTOR SLIDE
              ======================================-->      

              <div class="box-header with-border">

                <span class="handle">
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>
                </span>

                <h4 class="box-title">

                <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$value["id"].'">';
              
                if($value["nombre"] != ""){

                   echo '<p class="text-uppercase">'.$value["nombre"].'</p>';
                
                }else{

                  echo 'Slide '.$value["id"];

                }

                echo '</a>

                </h4>

                <div class="btn-group pull-right">

                  <button class="btn btn-primary guardarSlide"
                   id="'.$value["id"].'"
                   indice="'.$key.'"
                   nombreSlide="'.$value["nombre"].'"
                   tipoSlide="'.$value["tipoSlide"].'"
                   estiloImgProductoTop="'.$estiloImgProducto["top"].'"
                   estiloImgProductoRight="'.$estiloImgProducto["right"].'"
                   estiloImgProductoLeft="'.$estiloImgProducto["left"].'"
                   estiloImgProductoWidth="'.$estiloImgProducto["width"].'"
                   estiloTextoSlideTop="'.$estiloTextoSlide["top"].'" 
                   estiloTextoSlideRight="'.$estiloTextoSlide["right"].'" 
                   estiloTextoSlideLeft="'.$estiloTextoSlide["left"].'" 
                   estiloTextoSlideWidth="'.$estiloTextoSlide["width"].'"
                   imgFondo="'.$value["imgFondo"].'"
                   rutaImgFondo="'.$value["imgFondo"].'"
                   imgProducto="'.$value["imgProducto"].'" 
                   rutaImgProducto="'.$value["imgProducto"].'" 
                   titulo1Texto="'.$titulo1["texto"].'"
                   titulo1Color="'.$titulo1["color"].'"
                   titulo2Texto="'.$titulo2["texto"].'"
                   titulo2Color="'.$titulo2["color"].'"
                   titulo3Texto="'.$titulo3["texto"].'"
                   titulo3Color="'.$titulo3["color"].'"
                   boton="'.$value["boton"].'"
                   url="'.$value["url"].'"
                    >

                  <i class="fa fa-floppy-o"></i>

                  </button>

                  <button class="btn btn-danger eliminarSlide"
                   id="'.$value["id"].'"
                   imgFondo="'.$value["imgFondo"].'"
                   imgProducto="'.$value["imgProducto"].'">

                   <i class="fa fa-times"></i></button>

                </div>

              </div>

              <!--=====================================
              MÓDULOS COLAPSABLES
              ======================================-->      

              <div id="collapse'.$value["id"].'" class="panel-collapse collapse collapseSlide">

                <!--=====================================
                EDITOR SLIDE
                ======================================-->    
                
                <div class="row">

                  <!--=====================================
                  PRIMER BLOQUE
                  ======================================--> 
              
                  <div class="col-md-4 col-xs-12">
            
                    <div class="box-body">

                      <!--=====================================
                      MODIFICAR NOMBRE SLIDE
                      ======================================-->      
                    
                      <div class="form-group">
                    
                        <label>Nombre del Slide:</label>

                        <input type="text" class="form-control nombreSlide" indice="'.$key.'" value="'.$value["nombre"].'">

                      </div>  

                      <!--=====================================
                      MODIFICAR EL TIPO DE SLIDE
                      ======================================--> 

                      <div class="form-group">

                        <input type="hidden" class="tipoSlide" value="'.$value["tipoSlide"].'">

                        <label>Tipo de Slide:</label>

                        <label class="checkbox-inline selTipoSlide">
                        
                          <input class="tipoSlideIzq" type="radio" value="slideOpcion1" name="tipoSlide'.$key.'" indice="'.$key.'">

                          Izquierda

                        </label>

                        <label class="checkbox-inline selTipoSlide">
                        
                          <input class="tipoSlideDer" type="radio" value="slideOpcion2" name="tipoSlide'.$key.'" indice="'.$key.'">

                          Derecha

                        </label>

                      </div> 

                      <!--=====================================
                      MODIFICAR EL FONDO DEL SLIDE
                      ======================================--> 

                      <div class="form-group">
                    
                        <label>Cambiar Imagen Fondo:</label>

                        <br>

                        <p class="help-block">
                        <img src="'.$value["imgFondo"].'" class="img-thumbnail previsualizarFondo" width="200px">
                        </p>

                        <input type="file" class="subirFondo" indice="'.$key.'">

                        <p class="help-block">Tamaño recomendado 1600px * 520px</p>

                      </div>

                      <!--=====================================
                      MODIFICAR EL BOTÓN DEL SLIDE
                      ======================================--> 

                      <div class="form-group">
  
                        <label>Texto del botón:</label>

                        <input type="text" class="form-control botonSlide" indice="'.$key.'" value="'.$value["boton"].'" placeholder="EJEMPLO: IR AL PRODUCTO">

                      </div>

                      <div class="form-group">
                  
                        <label>Url del botón:</label>

                        <input type="text" class="form-control urlSlide" indice="'.$key.'" value="'.$value["url"].'" placeholder="EJEMPLO: http://www.google.com">

                      </div>

                    </div>

                  </div>

                  <!--=====================================
                  SEGUNDO BLOQUE
                  ======================================--> 

                  <div class="col-md-4 col-xs-12">

                    <div class="box-body">

                      <!--=====================================
                      MODIFICAR LA IMAGEN DEL PRODUCTO
                      ======================================--> 
              
                      <div class="form-group">
                    
                        <label>Cambiar Imagen Producto:</label>

                        <br>

                        <p class="help-block">
                          <img src="'.$value["imgProducto"].'" class="img-thumbnail previsualizarProducto" width="200px">
                        </p>

                        <input type="file" class="subirImgProducto" indice="'.$key.'">

                        <p class="help-block">Tamaño recomendado 600px * 600px</p>

                      </div>

                      <!--=====================================
                      MODIFICAR LA POSICIÓN DE LA IMAGEN PRODUCTO
                      ======================================--> 

                      <div class="form-group">

                        <label>Posición VERTICAL de la imagen del producto: </label>

                        <input type="text" indice="'.$key.'" value="" class="slider form-control posVertical posVertical'.$key.'" data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloImgProducto["top"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="red">
                          
                        <label>Posición HORIZONTAL de la imagen del producto: </label>';

                        if($value["tipoSlide"] == "slideOpcion1"){

                        echo '<input type="text" indice="'.$key.'" value="" class="slider form-control posHorizontal posHorizontal'.$key.'" 
                          tipoSlide = "'.$value["tipoSlide"] .'"
                          data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloImgProducto["right"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="blue">';

                        }else{

                          echo '<input type="text" indice="'.$key.'" value="" class="slider form-control posHorizontal posHorizontal'.$key.'" 
                          tipoSlide = "'.$value["tipoSlide"] .'"
                          data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloImgProducto["left"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="blue">';

                        }


                      echo '<label>ANCHO de la imagen del producto: </label>

                        <input type="text" indice="'.$key.'" value="" class="slider form-control anchoImagen anchoImagen'.$key.'" data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloImgProducto["width"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="green">

                      </div>

                    </div>

                  </div>

                  <!--=====================================
                  TERCER BLOQUE
                  ======================================--> 

                  <div class="col-md-4 col-xs-12">
                
                    <div class="box-body">

                      <!--=====================================
                      CAMBIO TÍTULO 1
                      ======================================--> 

                      <div class="form-group">

                        <label>Título 1:</label>

                        <input type="text" class="form-control cambioTituloTexto1" indice="'.$key.'"  value="'.$titulo1["texto"].'">

                        <div class="input-group my-colorpicker">
                        
                          <input type="text" class="form-control cambioColorTexto1" indice="'.$key.'" value="'.$titulo1["color"].'">

                          <div class="input-group-addon">

                            <i></i>

                          </div>

                        </div>

                      </div>

                      <!--=====================================
                      CAMBIO TÍTULO 2
                      ======================================--> 

                      <div class="form-group">

                        <label>Título 2:</label>

                        <input type="text" class="form-control cambioTituloTexto2" indice="'.$key.'" value="'.$titulo2["texto"].'">

                        <div class="input-group my-colorpicker">
                        
                          <input type="text" class="form-control cambioColorTexto2" indice="'.$key.'" value="'.$titulo2["color"].'">

                          <div class="input-group-addon">

                            <i></i>

                          </div>

                        </div>

                      </div>

                      <!--=====================================
                      CAMBIO TÍTULO 3
                      ======================================--> 

                      <div class="form-group">

                        <label>Título 3:</label>

                        <input type="text" class="form-control cambioTituloTexto3" indice="'.$key.'" value="'.$titulo3["texto"].'">

                        <div class="input-group my-colorpicker">
                        
                          <input type="text" class="form-control cambioColorTexto3" indice="'.$key.'" value="'.$titulo3["color"].'">

                          <div class="input-group-addon">

                            <i></i>

                          </div>

                        </div>

                      </div>

                      <!--=====================================
                      MODIFICAR LA POSICIÓN DEL TEXTO
                      ======================================--> 

                      <div class="form-group">

                        <label>Posición VERTICAL del texto: </label>

                        <input type="text" indice="'.$key.'" value="" class="slider form-control posVerticalTexto posVerticalTexto'.$key.'" data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloTextoSlide["top"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="red">
                          
                        <label>Posición HORIZONTAL del texto: </label>';

                        if($value["tipoSlide"] == "slideOpcion1"){

                        echo '<input type="text" indice="'.$key.'" value="" class="slider form-control posHorizontalTexto posHorizontalTexto'.$key.'" 
                          tipoSlide = "'.$value["tipoSlide"] .'"
                          data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloTextoSlide["left"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="blue">';

                        }else{

                          echo '<input type="text" indice="'.$key.'" value="" class="slider form-control posHorizontalTexto posHorizontalTexto'.$key.'" 
                          tipoSlide = "'.$value["tipoSlide"] .'"
                          data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloTextoSlide["right"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="blue">';

                        }


                      echo '<label>ANCHO del texto: </label>

                        <input type="text" indice="'.$key.'" value="" class="slider form-control anchoTexto anchoTexto'.$key.'" data-slider-min="0" 
                          data-slider-max="50"
                          data-slider-step="5"
                          data-slider-value="'.$estiloTextoSlide["width"].'" 
                          data-slider-orientation="horizontal"
                          data-slider-selection="before" 
                          data-slider-tooltip="show" 
                          data-slider-id="green">

                      </div>

                    </div>
                    
                  </div>
            
                </div>

                <!--=====================================
                VISOR SLIDE
                ======================================-->      

                <div class="slide">

                  <img class="cambiarFondo" src="'.$value["imgFondo"].'">

                  <div class="slideOpciones '.$value["tipoSlide"].'">

                    <img class="imgProducto" src="'.$value["imgProducto"].'" style="top:'.$estiloImgProducto["top"].'%; right:'.$estiloImgProducto["right"].'%; width:'.$estiloImgProducto["width"].'%; left:'.$estiloImgProducto["left"].'%">        

                    <div class="textosSlide" style="top:'.$estiloTextoSlide["top"].'%; left:'.$estiloTextoSlide["left"].'%; width:'.$estiloTextoSlide["width"].'%; right:'.$estiloTextoSlide["right"].'%">
                      
                      <h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>

                      <h2 style="color:'.$titulo2["color"].'">'.$titulo2["texto"].'</h2>

                      <h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>';

                    if($value["boton"] != ""){

                      echo '<a href="'.$value["url"].'">
                        
                        <button class="btn btn-default backColor text-uppercase">

                        '.$value["boton"].' <span class="fa fa-chevron-right"></span>

                        </button>

                      </a>';

                    }

                    echo '</div>  

                  </div>

                </div>

              </div>

            </div>

          </div>

        </li>';

}


?>   

        </ul>

      </div>

    </div>
    
  </section>

</div>

<?php

  $eliminarSlide = new ControladorSlide();
  $eliminarSlide -> ctrEliminarSlide();

?>