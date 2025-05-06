<?php
include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
GenFunc::logSys("(clientes) I:Ingreso en opcion");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Clientes</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Clientes</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-table">&nbsp;</i>&nbsp;Listado de Clientes</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div id="jsgClientes"></div>
      </div>
    </div>
  </section>
</div>
<script>
  function cargaClientes() {
    console.log('cargaclientes');
    var db = {
      // Carga datos (READ)
      loadData: function (filter) {
        return $.ajax({
          type: "GET",
          url: "/cnt/ClientesCnt.php",
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
          url: "/cnt/ClientesCnt.php",
          contentType: "application/json",
          data: JSON.stringify(item)
        });
      },

      // Actualiza un registro existente (UPDATE)
      updateItem: function (item) {
        return $.ajax({
          type: "PUT",
          url: "/cnt/ClientesCnt.php",
          contentType: "application/json",
          data: JSON.stringify(item)
        });
      }
    };

    $("#jsgClientes").jsGrid({
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
          text: `Desea eliminar al cliente "${args.item.nombre}"`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            // Eliminación manual usando controller
            $.ajax({
              type: "DELETE",
              url: "/cnt/ClientesCnt.php/" + args.item.id
            }).done(function () {
              $("#jsgClientes").jsGrid("loadData");
              Swal.fire('Eliminado', 'El cliente ha sido eliminado.', 'success');
            }).fail(function () {
              Swal.fire('Error', 'No se pudo eliminar el cliente.', 'error');
            });
          }
        });
      },

      primaryKey: "id",

      rowClick: function (args) {
        showDetailsDialog("Editar", args.item, "cliente", db);
      },

      fields: [
        {name: "id", type: "text", title: "Cédula", width: 100},
        {name: "nombre", type: "text", title: "Nombre", width: 150},
        {name: "correo", type: "text", title: "Correo", width: 100},
        {name: "direcc", type: "text", title: "Dirección", width: 200},
        {name: "telefono", type: "text", title: "Teléfono", width: 60},
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
                    .attr("title", "Agregar nuevo cliente")
                    .on("click", function () {
                      showDetailsDialog("Nuevo", {}, "cliente", db);
                    });
          }
        }
      ]
    });
  }
</script>
