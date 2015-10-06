<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-header">
        <h1>Lista <small>Usuarios</small></h1>
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
      <a href="<?php echo base_url();?>index.php/usuario/crear" class="btn btn-success btn-sm pull-right" href="">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;Crear Usuario
      </a>
		</div>
	</div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    	<table class="table tbl-datatable" id="lista-usuarios">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
            <th>Email</th>
						<th>Domicilio</th>
						<th>Telefono</th>
						<th>Estatus</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
		              if ($usuarios !== FALSE) {
		                foreach ($usuarios as $fila) {
		                  ?>
		                  <tr>
		                  	 <td>
		                      <?php echo  $fila->id ?>
		                    </td>
		                    <td>
		                      <?php echo  $fila->nombre.' '.$fila->ape_paterno.' '.$fila->ape_materno ?>
		                    </td>
                        <td>
                         <?php echo  $fila->correo ?>
                       </td>
		                    <td>
		                      <?php echo  $fila->domicilio.' - '.$fila->colonia.' - '.$fila->ciudad  ?>
		                    </td>
                        <td>
                         <?php echo  $fila->telefono ?>
                       </td>
		                     <td>
		                     <?php if ( $fila->activo == 1){ ?>
		                       <span class="label label-success"> Activo </span>
		                   		<?php }elseif ($fila->activo == 0) { ?>

		                      <span class="label label-danger"> No Activo</span>
		                     <?php }?>
		                    </td>

		                    <td>
		                    	<?php echo anchor('usuario/editar/'.$fila->id,'Editar',array('class' => 'btn btn-warning btn-xs')) ?>
                          <?php echo anchor('usuario/listaeventos/'.$fila->id,'Ver Eventos',array('class' => 'btn btn-info btn-xs')) ?>
		                    </td>
		                  </tr>

		                  <?php
		                }
		              }
            		?>
				</tbody>
				<tfoot>
          <th>Id</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Domicilio</th>
          <th>Telefono</th>
          <th>Estatus</th>
          <th>Opciones</th>
				</tfoot>
			</table>
    	</div>
    </div>
</div>
<script>
  salon.eventos.tabla_listas();
</script>
