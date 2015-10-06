<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>Nuevo <small>Evento</small></h1>
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
			<form id="form-crear-evento" method="post" action="<?php echo base_url();?>index.php/evento/crearevento">
				<div class="form-group">
					<label for="nombre-evento" class="control-label">Nombre del Evento:</label><br>
					<input class="form-control" type="text" id="nombre-evento" name="nombre-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Nombre del evento." value="" required>
				</div>
				<div class="form-group">
					<label for="descripcion-evento" class="control-label">Descripción del Evento:</label><br>
					<textarea class="form-control" rows="3" id="descripcion-evento" name="descripcion-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Descripción del evento"  value="" required></textarea>
				</div>
				<div class=" form-group">
					<button type="submit" class="btn btn-success">Crear</button>
					<?php echo anchor ('evento/lista','Regresar a lista', array('class'=>'btn btn-primary')) ?>
				</div>
			</form>
		</div>
	</div>
</div>
