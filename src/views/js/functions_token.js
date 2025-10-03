// ===================== LISTAR TOKENS =====================
async function listar_tokens() {
    try {
        let respuesta = await fetch(base_url + 'src/controller/token.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;

            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila_" + item.id;
                cont += 1;

                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.id_cliente_api}</td>
                    <td>${item.token}</td>
                    <td>${item.fecha_registro}</td>
                    <td>${item.options}</td>
                `;

                document.querySelector('#tbl_tokens').appendChild(nueva_fila);
            });
        }

        console.log(json);
    } catch (error) {
        console.log("Error al listar tokens: " + error);
    }
}

if (document.querySelector('#tbl_tokens')) {
    listar_tokens();
}

// ===================== REGISTRAR TOKEN =====================
async function registrar_token() {
    let id_cliente_api = document.querySelector('#id_cliente_api').value.trim();
    let token = document.querySelector('#token').value.trim();
    let estado = document.querySelector('#estado').value;

    if (id_cliente_api === "" || token === "" || estado === "") {
        swal("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    try {
        const datos = new FormData(document.querySelector('#frmRegistrarToken'));
        let respuesta = await fetch(base_url + 'src/controller/token.php?tipo=registrar', {
            method: 'POST',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            swal("Registro", json.mensaje, "success");
            document.querySelector('#frmRegistrarToken').reset();
        } else {
            swal("Registro", json.mensaje, "error");
        }

        console.log(json);
    } catch (e) {
        console.log("Error al registrar token: " + e);
    }
}

// ===================== EDITAR TOKEN =====================
async function editar_token(id) {
    const formData = new FormData();
    formData.append('id', id);

    try {
        let respuesta = await fetch(base_url + 'src/controller/token.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            document.querySelector('#id').value = json.contenido.id;
            document.querySelector('#id_cliente_api').value = json.contenido.id_cliente_api;
            document.querySelector('#token').value = json.contenido.token;
        } else {
            window.location = base_url + "tokens";
        }

    } catch (error) {
        console.log("Error al editar token: " + error);
    }
}

// ===================== ACTUALIZAR TOKEN =====================
async function actualizar_token() {
    const id = document.querySelector('#id').value;
    const id_cliente_api = document.querySelector('#id_cliente_api').value;
    const token = document.querySelector('#token').value;

    if (!id_cliente_api || !token) {
        swal("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    try {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('id_cliente_api', id_cliente_api);
        formData.append('token', token);

        let respuesta = await fetch(base_url + 'src/controller/token.php?tipo=editar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success").then(() => {
                window.location = base_url + "tokens";
            });
        } else {
            swal("Error", json.mensaje, "error");
        }

        console.log(json);

    } catch (error) {
        console.log("Error al actualizar token: " + error);
    }
}

// ===================== ELIMINAR TOKEN =====================
async function eliminar_token(id) {
    swal({
        title: "¿Estás seguro de eliminar este token?",
        text: "No podrás recuperarlo",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(async (willDelete) => {
        if (willDelete) {
            try {
                const formData = new FormData();
                formData.append('id', id);

                const respuesta = await fetch(base_url + 'src/controller/token.php?tipo=eliminar', {
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
                console.log("Error al eliminar token: " + error);
            }
        }
    });
}
async function cargarClientes() {
    try {
        const respuesta = await fetch(base_url + 'src/controller/cliente.php?tipo=listar');
        const json = await respuesta.json();

        if (json.status) {
            const select = document.querySelector('#id_cliente_api');
            json.contenido.forEach(cliente => {
                const option = document.createElement('option');
                option.value = cliente.id;
                option.textContent = cliente.nombre_apellidos;
                select.appendChild(option);
            });
        } else {
            console.log("No hay clientes para mostrar");
        }
    } catch (error) {
        console.log("Error al cargar clientes: " + error);
    }
}

// Llamar cuando se cargue la página
if (document.querySelector('#id_cliente_api')) {
    cargarClientes();
}