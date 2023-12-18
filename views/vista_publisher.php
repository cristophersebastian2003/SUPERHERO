<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MDEwDxPPrPWCrNDK88Fpzo3lDojGlw5e6Z/uPO/QO2IqTggdK4bSSUnQlmh/jp9" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2.display-4 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        label.form-label {
            font-weight: bold;
        }

        #selectEditor {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        #selectEditor:hover {
            border-color: #495057;
        }

        .table-container {
            margin-top: 20px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            margin-top: 20px;
            width: 100%; /* Establecer el ancho de la tabla al 100% */
            font-size: 16px;
        }

        .table thead th {
            color: #ffffff;
            background-color: #007bff;
            border-color: #007bff;
            font-size: 18px;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #e9ecef;
        }

        @keyframes fadeInRow {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .table tbody tr {
            animation: fadeInRow 0.5s ease-out;
        }
        .btn-grafico {
            margin-top: 20px;
        }

        
        .btn-grafico-link {
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-grafico-link:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="container">
    <h2 class="display-4">PUBLISHER</h2>

    <div class="mb-3">
        <label for="selectEditor" class="form-label">Seleccionar Publisher:</label>
        <select id="selectEditor" class="form-select" onchange="cargarSuperheroesPorEditor()"></select>
    </div>
</div>

<div class="container table-container">
    <table id="tablaSuperheroes" class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Eye Colour</th>
                <th>Hair Colour</th>
                <th>Skin Colour</th>
                <th>Race</th>
                <th>Publisher</th>
                <th>Alignment</th>
                <th>Height (cm)</th>
                <th>Weight (kg)</th>
            </tr>
        </thead>
        <tbody id="tbodySuperheroes"></tbody>
    </table>
</div>
<a href="grafico_alignment.html" class="btn btn-primary btn-grafico-link">Ver Gráfico de Alignment</a>

<script>
document.addEventListener('DOMContentLoaded', function () {
    cargarOpcionesEditores();
});

function cargarOpcionesEditores() {
    fetch('../controllers/publisher.controller.php')
        .then(response => response.json())
        .then(data => {
            const selectEditor = document.getElementById('selectEditor');
            selectEditor.innerHTML = '';

            data.forEach(editor => {
                const option = document.createElement('option');
                option.value = editor.id;
                option.textContent = editor.publisher_name;
                selectEditor.appendChild(option);
            });

            cargarSuperheroesPorEditor();
        })
        .catch(error => console.error('Error:', error));
}

function cargarSuperheroesPorEditor() {
    const editorId = document.getElementById('selectEditor').value;

    fetch(`../controllers/superhero.controller.php?editorId=${editorId}`)
        .then(response => response.json())
        .then(data => {
            mostrarSuperheros(data);
        })
        .catch(error => console.error('Error:', error));
}

function mostrarSuperheros(superheroes) {
    const tbody = document.getElementById('tbodySuperheroes');
    tbody.innerHTML = '';

    superheroes.forEach(superhero => {
        let row = tbody.insertRow();
        row.insertCell(0).textContent = superhero.id;
        row.insertCell(1).textContent = superhero.superhero_name;
        row.insertCell(2).textContent = superhero.full_name;
        row.insertCell(3).textContent = superhero.gender_id;
        row.insertCell(4).textContent = superhero.eye_colour_id;
        row.insertCell(5).textContent = superhero.hair_colour_id;
        row.insertCell(6).textContent = superhero.skin_colour_id;
        row.insertCell(7).textContent = superhero.race_id;
        row.insertCell(8).textContent = superhero.publisher_id;
        row.insertCell(9).textContent = superhero.alignment_id;
        row.insertCell(10).textContent = superhero.height_cm;
        row.insertCell(11).textContent = superhero.weight_kg;
    });
}
</script>

</body>
</html>










