async function llamar_api() {
    const formulario = document.getElementById('frmApi');
    const datos = new FormData(formulario);
    let ruta_api = document.getElementById('ruta_api').value;

    try {
        // Llamada a la API
        let respuesta = await fetch(ruta_api + '/src/controller/api-request.php?tipo=verPerritosApiByNombre', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        // Convertimos la respuesta a JSON
        let json = await respuesta.json();

        // Variable para generar las filas de la tabla
        let contenidoHTML = '';
        let contador = 0;

        // Recorremos el arreglo de perritos
        json.contenido.forEach(perrito => {
            contador++;
            contenidoHTML += "<tr>";
            contenidoHTML += "<td>" + contador + "</td>";
            contenidoHTML += "<td>" + perrito.nombre + "</td>";
            contenidoHTML += "<td>" + perrito.raza + "</td>";
            contenidoHTML += "<td>" + perrito.edad + "</td>";
            contenidoHTML += "<td>" + perrito.peso + "</td>";
            contenidoHTML += "<td>" + perrito.color + "</td>";
            contenidoHTML += "<td>" + perrito.genero + "</td>";
            contenidoHTML += "<td>" + perrito.vacunado + "</td>";
            contenidoHTML += "</tr>";
        });

        // Insertamos las filas en la tabla HTML
        document.getElementById('contenido').innerHTML = contenidoHTML;

    } catch (error) {
        console.error('Error al llamar a la API:', error);
    }
}
