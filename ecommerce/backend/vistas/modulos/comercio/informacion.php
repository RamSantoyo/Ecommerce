<?php

$comercio = ControladorComercio::ctrSeleccionarComercio();

?>

<div class="box box-info">
	
	<div class="box-header with-border">
		
		 <h3 class="box-title">INFORMACIÓN DEL COMERCIO</h3>

		 <div class="box-tools pull-right">

      		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

        		<i class="fa fa-minus"></i>

        	</button>

        </div>

	</div>

	<div class="box-body formularioInformacion">

		<!-- IMPUESTO -->

		<div class="form-group">
	      
	      <label for="usr">Impuesto:</label>
	      
	      <div class="input-group">
	        
	        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
	        <input type="number" min="1" class="form-control cambioInformacion" id="impuesto" value="<?php echo $comercio["impuesto"]; ?>">

	      </div>
	    
	    </div>

	    <!-- ENVÍO NACIONAL -->

	    <div class="form-group">
      
	      <label for="usr">Envío Nacional:</label>
	      
	      <div class="input-group">
	        
	        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
	        <input type="number" min="1" class="form-control cambioInformacion" id="envioNacional" value="<?php echo $comercio["envioNacional"]; ?>">

	      </div>
	    
	    </div>

	    <!-- ENVÍO INTERNACIONAL -->

     	<div class="form-group">
      
	      <label for="usr">Envío Internacional:</label>
	      
	      <div class="input-group">
	        
	        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
	        <input type="number" min="1" class="form-control cambioInformacion" id="envioInternacional" value="<?php echo $comercio["envioInternacional"]; ?>">

	      </div>
	    
	    </div>

	    <!-- TASA MÍNIMA NACIONAL -->

	    <div class="form-group">
      
	      <label for="usr">Tasa Mínima Nacional:</label>
	      
	      <div class="input-group">
	        
	        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
	        <input type="number" min="1" class="form-control cambioInformacion" id="tasaMinimaNal" value="<?php echo $comercio["tasaMinimaNal"]; ?>">

	      </div>
	    
	    </div>

		<!-- TASA MÍNIMA INTERNACIONAL -->

	 	<div class="form-group">
      
	      <label for="usr">Tasa Mínima Internacional:</label>
	      
	      <div class="input-group">
	        
	        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
	        <input type="number" min="1" class="form-control cambioInformacion" id="tasaMinimaInt" value="<?php echo $comercio["tasaMinimaInt"]; ?>">

	      </div>
	    
	    </div>

	    <!-- SELECCIONAR PAÍS -->

	    <div class="form-group">
      
	      <label for="sel1">Seleccione País:</label>

	      <input type="hidden" id="codigoPais" value="<?php echo $comercio["pais"]; ?>">
	      
	      <select class="form-control cambioInformacion" id="seleccionarPais">

	      	<option id="paisSeleccionado"></option>
	       
	      </select>

	    </div>

	    <!-- PASARELA DE PAGO PAYPAL -->

	    <div class="panel panel-default">
	    	
			<div class="panel-heading">

      			<h4 class="text-uppercase">Configuración Paypal</h4>

      		</div>
			
			<div class="panel-body">
				
				<div class="form-group row">
					
					 <div class="col-xs-3">
					 	
						<label>Modo:</label>

						 <?php

      					if($comercio["modoPaypal"] == "sandbox"){

      						echo '	<label class="checkbox">

      									<input class="cambioInformacion" type="radio" value="sandbox" name="modoPaypal" checked>  

      									Sandbox

      								</label>
              					
          							<label class="checkbox">

          								<input class="cambioInformacion" type="radio" value="live" name="modoPaypal"> 

          								Live

          							</label>';
      					}else{

      						echo '	<label class="checkbox">

      									<input class="cambioInformacion" type="radio" value="sandbox" name="modoPaypal">  

      									Sandbox

      								</label>
              					
          							<label class="checkbox">

          								<input class="cambioInformacion" type="radio" value="live" name="modoPaypal" checked> 

          								Live

          							</label>';


      					}

      					?>

					 </div>

					 <div class="col-xs-4">
            
            			<label for="comment">Cliente:</label>
      
            			<input type="text" class="form-control cambioInformacion" id="clienteIdPaypal" value="<?php echo $comercio["clienteIdPaypal"]; ?>">

          			</div>

      			 	<div class="col-xs-5">

		            	<label for="comment">Llave Secreta:</label>
		      
		            	<input type="text" class="form-control cambioInformacion" id="llaveSecretaPaypal" value="<?php echo $comercio["llaveSecretaPaypal"]; ?>">

		          </div>

				</div>

			</div>

	    </div>

	    <!-- PASARELA DE PAGO PAYU -->

		<div class="panel panel-default">
    
	  		<div class="panel-heading">

	      		<h4 class="text-uppercase">Configuración Payu Latam</h4>

	      	</div>

	      	<div class="panel-body">

	        	<div class="form-group row">
	          
	          		<div class="col-xs-3">

	          			<label>Modo:</label>
	            
				             <?php

				          if($comercio["modoPayu"] == "sandbox"){

				            echo '<label class="checkbox"><input class="cambioInformacion" type="radio" value="sandbox" name="modoPayu" checked>  Sandbox</label>
				              <label class="checkbox"><input class="cambioInformacion" type="radio" value="live" name="modoPayu"> Live</label>';
				          
				          }else{

				            echo '<label class="checkbox"><input class="cambioInformacion" type="radio" value="sandbox" name="modoPayu">  Sandbox</label>
				              <label class="checkbox"><input class="cambioInformacion" type="radio" value="live" name="modoPayu" checked> Live</label>';

				          }

				          ?>

	          		</div>
	          
		          	<div class="col-xs-3">
		            
		            	<label for="comment">Merchant Id:</label>
		      
		            	<input type="text" class="form-control cambioInformacion" id="merchantIdPayu" value="<?php echo $comercio["merchantIdPayu"]; ?>" >

		          	</div>
	          
	          		<div class="col-xs-3">

	        			<label for="comment">Account Id:</label>
	      
	            		<input type="text" class="form-control cambioInformacion" id="accountIdPayu" value="<?php echo $comercio["accountIdPayu"]; ?>">

	     		 	</div>

	      			<div class="col-xs-3">

	            		<label for="comment">Api Key:</label>
	      
	             		<input type="text" class="form-control cambioInformacion" id="apiKeyPayu" value="<?php echo $comercio["apiKeyPayu"]; ?>">

	          		</div>

	        	</div>

	      	</div>

    	</div>
		
	</div>

  	<div class="box-footer">
      
    	<button type="button" id="guardarInformacion" class="btn btn-primary pull-right">Guardar</button>
    
 	</div>

</div>