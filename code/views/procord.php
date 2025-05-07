<?php
include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
GenFunc::logSys("(proc orden) I:Ingreso en opcion");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Procesa Orden de Trabajo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Procesa OT</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Tabla de órdenes -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de Órdenes Activas</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>IMEI</th>
                    <th>Problema</th>
                    <th>Técnico</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody id="tabla-ordenes">
                  <!-- Se llenará dinámicamente -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Detalle que se muestra solo si se acepta -->
      <div id="detalle-orden" style="display:none;" class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">Detalle de la Orden de Trabajo</h3>
        </div>
        <div class="card-body">
          <p><strong>ID:</strong> <span id="id"></span></p>
          <p><strong>Cliente:</strong> <span id="cliente"></span></p>
          <p><strong>Fecha:</strong> <span id="fecha"></span></p>
          <p><strong>Modelo:</strong> <span id="modelo"></span></p>
          <p><strong>Marca:</strong> <span id="marca"></span></p>
          <p><strong>IMEI:</strong> <span id="imei"></span></p>
          <p><strong>Problema reportado:</strong> <span id="problema"></span></p>
          <p><strong>Técnico asignado:</strong> <span id="tecnico"></span></p>
          <p><strong>Estado:</strong> <span id="estado"></span></p>

          <button class="btn btn-primary" onclick="abrirFormulario()">Registrar acciones</button>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- JavaScript -->
<script>
  function cargaProcord() {
    fetch('/cnt/OrdenCnt.php/act')
            .then(response => response.json())
            .then(resdata => {
              if (resdata.data) {
                console.log(resdata.data);
                const tbody = document.getElementById('tabla-ordenes');
                tbody.innerHTML = '';

                resdata.data.forEach(orden => {
                  const tr = document.createElement('tr');
                  tr.innerHTML = `
            <td>${orden.id}</td>
            <td>${orden.cliente}</td>
            <td>${orden.fecing}</td>
            <td>${orden.modelo}</td>
            <td>${orden.marca}</td>
            <td>${orden.imei}</td>
            <td>${orden.problema}</td>
            <td>${orden.tecnico}</td>
            <td>
              <button class="btn btn-success btn-sm" onclick="procesarOrden(this, 'aceptado')">Aceptar</button>
              <button class="btn btn-danger btn-sm" onclick="procesarOrden(this, 'descartado')">Descartar</button>
            </td>
          `;
                  tbody.appendChild(tr);
                });
              } else {
                console.log(resdata.err);
              }
            })
            .catch(error => {
              console.error('Error al cargar las órdenes activas:', error);
            });
  }

  function procesarOrden(button, estado) {
    const row = button.closest('tr');
    const columnas = row.querySelectorAll('td');

    if (estado === 'aceptado') {
      document.getElementById('id').textContent = columnas[0].textContent;
      document.getElementById('cliente').textContent = columnas[1].textContent;
      document.getElementById('fecha').textContent = columnas[2].textContent;
      document.getElementById('modelo').textContent = columnas[3].textContent;
      document.getElementById('marca').textContent = columnas[4].textContent;
      document.getElementById('imei').textContent = columnas[5].textContent;
      document.getElementById('problema').textContent = columnas[6].textContent;
      document.getElementById('tecnico').textContent = columnas[7].textContent;
      document.getElementById('estado').textContent = "Aceptado";

      document.getElementById('detalle-orden').style.display = 'block';
    } else {
      alert("La orden fue descartada.");
      document.getElementById('detalle-orden').style.display = 'none';
    }
  }

  function abrirFormulario() {
    alert("Aquí cargarías un formulario con observaciones, repuestos o servicios.");
    // Ejemplo: window.location.href = 'detalle_orden.php?id=' + document.getElementById('id').textContent;
  }
</script>
