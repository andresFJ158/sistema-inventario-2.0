<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar activos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar activos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarActivo">
          
          Agregar activo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaActivos" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Categoría</th>
           <th>Descripción</th>
           <th>Marca</th>
           <th>Fecha Alta</th>
           <th>Fecha Baja</th>
           <th>Valor</th>
           <th>Cantidad</th>
           <th>Agregado</th>
           <th>Acciones</th>
           
         </tr> 

        </thead>      

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR ACTIVO
======================================-->

<div id="modalAgregarActivo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar activo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevaDescripcion"  name="nuevaDescripcion" placeholder="Ingresar la descripción" required>
              </div>
            </div>
            <!-- ENTRADA PARA LA MARCA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar la marca" required>
              </div>
            </div>
            <!-- ENTRADA PARA LA FECHA INGRESO -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaFechaAlta" placeholder="Ingresar la fecha de Alta" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask >
              </div>
            </div>
            <!-- ENTRADA PARA LA FECHA BAJA -->
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaFechaBaja" placeholder="Ingresar la fecha de baja" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask >
              </div>
            </div>
            <div class="form-group row">
                <!-- ENTRADA PARA VALOR -->
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="nuevoValor" name="nuevoValor" step="any" min="0" placeholder="Valor" required>
                  </div>
                </div>
                <!-- ENTRADA CANTIDAD-->
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="nuevaCantidad" name="nuevaCantidad" step="any" min="0" placeholder="Cantidad" required>
                  </div>
                </div>
              </div>

          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar activo</button>
        </div>
      </form>
        <?php
          $crearActivo = new ControladorActivos();
          $crearActivo -> ctrCrearActivos();
        ?>  
    </div>
  </div>
</div>
<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarActivo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar activo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg"  name="editarCategoria" readonly required>
                  
                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA EL CÓDIGO -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>
            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion"  name="editarDescripcion" placeholder="Ingresar la descripción" required>

              </div>

            </div>
            <!-- ENTRADA PARA LA MARCA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarMarca" name="editarMarca" placeholder="Ingresar la marca" required>

              </div>

            </div>
            <!-- ENTRADA PARA LA FECHA INGRESO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" id="editarFechaAlta" name="editarFechaAlta" placeholder="Ingresar la fecha de Alta" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask >

              </div>

            </div>
            <!-- ENTRADA PARA LA FECHA BAJA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" id="editarFechaBaja" name="editarFechaBaja" placeholder="Ingresar la fecha de baja" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask >

              </div>

            </div>

            <!-- ENTRADA PARA VALOR -->

            <div class="form-group row">
                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarValor" name="editarValor" step="any" min="0" placeholder="Valor" required>

                  </div>
                <!-- ENTRADA CANTIDAD-->
                </div>
                <div class="col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                    <input type="number" class="form-control input-lg" id="editarCantidad" name="editarCantidad" step="any" min="0" placeholder="Cantidad" required>
                  </div>
                </div>
              </div>
                </div>
          </div>  
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar activo</button>

        </div>
      </form>
        <?php
          $editarActivo = new ControladorActivos();
          $editarActivo -> ctrEditarActivo();
        ?>  
    </div>
  </div>
</div>
<?php
  $eliminarActivo = new ControladorActivos();
  $eliminarActivo -> ctrEliminarActivo();
?>