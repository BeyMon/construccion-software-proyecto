<?php
include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
GenFunc::logSys("(servicios) I:Ingreso en opcion");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Servicios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Servicios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-table">&nbsp;</i>&nbsp;Listado de Servicios</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div id="jsgServicios"></div>
      </div>
    </div>
  </section>
</div>
<script>
  function cargaServicios() {
    console.log('cargaservicios');
    var db = {
      // Carga datos (READ)
      loadData: function (filter) {
        return $.ajax({
          type: "GET",
          url: "/cnt/ServiciosCnt.php",
          data: filter,
          dataType: "json"
        })
                .done(function (data) {
                  console.log('loadData – datos recibidos:', data);
                })
                .fail(function (jqXHR, status, err) {
                  console.error('loadData – error:', status, err);
                });
      },

      // Inserta nuevo registro (CREATE)
      insertItem: function (item) {
        return $.ajax({
          type: "POST",
          url: "/cnt/ServiciosCnt.php",
          contentType: "application/json",
          data: JSON.stringify(item)
        });
      },

      // Actualiza un registro existente (UPDATE)
      updateItem: function (item) {
        return $.ajax({
          type: "PUT",
          url: "/cnt/ServiciosCnt.php",
          contentType: "application/json",
          data: JSON.stringify(item)
        });
      }
    };

    $("#jsgServicios").jsGrid({
      width: "100%",
      height: "auto",

      filtering: false,
      editing: true,
      sorting: true,
      paging: true,
      autoload: true,
      confirmDeleting: false,

      pageSize: 15,
      pageButtonCount: 5,

      controller: db,

      onItemDeleting: function (args) {
        args.cancel = true; // Cancela la eliminación automática

        Swal.fire({
          title: '¿Está seguro?',
          text: `Desea eliminar al servicio "${args.item.nombre}"`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            // Eliminación manual usando tu controller
            $.ajax({
              type: "DELETE",
              url: "/cnt/ServiciosCnt.php/" + args.item.id
            }).done(function () {
              $("#jsgServicios").jsGrid("loadData");
              Swal.fire('Eliminado', 'El servicio ha sido eliminado.', 'success');
            }).fail(function () {
              Swal.fire('Error', 'No se pudo eliminar el servicio.', 'error');
            });
          }
        });
      },

      primaryKey: "id",

      rowClick: function (args) {
        showDetailsDialog("Editar", args.item, "servicio", db);
      },

      fields: [
        {name: "nombre", type: "text", title: "Descripción", width: 250},
        {name: "refere", type: "text", title: "Referencia", width: 100},
        {name: "prcvta", type: "number", title: "Precio", width: 150,
          itemTemplate: function (value) {
            let valor = ftos(value, 1);
            return valor;
          }
        },
        {type: "control",
          modeSwitchButton: false,
          editButton: false,
          headerTemplate: function () {
            return $("<button>")
                    .addClass("btn btn-primary btn-sm")
                    .css({
                      "background-color": "#007bff",
                      "color": "#fff",
                      "border": "none",
                      "border-radius": "50%",
                      "width": "32px",
                      "height": "32px",
                      "font-size": "20px",
                      "line-height": "28px",
                      "text-align": "center",
                      "padding": "0",
                      "cursor": "pointer"
                    })
                    .html("+")
                    .attr("title", "Agregar nuevo servicio")
                    .on("click", function () {
                      showDetailsDialog("Nuevo", {}, "servicio", db);
                    });
          }
        }
      ]
    });
  }
</script>
