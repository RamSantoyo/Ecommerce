<?php

$plantilla = ControladorComercio::ctrSeleccionarPlantilla();

$redSocial = json_decode($plantilla["redesSociales"], true);

?>

<div class="box box-success">
	
	<div class="box-header with-border">
		
		<h3 class="box-title">REDES SOCIALES</h3>

	    <div class="box-tools pull-right">

     		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

	        	<i class="fa fa-minus"></i>

	       	</button>

	    </div>

	</div>


 	<div class="box-body">
	 	
		<div class="form-group">

			<label class="checkbox-inline"><input type="radio" value="color" name="colorRedSocial"> Color</label>
      		<label class="checkbox-inline"><input type="radio" value="blanco" name="colorRedSocial"> Blanco</label>
      		<label class="checkbox-inline"><input type="radio" value="negro" name="colorRedSocial"> Negro</label>
		
		</div>

		<?php

		foreach ($redSocial as $key => $value){

			echo '<div class="form-group row">

					<div class="col-xs-8">
				
						<div class="input-group">

							<span class="input-group-addon"><i class="fa '.$value["red"].' '.$value["estilo"].' redSocial"></i></span>

							<input type="text" class="form-control input-lg cambiarUrlRed" value="'.$value["url"].'">

						</div>

					</div>

					<div class="col-xs-2">';

					if($value["activo"] != 0){

						echo '<input type="checkbox" class="seleccionarRed" ruta="'.$value["url"].'" red="'.$value["red"].'" estilo="'.$value["estilo"].'" validarRed="'.$value["red"].'" checked>';

					}else{

						echo '<input type="checkbox" class="seleccionarRed" ruta="'.$value["url"].'" red="'.$value["red"].'" estilo="'.$value["estilo"].'" validarRed="">';

					}

					echo '</div>

				</div>';

		}

		?>

		<input type="hidden" id="valorRedesSociales" value="<?php echo $plantilla["redesSociales"]; ?>">	

 	</div>

 	<div class="box-footer">
      
    	<button type="button" id="guardarRedesSociales" class="btn btn-primary pull-right">Guardar</button>
    
	</div>

</div>

