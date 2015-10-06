<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>Editar <small>Usuario</small></h1>
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
			<form id="form-editar-usuario" method="post" action="<?php echo base_url();?>index.php/usuario/editarusuario/<?php echo $usuario->id ?>">
				<div class="form-group">
					<label for="id-usuario" class="control-label">id del Usuario:</label><br>
					<input class="form-control" type="text" id="id-usuario" name="id-usuario" data-container="body" data-toggle="popover" data-placement="left" data-content="Id del usuario." value="<?php echo $usuario->id ?>" readonly>
				</div>
        <div class="form-group">
          <label for="correo-usuario" class="control-label">Correo:</label><br>
          <input class="form-control" type="text" id="correo-usuario" name="correo-usuario" data-container="body" data-toggle="popover" data-placement="left" data-content="nombre" value="<?php echo $usuario->correo ?>" >
        </div>
        <div class="form-group">
					<label for="nombre-usuario" class="control-label">Nombre:</label><br>
					<input class="form-control" type="text" id="nombre-usuario" name="nombre-usuario" data-container="body" data-toggle="popover" data-placement="left" data-content="nombre-usuario" value="<?php echo $usuario->nombre ?>" >
				</div>
        <div class="form-group">
          <label for="ape-paterno" class="control-label">Apellido Paterno:</label><br>
          <input class="form-control" type="text" id="ape-paterno" name="ape-paterno" data-container="body" data-toggle="popover" data-placement="left" data-content="ape-paterno" value="<?php echo $usuario->ape_paterno ?>" >
        </div>
        <div class="form-group">
          <label for="ape-materno" class="control-label">Apellido Materno:</label><br>
          <input class="form-control" type="text" id="ape-materno" name="ape-materno" data-container="body" data-toggle="popover" data-placement="left" data-content="ape-materno" value="<?php echo $usuario->ape_materno ?>" >
        </div>
        <div class="form-group">
          <label for="domicilio" class="control-label">Domicilio:</label><br>
          <input class="form-control" type="text" id="domicilio" name="domicilio" data-container="body" data-toggle="popover" data-placement="left" data-content="domicilio" value="<?php echo $usuario->domicilio ?>" >
        </div>
        <div class="form-group">
          <label for="colonia" class="control-label">Colonia:</label><br>
          <input class="form-control" type="text" id="colonia" name="colonia" data-container="body" data-toggle="popover" data-placement="left" data-content="colonia" value="<?php echo $usuario->colonia ?>" >
        </div>
        <div class="form-group">
          <label for="ciudad" class="control-label"> Ciudad:</label><br>
          <input class="form-control" type="text" id="ciudad" name="ciudad" data-container="body" data-toggle="popover" data-placement="left" data-content="ciudad" value="<?php echo $usuario->ciudad ?>" >
        </div>
        <div class="form-group">
          <label for="telefono" class="control-label">Teléfono:</label><br>
          <input class="form-control" type="text" id="telefono" name="telefono" data-container="body" data-toggle="popover" data-placement="left" data-content="telefono" value="<?php echo $usuario->telefono ?>" >
        </div>
				<div class="form-group">
					<label for="estatus-usuario" class="control-label">Estatus:</label><br>
					<select class="form-control" id="estatus-usuario" name="estatus-usuario">
						<option value="1">Activo</option>
						<option value="0">No Activo</option>

					</select>
				</div>

        <div class="form-group">
          <label for="fecha-creado" class="control-label">Fecha Creado:</label><br>
          <input class="form-control" type="text" id="fecha-creado" name="fecha-creado" data-container="body" data-toggle="popover" data-placement="left" data-content="Fecha creado" value="<?php echo $usuario->fecha_creado ?>" readonly>
        </div>

      <?php if ($usuario->fecha_actualizado != '') {?>
        <div class="form-group">
          <label for="fecha-actualizado" class="control-label">Fecha Actualizado:</label><br>
          <input class="form-control" type="text" id="fecha-actualizado" name="fecha-actualizado" data-container="body" data-toggle="popover" data-placement="left" data-content="Fecha actualizado" value="<?php echo $usuario->fecha_actualizado?>" readonly>
        </div>
    <?php   } ?>
				<div class=" form-group">
					<button type="submit" class="btn btn-success">Editar</button>
					<?php echo anchor ('usuario/lista','Regresar a lista', array('class'=>'btn btn-primary')) ?>
				</div>

			</form>
		</div>
	</div>
</div>
