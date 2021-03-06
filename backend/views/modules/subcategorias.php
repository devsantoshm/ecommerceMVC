<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor SubCategorias
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Gestor SubCategorias</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubCategoria">
            Agregar subcategoría
          </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablaSubCategorias" width="100%">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>SubCategoría</th>
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

  <!-- MODAL AGREGAR SUBCATEGORIA -->
  <div class="modal fade" id="modalAgregarSubCategoria">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8dbc; color: white">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Agregar subcategoría</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" name="tituloSubCategoria" class="form-control input-lg validarSubCategoria tituloSubCategoria" placeholder="Ingresar SubCategoría" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-link"></i></span>
                <input type="text" name="rutaSubCategoria" class="form-control input-lg rutaSubCategoria" placeholder="Ruta url para la subcategoría" readonly required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
                  <option value="">Seleccionar categoría</option>
                  <?php
                  $item = null;
                  $valor = null; 

                  $categorias = CategoriesController::showCategories($item, $valor);
                  foreach ($categorias as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <textarea maxlength="120" class="form-control input-lg" name="descripcionSubCategoria" rows="3" placeholder="Ingresar descripción subcategoría" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" name="pClavesSubCategoria" class="form-control input-lg pClavesSubCategoria tagsInput" data-role="tagsInput" placeholder="Ingresar palabras claves" required>
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
            <button type="submit" class="btn btn-primary">Guardar subcategoría</button>
          </div>
        </form>
        <?php  
          $crearSubCategoria = new SubCategoriesController();
          $crearSubCategoria->createSubCategory();
        ?>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEditarSubCategoria">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #3c8dbc; color: white">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Editar subcategoría</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" name="editarTituloSubCategoria" class="form-control input-lg validarSubCategoria tituloSubCategoria" required>
                <input type="hidden" name="editarIdSubCategoria" class="editarIdSubCategoria">
                <input type="hidden" name="editarIdCabecera" class="editarIdCabecera">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-link"></i></span>
                <input type="text" name="rutaSubCategoria" class="form-control input-lg rutaSubCategoria" readonly required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg seleccionarCategoria" name="seleccionarCategoria" required>
                  <option class="optionEditarCategoria"></option>
                  <?php
                  $item = null;
                  $valor = null; 

                  $categorias = CategoriesController::showCategories($item, $valor);
                  foreach ($categorias as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <textarea maxlength="120" class="form-control input-lg descripcionSubCategoria" name="descripcionSubCategoria" rows="3" required></textarea>
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
            <button type="submit" class="btn btn-primary">Guardar subcategoría</button>
          </div>
        </form>
        <?php  
          $editarSubCategoria = new SubCategoriesController();
          $editarSubCategoria->editSubCategory();
        ?>
      </div>
    </div>
  </div>
  <?php  
    $eliminarSubCategoria = new SubCategoriesController();
    $eliminarSubCategoria->deleteSubCategory();
  ?>
  <!-- BLOUEO DE LA TECLA ENTER -->
  <script>
    $(document).keydown(function(e){
      if (e.keyCode == 13) {
        e.preventDefault()
      }
    })
  </script>