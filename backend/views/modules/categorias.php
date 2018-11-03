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
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" name="pClavesCategoria" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsInput" placeholder="Ingresar palabras claves" required>
              </div>
            </div>
            <div class="form-group">
              <div class="panel">SUBIR FOTO PORTADA</div>
              <input type="file" name="fotoPortada" class="fotoPortada">
              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>
              <img src="views/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">
            </div>
            <div class="form-group">
              <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>
              </select>
            </div>
            <div class="datosOferta" style="display: none;">
              <div class="form-group row">
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg valorOferta" id="precioOferta" name="precioOferta" min="0" step="any" placeholder="Precio">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg valorOferta" id="descuentoOferta" name="descuentoOferta" min="0" placeholder="Descuento">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date">
                  <input type="text" name="finOferta" class="form-control datepicker input-lg valorOferta">
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <div class="panel">SUBIR FOTO OFERTA</div>
                <input type="file" name="fotoOferta" class="fotoOferta">
                <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>
                <img src="views/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar categoría</button>
          </div>
        </form>
        <?php  
          $crearCategoria = new CategoriesController();
          $crearCategoria->createCategory();
        ?>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEditarCategoria">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8dbc; color: white">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Editar categoría</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" name="editarTituloCategoria" class="form-control input-lg validarCategoria tituloCategoria" placeholder="Ingresar Categoría" required>
                <input type="hidden" name="editarIdCategoria" class="editarIdCategoria">
                <input type="hidden" name="editarIdCabecera" class="editarIdCabecera">
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
                <textarea maxlength="120" class="form-control input-lg descripcionCategoria" name="descripcionCategoria" rows="3" placeholder="Ingresar descripción categoría" required></textarea>
              </div>
            </div>
            <div class="form-group editarPalabrasClaves">
              
            </div>
            <!-- <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" name="pClavesCategoria" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsInput" placeholder="Ingresar palabras claves" required>
              </div>
            </div> -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO PORTADA</div>
              <input type="file" name="fotoPortada" class="fotoPortada">
              <input type="hidden" name="antiguaFotoPortada" class="antiguaFotoPortada">
              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>
              <img src="views/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">
            </div>
            <div class="form-group">
              <select name="selActivarOferta" class="form-control input-lg selActivarOferta">
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>
              </select>
            </div>
            <div class="datosOferta" style="display: none;">
              <div class="form-group row">
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                    <input type="number" class="form-control input-lg valorOferta" id="precioOferta" name="precioOferta" min="0" step="any" placeholder="Precio">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg valorOferta" id="descuentoOferta" name="descuentoOferta" min="0" placeholder="Descuento">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date">
                  <input type="text" name="finOferta" class="form-control datepicker input-lg valorOferta finOferta">
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <div class="panel">SUBIR FOTO OFERTA</div>
                <input type="file" name="fotoOferta" class="fotoOferta">
                <input type="hidden" name="antiguaFotoOferta" class="antiguaFotoOferta">
                <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>
                <img src="views/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar categoría</button>
          </div>
        </form>
        <?php  
          $editarCategoria = new CategoriesController();
          $editarCategoria->editCategory();
        ?>
      </div>
    </div>
  </div>
  <?php  
    $eliminarCategoria = new CategoriesController();
    $eliminarCategoria->deleteCategory();
  ?>
  <!-- BLOUEO DE LA TECLA ENTER -->
  <script>
    $(document).keydown(function(e){
      if (e.keyCode == 13) {
        e.preventDefault()
      }
    })
  </script>