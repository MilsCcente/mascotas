const base_url = "<?php echo BASE_URL; ?>";

async function listarClientes() {
    let resp = await fetch(base_url + "src/controller/cliente.php?tipo=listar");
    let data = await resp.json();

    let tbody = document.querySelector("#tablaClientes tbody");
    tbody.innerHTML = "";

    data.forEach(c => {
        tbody.innerHTML += `
        <tr>
            <td>${c.id}</td>
            <td>${c.dni}</td>
            <td>${c.nombre_apellidos}</td>
            <td>${c.telefono ?? ""}</td>
            <td>${c.correo ?? ""}</td>
            <td>${c.estado}</td>
            <td>
                <a href="${base_url}editar-cliente&id=${c.id}" class="btn btn-sm btn-warning">Editar</a>
                <button onclick="eliminarCliente(${c.id})" class="btn btn-sm btn-danger">Eliminar</button>
            </td>
        </tr>`;
    });
}

async function eliminarCliente(id) {
    if (confirm("¿Seguro de eliminar este cliente?")) {
        let formData = new FormData();
        formData.append("id", id);

        let resp = await fetch(base_url + "src/controller/cliente.php?tipo=eliminar", {
            method: "POST",
            body: formData
        });

        let data = await resp.json();
        if (data.status) {
            alert("Cliente eliminado");
            listarClientes();
        } else {
            alert("Error al eliminar");
        }
    }
}
