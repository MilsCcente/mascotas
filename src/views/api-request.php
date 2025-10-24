<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐾 Buscador de Perritos</title>

    <style>
        /* 💜 Fondo con degradado lila-violeta */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #d8b4f8, #b388eb, #9d7be0);
            color: #4a3b5a;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }


        @keyframes aparecer {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h1 {
            text-align: center;
            color: #7b3fd3;
            font-size: 2.5em;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .api-url {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid #caaefb;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 0.95em;
            color: #5a448a;
            margin-bottom: 20px;
        }

        .api-url input {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 0.9em;
            color: #6a5599;
        }

        form {
            background: rgba(255, 255, 255, 0.65);
            border: 2px solid #cdaefc;
            border-radius: 20px;
            padding: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #6b38c7;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 10px;
            border: 1.5px solid #caaefb;
            font-size: 1em;
            background-color: #f8f6ff;
            color: #4b3d74;
            transition: 0.3s;
        }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #a77af5;
            box-shadow: 0 0 6px rgba(161, 114, 255, 0.5);
        }

        .filtros {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 15px;
        }

        button {
            margin-top: 25px;
            width: 100%;
            background: linear-gradient(135deg, #a77af5, #cfa6f7);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-size: 1.1em;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #b991f9, #dab5f7);
            transform: scale(1.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(160, 90, 230, 0.1);
        }

        th {
            background: linear-gradient(135deg, #b388eb, #cfa6f7);
            color: white;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #e6d6fb;
            text-align: center;
            color: #4a3b5a;
        }

        tr:nth-child(even) {
            background: rgba(245, 238, 255, 0.7);
        }

        tr:hover {
            background: rgba(230, 214, 255, 0.6);
            transition: 0.2s;
        }

        #contenido td {
            font-size: 0.95em;
        }

        /* Pequeño footer */
        footer {
            text-align: center;
            color: #6f4cae;
            font-size: 0.9em;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🐶✨ Buscador de Perritos</h1>

        <div class="api-url">
            <input type="text" id="ruta_api" value="http://localhost:8888/mascotas/" hidden>
        </div>

        <!-- Formulario -->
        <form id="frmApi">
            <input type="text" name="token" id="token" value="" hidden>

            <label for="data">🔍 Buscar perrito:</label>
            <input type="text" name="data" id="data" placeholder="Escribe el nombre del perrito...">

            <div class="filtros">
                <div>
                    <label>🐾 Raza:</label>
                    <select id="raza" name="raza">
                        <option value="">Todas</option>
                        <option value="Labrador">Labrador</option>
                        <option value="Poodle">Poodle</option>
                        <option value="Bulldog">Bulldog</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Husky">Husky</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div>
                    <label>💗 Género:</label>
                    <select id="genero" name="genero">
                        <option value="">Todos</option>
                        <option value="Macho">Macho</option>
                        <option value="Hembra">Hembra</option>
                    </select>
                </div>
            </div>

            <button type="button" onclick="llamar_api()">🐕 Buscar Perritos</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Edad</th>
                    <th>Peso</th>
                    <th>Color</th>
                    <th>Género</th>
                    <th>Vacunado</th>
                </tr>
            </thead>
            <tbody id="contenido">
                <!-- Aquí se mostrarán los perritos -->
            </tbody>
        </table>

        <footer>🐾 Hecho con amor para los perritos 💜</footer>
    </div>

    <script src="<?php echo BASE_URL; ?>src/views/js/api.js"></script>
</body>
</html>
