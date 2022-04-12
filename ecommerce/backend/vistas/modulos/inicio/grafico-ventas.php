<?php

error_reporting(0);
$ventas = ControladorVentas::ctrMostrarVentas();
$totalVentas = ControladorVentas::ctrMostrarTotalVentas();

$arrayFechas = array();
$arrayFechaPago = array();
$totalPaypal = 0;

foreach ($ventas as $key => $value) {

	/*=============================================
  	PORCENTAJES MÉTODOS DE PAGO PAYPAL
  	=============================================*/
  	if($value["metodo"] == "paypal"){

  		 $totalPaypal += $value["pago"];

  		 $porcentajePaypal = $totalPaypal * 100 / $totalVentas["total"];
  	}

  	/*=============================================
  	PORCENTAJES MÉTODOS DE PAGO PAYU
  	=============================================*/
  	if($value["metodo"] == "payu"){

  		 $totalPayu += $value["pago"];

  		 $porcentajePayu = $totalPayu * 100 / $totalVentas["total"];
  	}

	/*=============================================
  	GRÁFICA EN LÍNEA
  	=============================================*/
	
	if($value["metodo"] != "gratis"){

		#Capturamos sólo el año y el mes
		$fecha = substr($value["fecha"],0,7);

		#Capturamos las fechas en un array
		array_push($arrayFechas, $fecha);

		#Capturamos las fechas y los pagos en un mismo array
		$arrayFechaPago = array($fecha => $value["pago"]);

		#Sumamos los pagos que ocurrieron el mismo mes
		foreach ($arrayFechaPago as $key => $value) {
			
			$sumaPagosMes[$key] += $value;
		}

	}



}

#Evitamos repetir fecha
$noRepetirFechas = array_unique($arrayFechas);

?>


<!--=====================================
GRÁFICO DE VENTAS
======================================-->
<!-- solid sales graph -->
<div class="box box-solid bg-teal-gradient">

	<!-- box-header -->
	<div class="box-header">

		<i class="fa fa-th"></i>

	    <h3 class="box-title">Gráfico de Ventas</h3>

	    <div class="box-tools pull-right">
	      
	      <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
	      </button>

	    </div>

	</div>
	<!-- box-header -->

	<!-- box-body -->
	<div class="box-body border-radius-none">

		<div class="chart" id="line-chart" style="height: 250px;"></div>

	</div>
	<!-- box-body -->

	<!-- box-footer -->
  	<div class="box-footer no-border">

	  	<!-- row -->
	    <div class="row">
	    
	      <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
	    
	        <input type="text" class="knob" data-readonly="true" value="<?php echo round($porcentajePaypal); ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">

	        <div class="knob-label">Paypal</div>
	      
	      </div>

	      <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
	        
	        <input type="text" class="knob" data-readonly="true" value="<?php echo round($porcentajePayu); ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">

	        <div class="knob-label">Payu</div>
	      
	      </div>

	    </div>
	    <!-- row -->

  	</div>
  	<!-- box-footer -->

</div>
<!-- solid sales graph -->

<script>
	
var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [

    <?php

    	foreach ($noRepetirFechas as $value) {
    	
    	echo "{ y: '".$value."', ventas: ".$sumaPagosMes[$value]." },";
    		
    	}

      echo "{ y: '".$value."', ventas: ".$sumaPagosMes[$value]." }";

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['Ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits		 : '$',
    gridTextSize     : 10
  });
	
</script>