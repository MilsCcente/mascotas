// ===================== LISTAR CLIENTES =====================
async function listarClientes() {
    try {
        // Llamada al controlador de clientes
        let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;

            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila_" + item.id;
                cont += 1;

                // Se llena la fila con los datos del cliente
                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.dni}</td>
                    <td>${item.nombre_apellidos}</td>
                    <td>${item.telefono || ''}</td>
                    <td>${item.correo || ''}</td>
                    <td>${item.fecha_registro}</td>
                    <td>${item.estado}</td>
                    <td>${item.options}</td>
                `;

                document.querySelector('#tbl_clientes').appendChild(nueva_fila);
            });
        }

        console.log(json);
    } catch (error) {
        console.log("Error al listar clientes: " + error);
    }
}

// Ejecutar solo si existe la tabla
if (document.querySelector('#tbl_clientes')) {
    listarClientes();
}


// ===================== REGISTRAR CLIENTE =====================
async function registrarCliente() {
    // Obtener valores de los inputs
    let dni = document.querySelector('#dni').value.trim();
    let nombre_apellidos = document.querySelector('#nombre_apellidos').value.trim();
    let telefono = document.querySelector('#telefono').value.trim();
    let correo = document.querySelector('#correo').value.trim();

    // Validación básica
    if (dni === "" || nombre_apellidos === "") {
        swal("Error", "Los campos DNI y Nombre son obligatorios", "error");
        return;
    }

    try {
        const datos = new FormData(document.querySelector('#frmRegistrarCliente'));

        // Enviar al controlador
        let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=registrar', {
            method: 'POST',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            swal("Registro", json.mensaje, "success");
            document.querySelector('#frmRegistrarCliente').reset();
        } else {
            swal("Error", json.mensaje, "error");
        }

        console.log(json);
    } catch (e) {
        console.log("Error al registrar cliente: " + e);
    }
}


// ===================== EDITAR CLIENTE =====================
async function editar_cliente(id) {
    const formData = new FormData();
    formData.append('id', id);

    try {
        let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=ver', {
            method: 'POST',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            // Guardar ID en hidden
            document.querySelector('#id').value = json.contenido.id;
            document.querySelector('#dni').value = json.contenido.dni;
            document.querySelector('#nombre_apellidos').value = json.contenido.nombre_apellidos;
            document.querySelector('#telefono').value = json.contenido.telefono;
            document.querySelector('#correo').value = json.contenido.correo;
            document.querySelector('#estado').value = json.contenido.estado;

        } else {
            window.location = base_url + "clientes";
        }

    } catch (error) {
        console.log("Error al cargar datos del cliente: " + error);
    }
}


// ===================== ACTUALIZAR CLIENTE =====================
async function actualizar_cliente() {
    const id = document.querySelector('#id').value;
    const dni = document.querySelector('#dni').value;
    const nombre_apellidos = document.querySelector('#nombre_apellidos').value;
    const telefono = document.querySelector('#telefono').value;
    const correo = document.querySelector('#correo').value;
    const estado = document.querySelector('#estado').value;

    if (!dni || !nombre_apellidos) {
        swal("Error", "Por favor completa los campos DNI y Nombre", "error");
        return;
    }

    try {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('dni', dni);
        formData.append('nombre_apellidos', nombre_apellidos);
        formData.append('telefono', telefono);
        formData.append('correo', correo);
        formData.append('estado', estado);

        let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=editar', {
            method: 'POST',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                window.location = base_url + "clientes"; // Redirige al listado
            });
        } else {
            swal("Error", json.mensaje, "error");
        }

    } catch (error) {
        console.log("Error al actualizar cliente: " + error);
    }
}


// ===================== ELIMINAR CLIENTE =====================
async function eliminar_cliente(id) {
    swal({
        title: "¿Estás seguro de eliminar este cliente?",
        text: "No podrás recuperarlo",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(async (willDelete) => {
        if (willDelete) {
            try {
                const formData = new FormData();
                formData.append('id', id);

                const respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=eliminar', {
                    method: 'POST',
                    body: formData
                });

                const json = await respuesta.json();

                if (json.status) {
                    swal("Éxito", json.mensaje, "success")
                        .then(() => {
                            location.reload();
                        });
                } else {
                    swal("Error", json.mensaje, "error");
                }

            } catch (error) {
                console.log("Error al eliminar cliente: " + error);
            }
        }
    });
}
