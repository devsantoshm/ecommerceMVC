<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor Categorias
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Gestor Categorias</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
            Agregar categoría
          </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Categoría</th>
                <th>Ruta</th>
                <th>Estado</th>
                <th>Descripción</th>
                <th>Palabras Claves</th>
                <th>Portada</th>
                <th>Tipo de Oferta</th>
                <th>Valor Oferta</th>
                <th>Imagen Oferta</th>
                <th>Fin Oferta</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

  <!-- MODAL AGREGAR CATEGORIA -->
  <div class="modal fade" id="modalAgregarCategoria">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8dbc; color: white">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Agregar categoría</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" name="tituloCategoria" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoría" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-link"></i></span>
                <input type="text" name="rutaCategoria" class="form-control input-lg rutaCategoria" placeholder="Ruta url para la categoría" readonly required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <textarea maxlength="120" class="form-control input-lg" name="descripcionCategoria" rows="3" placeholder="Ingresar descripción categoría" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar categoría</button>
          </div>
        </form>
      </div>
    </div>
  </div>