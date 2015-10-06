<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Invitado</h4>
      </div>
      <div class="modal-body">
        <form id="form-agregar-invitado" class="" action="<?php echo base_url();?>index.php/usuario/agregarInvitado" method="post" >
            <div class="form-group">
              <label for="nombre-invitado">Nombre Invitado</label>
              <input type="text" class="form-control" id="nombre-invitado" name = "nombre-invitado" placeholder="" required="">
              <p class="help-block">Nombre completo de invitado.</p>
            </div>
            <div class="form-group">
              <label for="mesa">Mesa</label>
              <input type="text" class="form-control" id="mesa" name="mesa" placeholder="" required="">
              <p class="help-block">Numero o referencia de mesa.</p>
            </div>
            <div class="form-group">
              <label for="num-acompaniantes">Numero de Acompañantes</label>
              <input type="text" class="form-control" id="num-acompaniantes" name="num-acompaniantes" placeholder="" required="">

            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1>Detalle <small>Evento Usuario</small></h1>
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
    <div class="col-sm-12">
      <?php if ($danger != '') { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php echo $danger ?></strong>
        </div>
      <?php $this->session->set_userdata('danger', '');} ?>
    </div>
  </div>

  <div class="row">
		<div class="col-lg-12">
      <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar Invitado
      </button>
		</div>
	</div>
  <div class="row">
    <div class="col-lg-3">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $detalle_evento->nombre_evento; ?></h3>
  </div>
  <div class="panel-body">
    <p><strong>Fecha Inicio:</strong> <?php echo $detalle_evento->fecha_inicio ?></p>
    <p><strong>Fecha Fin:</strong> <?php echo $detalle_evento->fecha_fin ?></p>
    <p><strong>Hora Inicio:</strong> <?php echo $detalle_evento->hora_inicio ?></p>
    <p><strong>Hora Fin:</strong> <?php echo $detalle_evento->hora_fin ?></p>
    <p><strong>Observación:</strong>
<br>
<?php echo $detalle_evento->observacion?>
    </p>
  </div>
</div>
</div>
<br>
  <div class="col-lg-9">
    <table class="table tbl-datatable" id="lista-invitados">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Mesa</th>
          <th>Num Acompañantes</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
                if ($invitados !== FALSE) {
                  foreach ($invitados as $fila) {
                    ?>
                    <tr>
                       <td>
                        <?php echo  $fila->nombre_invitado ?>
                      </td>
                      <td>
                        <?php echo  $fila->mesa ?>
                      </td>
                      <td>
                       <?php echo  $fila->num_acompaniantes ?>
                     </td>


                      <td>
                        <?php echo anchor('usuario/eliminarinvitado/'.$fila->id,'Eliminar',array('class' => 'btn btn-danger btn-xs eliminar-fila')) ?>
                      </td>
                    </tr>

                    <?php
                  }
                }
              ?>
      </tbody>
      <tfoot>
        <th>Nombre</th>
        <th>Mesa</th>
        <th>Num Acompañantes</th>
        <th>Opciones</th>
      </tfoot>
    </table>
  </div>
</div>
<?php echo anchor ('usuario/listaeventos/'.$this->session->userdata('id_usuario'),'Regresar a lista', array('class'=>'btn btn-primary')) ?>
</div>
<script>
  salon.eventos.tabla_listas();
  salon.eventos.alerta_eliminar();
</script>
