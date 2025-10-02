// ===================== LISTAR CLIENTES =====================
async function listar_clientes() {
    try {
        // Limpiar la tabla antes de llenarla
        document.querySelector('#tbl_clientes').innerHTML = "";

        let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;

            datos.forEach(item => {
                let fila = document.createElement("tr");
                cont++;

                fila.innerHTML = `
                    <td>${cont}</td>
                    <td>${item.dni}</td>
                    <td>${item.nombre_apellidos}</td>
                    <td>${item.telefono}</td>
                    <td>${item.correo}</td>
                    <td>${item.fecha_registro}</td>
                    <td>${item.estado}</td>
                    <td>${item.options}</td>
                `;

                document.querySelector('#tbl_clientes').appendChild(fila);
            });
        }
    } catch (error) {
        console.error("Error al listar clientes:", error);
    }
}

// ===================== REGISTRAR CLIENTE =====================
async function registrar_cliente() {
    let dni = document.querySelector('#dni').value.trim();
    let nombre = document.querySelector('#nombre_apellidos').value.trim();
    let telefono = document.querySelector('#telefono').value.trim();
    let correo = document.querySelector('#correo').value.trim();

    if (dni === "" || nombre === "" || telefono === "" || correo === "") {
        swal("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    try {
        const datos = new FormData(document.querySelector('#frmRegistrarCliente'));

        let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=registrar', {
            method: 'POST',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                document.querySelector('#frmRegistrarCliente').reset();
                listar_clientes();
            });
        } else {
            swal("Error", json.mensaje, "error");
        }
    } catch (error) {
        console.error("Error al registrar cliente:", error);
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

        let json = await respuesta.json();

        if (json.status) {
            document.querySelector('#id').value = json.contenido.id;
            document.querySelector('#dni').value = json.contenido.dni;
            document.querySelector('#nombre_apellidos').value = json.contenido.nombre_apellidos;
            document.querySelector('#telefono').value = json.contenido.telefono;
            document.querySelector('#correo').value = json.contenido.correo;
            document.querySelector('#estado').value = json.contenido.estado;
        } else {
            swal("Error", json.mensaje, "error");
        }
    } catch (error) {
        console.error("Error al obtener cliente:", error);
    }
}

// ===================== ACTUALIZAR CLIENTE =====================
async function actualizar_cliente() {
    const id = document.querySelector('#id').value;
    const dni = document.querySelector('#dni').value;
    const nombre = document.querySelector('#nombre_apellidos').value;
    const telefono = document.querySelector('#telefono').value;
    const correo = document.querySelector('#correo').value;
    const estado = document.querySelector('#estado').value;

    if (!dni || !nombre || !telefono || !correo) {
        swal("Error", "Completa todos los campos", "error");
        return;
    }

    try {
        const formData = new FormData(document.querySelector('#frmCliente'));

        let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=editar', {
            method: 'POST',
            body: formData
        });

        let json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                window.location = base_url + "clientes";
            });
        } else {
            swal("Error", json.mensaje, "error");
        }
    } catch (error) {
        console.error("Error al actualizar cliente:", error);
    }
}

// ===================== ELIMINAR CLIENTE =====================
async function eliminar_cliente(id) {
    swal({
        title: "¿Eliminar Cliente?",
        text: "No podrás recuperarlo después",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(async (willDelete) => {
        if (willDelete) {
            try {
                const formData = new FormData();
                formData.append('id', id);

                let respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=eliminar', {
                    method: 'POST',
                    body: formData
                });

                let json = await respuesta.json();

                if (json.status) {
                    swal("Éxito", json.message, "success").then(() => {
                        listar_clientes();
                    });
                } else {
                    swal("Error", json.message, "error");
                }
            } catch (error) {
                console.error("Error al eliminar cliente:", error);
            }
        }
    });
}

// ===================== EJECUTAR =====================
// Solo ejecuta si existe la tabla de clientes en la vista
if (document.querySelector('#tbl_clientes')) {
    listar_clientes();
}
