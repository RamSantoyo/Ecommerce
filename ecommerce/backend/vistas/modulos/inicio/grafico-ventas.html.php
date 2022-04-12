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
	    
	        <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

	        <div class="knob-label">Paypal</div>
	      
	      </div>

	      <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
	        
	        <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

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
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
	
</script>