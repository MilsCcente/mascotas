// ===================== LISTAR USUARIOS =====================
async function listar_usuarios() {
    try {
        // Llamada al controlador de usuarios
        let respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;

            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila_" + item.id;
                cont += 1;

                // Se llena la fila con los datos del usuario
                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.nombre}</td>
                    <td>${item.rol}</td>
                    <td>${item.options}</td>
                `;

                document.querySelector('#tbl_usuarios').appendChild(nueva_fila);
            });
        }

        console.log(json);
    } catch (error) {
        console.log("Oops, salió error: " + error);
    }
}

// Ejecutar solo si existe la tabla
if (document.querySelector('#tbl_usuarios')) {
    listar_usuarios();
}


async function registrar_usuario() {
    let nombre = document.querySelector('#nombre').value;
    let password = document.querySelector('#password').value;
    let rol = document.querySelector('#rol').value;

    if (!nombre  || !password || !rol) {
        swal("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    const formData = new FormData(document.querySelector('#frmRegistrarUsuario'));
    const respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=registrar', {
        method: 'POST',
        body: formData
    });

    const json = await respuesta.json();

    if (json.status) {
        swal("Registro", json.mensaje, "success");
        document.querySelector('#frmRegistrarUsuario').reset();
    } else {
        swal("Error", json.mensaje, "error");
    }
}


async function editar_usuario(id) {
    const formData = new FormData();
    formData.append('id_usuario', id);

    const respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=ver', {
        method: 'POST',
        body: formData
    });

    const json = await respuesta.json();
    if (json.status) {
        document.querySelector('#id_usuario').value = json.contenido.id;
        document.querySelector('#nombre').value = json.contenido.nombre;
        document.querySelector('#rol').value = json.contenido.rol;
        
    }
}



// ===================== ACTUALIZAR USUARIO =====================
async function actualizar_usuario() {
    const id = document.querySelector('#id_usuario').value;
    const nombre = document.querySelector('#nombre').value;
    const rol = document.querySelector('#rol').value;

    if (!nombre || !rol) {
        swal("Error", "Por favor completa todos los campos", "error");
        return;
    }

    try {
        const formData = new FormData();
        formData.append('id_usuario', id);
        formData.append('nombre', nombre);
        formData.append('rol', rol);

        let respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=editar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        const json = await respuesta.json();

        if (json.status) {
            swal("Éxito", json.mensaje, "success")
                .then(() => {
                    window.location = base_url + "usuario";
                });
        } else {
            swal("Error", json.mensaje, "error");
        }

    } catch (error) {
        console.log("Oops, ocurrió un error: " + error);
    }
}


// ===================== ELIMINAR USUARIO =====================
async function eliminar_usuario(id) {
    swal({
        title: "¿Estás seguro de eliminar este usuario?",
        text: "No podrás recuperarlo",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(async (willDelete) => {
        if (willDelete) {
            try {
                const formData = new FormData();
                formData.append('id_usuario', id);

                const respuesta = await fetch(base_url + 'src/controller/usuario.php?tipo=eliminar', {
                    method: 'POST',
                    body: formData
                });

                const json = await respuesta.json();

                if (json.status) {
                    swal("Éxito", json.message, "success")
                        .then(() => {
                            location.reload(); // recarga el listado
                        });
                } else {
                    swal("Error", json.message, "error");
                }

            } catch (error) {
                console.log("Error al eliminar usuario: " + error);
            }
        }
    });
}
