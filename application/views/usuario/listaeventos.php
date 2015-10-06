<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>Lista <small> Eventos Usuario</small></h1>
			</div>
		</div>
	</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <p class="navbar-text">Bienvenido, <strong><?php echo $this->session->userdata('nombre_completo') ?></strong></p>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <?php  if ($this->session->userdata('tipo_usuario')==0) {?>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><?php echo anchor('usuario/lista','Lista'); ?></li>
          <li><?php echo anchor('usuario/crear','Crear'); ?></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Eventos <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><?php echo anchor('evento/lista','Lista'); ?></li>
          <li><?php echo anchor('evento/crear','Crear'); ?></li>
        </ul>
      </li>
    </ul>
    <?php  }?>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><?php echo anchor('usuario/listaeventos/'.$this->session->userdata('id_usuario'),'Mis Eventos'); ?></li>
        </ul>
      </li>
      <li><?php echo anchor('usuario/salir','Salir'); ?></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>
<div class="container">

  <div class="row">
		<div class="col-lg-12">
    <?php if ($this->session->userdata('tipo_usuario') != 1) { ?>
			<a href="<?php echo base_url();?>index.php/usuario/crearevento" class="btn btn-success btn-sm pull-right" href="">
				<span class="glyphicon glyphicon-plus"></span>&nbsp;Crear Evento Usuario
			</a>

		<?php  } ?>
		</div>
	</div>
<br>
    <div class="row">
      <div class="col-lg-12">
        <?php  if ($eventos_usuario !== FALSE) { ?>
      	<table class="table tbl-datatable" id="lista-eventos">
  				<thead>
  					<tr>
  						<th>Id</th>
  						<th>Evento</th>
              <th>Fecha Inicio</th>
  						<th>Fecha Fin</th>
  						<th>Opciones</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php
  		              if ($eventos_usuario !== FALSE) {
  		                foreach ($eventos_usuario as $fila) {
  		                  ?>
  		                  <tr>
  		                  	 <td>
  		                      <?php echo  $fila->id ?>
  		                    </td>
  		                    <td>
  		                      <?php echo  $fila->nombre_evento ?>
  		                    </td>
                          <td>
                           <?php echo  $fila->fecha_inicio ?>
                         </td>
  		                    <td>
  		                      <?php echo  $fila->fecha_fin  ?>
  		                    </td>
                          <td>
  		                    	<?php echo anchor('usuario/detalle/'.$fila->id,'Detalle Evento',array('class' => 'btn btn-info btn-xs')) ?>
														<?php  if ($this->session->userdata('tipo_usuario')==0) {?>
			                        <?php echo anchor('usuario/eliminareventousuario/'.$fila->id,'Eliminar',array('class' => 'btn btn-danger btn-xs eliminar-fila')) ?>
															<?php  }?>
  		                    </td>
  		                  </tr>

  		                  <?php
  		                }
  		              }
              		?>
  				</tbody>
  				<tfoot>
            <th>Id</th>
            <th>Evento</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Opciones</th>
  				</tfoot>
  			</table>
        <?php } else { ?>
          <p>Ningun evento creado.</p>
          <?php  } ?>
      	</div>
      </div>
			<?php if ($this->session->userdata('tipo_usuario') != 1) { ?>
      <?php echo anchor ('usuario/lista','Regresar a lista', array('class'=>'btn btn-primary')) ?>
			<?php } ?>

</div>
<script>
  salon.eventos.tabla_listas();
  salon.eventos.alerta_eliminar();
</script>
