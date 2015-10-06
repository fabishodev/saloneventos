<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="page-header">
				<h1>Crear <small>Evento Usuario</small></h1>
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
	  <div class="col-sm-6">
	  		<form id="form_mensaje" method="post" action="<?php echo base_url();?>index.php/usuario/creareventousuario">
	  		<div class="form-group">
					<label for="sel-evento" class="control-label">Evento:</label><br>
      				<select class="form-control" id="sel-evento" name="sel-evento" required>
      					<option value="">Seleccione</option>
      					<?php foreach ($eventos as $e) { ?>
      						<option value="<?php echo $e->id;?>"><?php echo $e->nombre_evento;?></option>
      					<?php }?>
      				</select>

	  		</div>
				<div class="form-group">
					<label for="fecha-inicio-evento" class="control-label">Fecha inicio del Evento:</label><br>
					<input class="form-control" type="text" id="fecha-inicio-evento" name="fecha-inicio-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Fecha inicio del evento." value="" required>
				</div>
				<div class="form-group">
					<label for="fecha-fin-evento" class="control-label">Fecha fin del Evento:</label><br>
					<input class="form-control" type="text" id="fecha-fin-evento" name="fecha-fin-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Fecha fin del evento." value="" required>
				</div>
				<div class="form-group">
				<label for="hora-inicio-evento" class="control-label">Hora inicio del Evento:</label><br>
				<input class="form-control" type="text" id="hora-inicio-evento" name="hora-inicio-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Hora inicio del evento." value="" required>
			</div>
			<div class="form-group">
				<label for="hora-fin-evento" class="control-label">Hora fin del Evento:</label><br>
				<input class="form-control" type="text" id="hora-fin-evento" name="hora-fin-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Hora fin del evento." value="" required>
			</div>
			<div class="form-group">
					<label for="observacion-evento" class="control-label">Observación del Evento:</label><br>
					<textarea class="form-control" rows="3" id="observacion-evento" name="observacion-evento" data-container="body" data-toggle="popover" data-placement="left" data-content="Observación del evento"  value=""></textarea>
				</div>
				<div class=" form-group">
					<button type="submit" class="btn btn-success">Crear</button>
					<?php echo anchor ('usuario/listaeventos/'.$this->session->userdata('id_usuario'),'Regresar a lista', array('class'=>'btn btn-primary')) ?>
				</div>
	  	</form>
	  </div>
	</div>
</div>
<script>
$(document).ready(function () {
	$( "#fecha-inicio-evento" ).datepicker();
	$( "#fecha-fin-evento" ).datepicker();
});
</script>
