<?php

if($_SESSION["perfil"] != "administrador"){

	return;	

}

$notificaciones = ControladorNotificaciones::ctrMostrarNotificaciones();

$totalNotificaciones = $notificaciones["nuevosUsuarios"] + $notificaciones["nuevasVentas"] + $notificaciones["nuevasVisitas"];

?>

<!--=====================================
NOTIFICACIONES
======================================-->

<!-- notifications-menu -->
<li class="dropdown notifications-menu">
	
	<!-- dropdown-toggle -->
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		
		<i class="fa fa-bell-o"></i>
		
		<span class="label label-warning"><?php  echo $totalNotificaciones; ?></span>
	
	</a>
	<!-- dropdown-toggle -->

	<!--dropdown-menu -->
	<ul class="dropdown-menu">

		<li class="header">Tu tienes <?php  echo $totalNotificaciones; ?> notificaciones</li>

		<li>
			<!-- menu -->
			<ul class="menu">

				<!-- usuarios -->
				<li>
				
					<a href="" class="actualizarNotificaciones" item="nuevosUsuarios">
					
						<i class="fa fa-users text-aqua"></i> <?php  echo $notificaciones["nuevosUsuarios"] ?> nuevos usuarios registrados
					
					</a>

				</li>

				<!-- ventas -->
				<li>
				
					<a href="" class="actualizarNotificaciones" item="nuevasVentas">
					
						<i class="fa fa-shopping-cart text-aqua"></i> <?php  echo $notificaciones["nuevasVentas"] ?> nuevas ventas
					
					</a>

				</li>
				
				<!-- visitas -->
				<li>
				
					<a href="" class="actualizarNotificaciones" item="nuevasVisitas">
					
						<i class="fa fa-map-marker text-aqua"></i> <?php  echo $notificaciones["nuevasVisitas"] ?> nuevas visitas
					
					</a>

				</li>

			</ul>
			<!-- menu -->

		</li>

	</ul>
	<!--dropdown-menu -->

</li>
<!-- notifications-menu -->	