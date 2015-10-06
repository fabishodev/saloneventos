<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="page-header">
        <h1>Crear <small>Usuario</small></h1>
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
        <div class="col-xs-6">
        <?php if ($danger != '') { ?>

           <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><?php echo $danger ?></strong>
</div>
        <?php $this->session->set_userdata('danger', '');} ?>
      </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <form id="form-crear-usuario" class="" action="<?php echo base_url();?>index.php/usuario/crearusuario" method="post">
            <label for="usuario-password">Contraseña</label>
            <input id="usuario-password" type="text" name="usuario-password" value="<?php echo $pass; ?>" class="form-control" required>
            <label for="usuario-correo">Correo Electronico</label>
            <input id="usuario-correo" type="email" name="usuario-correo" value="" class="form-control" required>
            <label for="nombre-usuario">Nombre</label>
            <input id="nombre-usuario" type="text" name="nombre-usuario" value="" class="form-control" required>
            <label for="ape-paterno">Apellido Paterno</label>
            <input id="ape-paterno" type="text" name="ape-paterno" value="" class="form-control" required>
            <label for="ape-materno">Apellido Materno</label>
            <input id="ape-materno" type="text" name="ape-materno" value="" class="form-control" required>
            <label for="domicilio">Domicilio</label>
            <input id="domicilio" type="text" name="domicilio" value="" class="form-control" required>
            <label for="colonia">Colonia</label>
            <input id="colonia" type="text" name="colonia" value="" class="form-control" required>
            <label for="ciudad">Ciudad</label>
            <input id="ciudad" type="text" name="ciudad" value="" class="form-control" required>
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="text" name="telefono" value="" class="form-control" required>
            <br>
            <input type="submit" name="name" value="Crear" class="btn btn-success">
            <?php echo anchor ('usuario/lista','Regresar a lista', array('class'=>'btn btn-primary')) ?>

          </form>

        </div>

      </div>

    </div>
