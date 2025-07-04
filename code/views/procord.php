<?php

include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
GenFunc::logSys("(proc orden) I:Ingreso en opcion");
?>
<<<<<<< HEAD

<style>
    /* Mejor usar archivo CSS externo, pero aquí está para demo */
    #modal-acciones {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        /* Más oscuro */
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    #modal-acciones>div {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        max-width: 700px;
        /* Más grande que antes */
        width: 90%;
        max-height: 90%;
        overflow-y: auto;
        box-sizing: border-box;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }

    #modal-acciones h3 {
        margin-top: 0;
    }

    .tabs {
        display: flex;
        border-bottom: 1px solid #ccc;
        margin-bottom: 10px;
    }

    .tab {
        flex: 1;
        padding: 10px;
        background: #eee;
        border: none;
        cursor: pointer;
        text-align: center;
        font-weight: 600;
        font-size: 15px;
        transition: background 0.2s;
    }

    .tab.active {
        background: #fff;
        border-bottom: 3px solid #007bff;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    #modal-acciones select,
    #modal-acciones textarea,
    #modal-acciones input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border-radius: 4px;
        border: 1px solid #ccc;
        resize: vertical;
        font-family: inherit;
        font-size: 14px;
    }

    #modal-acciones textarea {
        min-height: 100px;
    }

    #modal-acciones .btn {
        font-size: 14px;
        padding: 8px 14px;
        border-radius: 4px;
        cursor: pointer;
    }

    #modal-acciones .btn-success {
        margin-right: 10px;
    }
</style>

=======
<!-- No recorde donde se ponia este codigo dentro de la carpeta css MODAL  -->
<style>
#modal-acciones {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

#modal-acciones>div {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    max-width: 400px;
    width: 90%;
    box-sizing: border-box;
}

#modal-acciones h3 {
    margin-top: 0;
}

#modal-acciones label {
    font-weight: 600;
}

#modal-acciones select,
#modal-acciones textarea,
#modal-acciones input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border-radius: 4px;
    border: 1px solid #ccc;
    resize: vertical;
    font-family: inherit;
    font-size: 14px;
}

#modal-acciones textarea {
    min-height: 80px;
}

#modal-acciones .btn {
    font-size: 14px;
    padding: 8px 14px;
    border-radius: 4px;
    cursor: pointer;
}

#modal-acciones .btn-success {
    margin-right: 10px;
}
</style>

<!-- -->

>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Procesa Orden de Trabajo</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
<<<<<<< HEAD
                            <h3 class="card-title">Lista de Órdenes Activas</h3>
=======
                            <h3 class="card-title">Lista de Ã“rdenes Activas</h3>
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap" id="tbord">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Modelo</th>
                                        <th>Marca</th>
                                        <th>IMEI</th>
                                        <th>Problema</th>
<<<<<<< HEAD
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-ordenes">
                                    <!-- Se cargarán las órdenes aquí -->
=======
                                        <th>TÃ©cnico</th>
                                        <th>AcciÃ³n</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-ordenes">
                                    <!-- Se cargarÃ¡n las Ã³rdenes aquÃ­ -->
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            <div id="detalle-orden" style="display:none;" class="card mt-4 shadow-lg border-0">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i> Detalle de la Orden de Trabajo
                    </h5>
                </div>
=======
            <!-- Detalle de orden -->
            <div id="detalle-orden" style="display:none;" class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Detalle de la Orden de Trabajo</h3>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> <span id="id"></span></p>
                    <p><strong>Cliente:</strong> <span id="cliente"></span></p>
                    <p><strong>Fecha:</strong> <span id="fecha"></span></p>
                    <p><strong>Modelo:</strong> <span id="modelo"></span></p>
                    <p><strong>Marca:</strong> <span id="marca"></span></p>
                    <p><strong>IMEI:</strong> <span id="imei"></span></p>
                    <p><strong>Problema:</strong> <span id="problema"></span></p>
                    <p><strong>TÃ©cnico:</strong> <span id="tecnico"></span></p>
                    <p><strong>Estado:</strong> <span id="estado"></span></p>
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><strong>ID:</strong> <span id="id"></span></p>
                            <p><strong>Cliente:</strong> <span id="cliente"></span></p>
                            <p><strong>Fecha:</strong> <span id="fecha"></span></p>
                            <p><strong>Estado:</strong> <span id="estado" class="badge bg-secondary"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Marca:</strong> <span id="marca"></span></p>
                            <p><strong>Modelo:</strong> <span id="modelo"></span></p>
                            <p><strong>IMEI:</strong> <span id="imei"></span></p>
                        </div>
                        <div class="col-12">
                            <p><strong>Problema reportado:</strong> <span id="problema"></span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="text-end">
                        <button class="btn btn-success" onclick="abrirFormulario()">
                            <i class="bi bi-pencil-square"></i> Registrar acciones
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<<<<<<< HEAD

<!-- Nuevo modal divido por pestañas -->
=======
<!-- MODAL acciones -->
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091
<div id="modal-acciones" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div>
        <h3 id="modalTitle">Registrar Acciones</h3>

<<<<<<< HEAD
        <div class="tabs">
            <button class="tab active" onclick="mostrarTab('tab-producto')">Producto</button>
            <button class="tab" onclick="mostrarTab('tab-servicio')">Servicio</button>
            <button class="tab" onclick="mostrarTab('tab-proceso')">Proceso</button>
        </div>

        <div class="tab-content active" id="tab-producto">
            <label for="producto">Producto utilizado:</label>
            <select id="producto">
                <option value="">-- Seleccione producto --</option>
            </select>

            <label for="cantidad">Cantidad a usar:</label>
            <input type="number" id="cantidad" min="1" placeholder="Ingrese cantidad" />
        </div>

        <div class="tab-content" id="tab-servicio">
            <label for="servicio">Servicio realizado:</label>
            <select id="servicio">
                <option value="">-- Seleccione servicio --</option>
            </select>
        </div>

        <div class="tab-content" id="tab-proceso">
            <label for="proceso">Proceso realizado:</label>
            <textarea id="proceso" placeholder="Describe el proceso..."></textarea>
        </div>
=======
        <label for="producto">Producto utilizado:</label>
        <select id="producto">
            <option value="">-- Seleccione producto --</option>
        </select>

        <label for="cantidad">Cantidad a usar:</label>
        <input type="number" id="cantidad" min="1" placeholder="Ingrese cantidad" />

        <label for="servicio">Servicio realizado:</label>
        <select id="servicio">
            <option value="">-- Seleccione servicio --</option>
        </select>

        <label for="proceso">Proceso realizado:</label>
        <textarea id="proceso" placeholder="Describe el proceso..."></textarea>
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091

        <div style="text-align:right; margin-top:15px;">
            <button onclick="guardarAcciones()" class="btn btn-success">Guardar</button>
            <button onclick="cerrarModal()" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
</div>

<script>
<<<<<<< HEAD
    // Cargar órdenes activas
    function cargaProcord() {
        fetch(`cnt/OrdenCnt.php/act/0000000001`)
            .then(response => response.json())
            .then(resdata => {
                if (resdata.data && Array.isArray(resdata.data)) {
                    const tbody = document.getElementById('tabla-ordenes');
                    tbody.innerHTML = '';
                    resdata.data.forEach(orden => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
              <td>${orden.id}</td>
              <td>${orden.codcli}</td>
              <td>${orden.fecing}</td>
              <td>${orden.modelo}</td>
              <td>${orden.marca}</td>
              <td>${orden.imei}</td>
              <td>${orden.observ}</td>
              <td>
                <button class="btn btn-success btn-sm" onclick="procesarOrden(this, '1')">Ver</button>
                <button class="btn btn-danger btn-sm" onclick="procesarOrden(this, '2')">Cerrar</button>
              </td>`;
                        tbody.appendChild(tr);
                    });
                }
            })
            .catch(error => console.error('Error al cargar órdenes:', error));
=======
// Cargar Ã³rdenes activas
function cargaProcord() {
    fetch(`cnt/OrdenCnt.php/act/0000000001`)
        .then(response => response.json())
        .then(resdata => {
            if (resdata.data && Array.isArray(resdata.data)) {
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
            }
        })
        .catch(error => console.error('Error al cargar Ã³rdenes:', error));
}

// Mostrar detalle orden al aceptar
function procesarOrden(button, estado) {
    const row = button.closest('tr');
    const celdas = row.querySelectorAll('td');
    if (estado === 'aceptado') {
        document.getElementById('id').textContent = celdas[0].textContent;
        document.getElementById('cliente').textContent = celdas[1].textContent;
        document.getElementById('fecha').textContent = celdas[2].textContent;
        document.getElementById('modelo').textContent = celdas[3].textContent;
        document.getElementById('marca').textContent = celdas[4].textContent;
        document.getElementById('imei').textContent = celdas[5].textContent;
        document.getElementById('problema').textContent = celdas[6].textContent;
        document.getElementById('tecnico').textContent = celdas[7].textContent;
        document.getElementById('estado').textContent = "Aceptado";
        document.getElementById('detalle-orden').style.display = 'block';
    } else {
        alert("La orden fue descartada.");
        document.getElementById('detalle-orden').style.display = 'none';
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091
    }

<<<<<<< HEAD
    // Mostrar detalle orden al aceptar
    function procesarOrden(button, estado) {
        const row = button.closest('tr');
        const celdas = row.querySelectorAll('td');
        if (estado === '1') {
            document.getElementById('id').textContent = celdas[0].textContent;
            document.getElementById('cliente').textContent = celdas[1].textContent;
            document.getElementById('fecha').textContent = celdas[2].textContent;
            document.getElementById('modelo').textContent = celdas[3].textContent;
            document.getElementById('marca').textContent = celdas[4].textContent;
            document.getElementById('imei').textContent = celdas[5].textContent;
            document.getElementById('problema').textContent = celdas[6].textContent;
            document.getElementById('estado').textContent = "Aceptado";
            document.getElementById('detalle-orden').style.display = 'block';
        } else if (estado === '2') {
            const codigo = celdas[0].textContent;

            Swal.fire({
                title: '¿Cerrar orden?',
                text: '¿Está seguro de cerrar esta orden?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('cnt/OrdenCnt.php/cerrar/' + encodeURIComponent(codigo))
                        .then(response => response.json())
                        .then(data => {
                            if (data.data) {
                                Swal.fire({
                                    title: 'Orden cerrada',
                                    text: 'La orden fue cerrada correctamente.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                cargaProcord(); // Recargar o actualizar datos
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'No se pudo cerrar la orden.',
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error al cerrar la orden:', error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error inesperado.',
                                icon: 'error'
                            });
                        });
                }
            });
        }
    }
    // Abrir modal y cargar opciones
    function abrirFormulario() {
        cargarOpciones();
        document.getElementById('modal-acciones').style.display = 'flex';
    }


    // funcion  
    function mostrarTab(tabId) {
        document.querySelectorAll('#modal-acciones .tab').forEach(tab => {
            tab.classList.remove('active');
        });
        document.querySelectorAll('#modal-acciones .tab-content').forEach(content => {
            content.classList.remove('active');
        });

        const activeTab = document.querySelector(`#modal-acciones .tab[onclick*="${tabId}"]`);
        if (activeTab) activeTab.classList.add('active');

        const activeContent = document.getElementById(tabId);
        if (activeContent) activeContent.classList.add('active');
    }


    // Cerrar modal
    function cerrarModal() {
        document.getElementById('modal-acciones').style.display = 'none';
        // Limpiar formulario
        document.getElementById('producto').value = '';
        document.getElementById('cantidad').value = '';
        document.getElementById('servicio').value = '';
        document.getElementById('proceso').value = '';
    }

    // Guardar acciones
    function guardarAcciones() {
        const productoSelect = document.getElementById('producto');
        const productoId = productoSelect.value;
        const stock = parseInt(productoSelect.options[productoSelect.selectedIndex]?.dataset.stock || "0");
        const cantidad = parseInt(document.getElementById('cantidad').value, 10);
        const servicio = document.getElementById('servicio').value;
        const proceso = document.getElementById('proceso').value.trim();
        const ordId = document.getElementById('id').textContent;

        if (!ordId) {
            alert('No hay orden seleccionada.');
            return;
        }
        if (!productoId && !servicio && proceso === '') {
            alert('Debe seleccionar un producto, un servicio o ingresar un proceso.');
            return;
        }
        if (productoId && (isNaN(cantidad) || cantidad <= 0)) {
            alert('Ingrese una cantidad válida para el producto.');
            return;
        }
        if (productoId && cantidad > stock) {
            alert(`Stock insuficiente. Disponible: ${stock}`);
            return;
        }

        // Preparar objeto para enviar
        const datos = {
            ordid: ordId,
            tipdet: productoId ? 1 : (servicio ? 2 : 0), // 1=Repuesto, 2=Servicio, 0=Detalle simple
            iteid: productoId || servicio || '',
            cantid: productoId ? cantidad : (servicio ? 1 : 0),
            observ: proceso,
        };

        fetch(`cnt/OrddetCnt.php`, {
=======
// Abrir modal y cargar opciones
function abrirFormulario() {
    cargarOpciones();
    document.getElementById('modal-acciones').style.display = 'flex';
}

// Cerrar modal
function cerrarModal() {
    document.getElementById('modal-acciones').style.display = 'none';
    // Limpiar formulario
    document.getElementById('producto').value = '';
    document.getElementById('cantidad').value = '';
    document.getElementById('servicio').value = '';
    document.getElementById('proceso').value = '';
}

// Guardar acciones
function guardarAcciones() {
    const productoSelect = document.getElementById('producto');
    const productoId = productoSelect.value;
    const stock = parseInt(productoSelect.options[productoSelect.selectedIndex]?.dataset.stock || "0");
    const cantidad = parseInt(document.getElementById('cantidad').value, 10);
    const servicio = document.getElementById('servicio').value;
    const proceso = document.getElementById('proceso').value.trim();
    const ordId = document.getElementById('id').textContent;

    if (!ordId) {
        alert('No hay orden seleccionada.');
        return;
    }
    if (!productoId && !servicio && proceso === '') {
        alert('Debe seleccionar un producto, un servicio o ingresar un proceso.');
        return;
    }
    if (productoId && (isNaN(cantidad) || cantidad <= 0)) {
        alert('Ingrese una cantidad vÃ¡lida para el producto.');
        return;
    }
    if (productoId && cantidad > stock) {
        alert(`Stock insuficiente. Disponible: ${stock}`);
        return;
    }
    if (servicio === '' && productoId === '' && proceso === '') {
        alert('Debe ingresar al menos un detalle.');
        return;
    }

    // Preparar objeto para enviar
    const datos = {
        ordid: ordId,
        tipdet: productoId ? 1 : (servicio ? 2 : 0), // 1=Repuesto, 2=Servicio, 0=Detalle simple
        iteid: productoId || servicio || '',
        prcvta: 0, // Si necesitas, puedes agregar lÃ³gica para precio
        cantid: productoId ? cantidad : (servicio ? 1 : 0),
        observ: proceso,
        fecdet: new Date().toISOString().slice(0, 10)
    };

    // 

    fetch(`cnt/DetalleOrdenCnt.php`, {
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        })
<<<<<<< HEAD
            .then(res => {
                if (!res.ok) throw new Error('Error al guardar detalle');
                return res.json();
            })
            .then(response => {
                if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: ' + response.error,
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Acción guardada con éxito',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        cerrarModal();
                        // Opcional: refrescar lista o detalles
                    });
                }
            })
            .catch(err => alert('Error al guardar: ' + err.message));
    }

    // Cargar productos y servicios para selects
    function cargarOpciones() {
        // Cargar productos
        fetch(`cnt/ProductosCnt.php`)
            .then(res => res.json())
            .then(data => {
                const prodSelect = document.getElementById('producto');
                prodSelect.innerHTML = '<option value="">-- Seleccione producto --</option>';
                if (data.data && Array.isArray(data.data)) {
                    data.data.forEach(p => {
                        const option = document.createElement('option');
                        option.value = p.id;
                        option.textContent = `${p.nombre} (Stock: ${p.cantid})`;
                        option.dataset.stock = p.cantid;
                        prodSelect.appendChild(option);
                    });
                }
            })
            .catch(() => {
                alert('Error cargando productos');
            });

        // Cargar servicios
        fetch(`cnt/ServiciosCnt.php`)
            .then(res => res.json())
            .then(data => {
                const servSelect = document.getElementById('servicio');
                servSelect.innerHTML = '<option value="">-- Seleccione servicio --</option>';
                if (data.data && Array.isArray(data.data)) {
                    data.data.forEach(s => {
                        const option = document.createElement('option');
                        option.value = s.id;
                        option.textContent = s.nombre;
                        servSelect.appendChild(option);
                    });
                }
            })
            .catch(() => {
                alert('Error cargando servicios');
            });
    }

    // Cargar órdenes al inicio
    window.addEventListener('load', cargaProcord);
</script>
=======
        .then(res => {
            if (!res.ok) throw new Error('Error al guardar detalle');
            return res.json();
        })
        .then(data => {
            alert('Detalle guardado con Ã©xito.');
            cerrarModal();
        })
        .catch(err => {
            console.error(err);
            alert('OcurriÃ³ un error al guardar el detalle.');
        });
}

// Cargar productos y servicios en selects
function cargarOpciones() {
    fetch('/cnt/ProductosCnt.php')
        .then(res => res.json())
        .then(data => {
            const selprod = document.getElementById('producto');
            selprod.innerHTML = '<option value="">-- Seleccione producto --</option>';
            data.forEach(element => {
                selprod.innerHTML +=
                    `<option value="${element.id}" data-stock="${element.stock}">${element.nombre} (Disponible: ${element.stock})</option>`;
            });
        });

    fetch('/cnt/ServiciosCnt.php')
        .then(res => res.json())
        .then(data => {
            const selserv = document.getElementById('servicio');
            selserv.innerHTML = '<option value="">-- Seleccione servicio --</option>';
            data.forEach(element => {
                selserv.innerHTML += `<option value="${element.id}">${element.nombre}</option>`;
            });
        });
}


// Ejecutar carga inicial
document.addEventListener('DOMContentLoaded', cargaProcord);
</script>
>>>>>>> e511baff803fdb30efd7e0a10994c456522a3091
