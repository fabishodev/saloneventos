<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>Editar <small>Evento</small></h1>
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
		<div class="col-lg-6">
			<form id="form_mensaje" method="post" action="<?php echo base_url();?>index.php/evento/editarevento/<?php echo $evento->id ?>">
				<div class="form-group">
					<label for="id-evento" class="control-label">id del Evento:</label><br>
					<input class="form-control" type="text" id="id-evento" name="id-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Id del evento." value="<?php echo $evento->id ?>" readonly>
				</div>
				<div class="form-group">
					<label for="nombre-evento" class="control-label">Nombre del Evento:</label><br>
					<input class="form-control" type="text" id="nombre-evento" name="nombre-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Nombre del evento." value="<?php echo $evento->nombre_evento ?>" required>
				</div>
				<div class="form-group">
					<label for="descripcion-evento" class="control-label">Descripción del Evento:</label><br>
					<textarea class="form-control" rows="3" id="descripcion-evento" name="descripcion-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Descripción del evento"  value="" required><?php echo $evento->descripcion ?></textarea>
				</div>

				<div class="form-group">
					<label for="estatus-evento" class="control-label">Estatus:</label><br>
					<select class="form-control" id="estatus-evento" name="estatus-evento">
						<option value="1">Activo</option>
						<option value="0">No Activo</option>

					</select>
				</div>

        <div class="form-group">
          <label for="fecha-creado" class="control-label">Fecha Creado:</label><br>
          <input class="form-control" type="text" id="fecha-creado" name="fecha-creado" data-container="body" data-toggle="popover" data-placement="left" data-content="Fecha creado" value="<?php echo $evento->fecha_creado ?>" readonly>
        </div>

      <?php if ($evento->fecha_actualizado != '') {?>
        <div class="form-group">
          <label for="fecha-actualizado" class="control-label">Fecha Actualizado:</label><br>
          <input class="form-control" type="text" id="fecha-actualizado" name="fecha-actualizado" data-container="body" data-toggle="popover" data-placement="left" data-content="Fecha actualizado" value="<?php echo $evento->fecha_actualizado?>" readonly>
        </div>
    <?php   } ?>
				<div class=" form-group">
					<button type="submit" class="btn btn-success">Editar</button>
					<?php echo anchor ('evento/lista','Regresar a lista', array('class'=>'btn btn-primary')) ?>
				</div>

			</form>
		</div>
	</div>
</div>
