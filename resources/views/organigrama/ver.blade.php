{{-- resources/views/organigrama/ver.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Organigrama</title>
    <!-- Cargar la librería de Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <h1>Mi Organigrama</h1>


    <div id="organigrama_div"></div>

    <script type="text/javascript">
        // Si count() daba > 0, continuamos con Google Charts
        google.charts.load('current', { packages: ["orgchart"] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Nombre');
            data.addColumn('string', 'Padre');
            data.addColumn('string', 'ToolTip');

            data.addRows([
                @foreach($puestos as $p)
                    [
                        // 'v' = valor interno (ID), 'f' = contenido (HTML) que se mostrará
                        { v: '{{ $p->id }}',
                          f: '<div style="font-weight:bold; padding:4px;">{{ $p->nombre }}</div>'
                        },
                        @if($p->parent_id)
                            '{{ $p->parent_id }}',
                        @else
                            '',
                        @endif
                        '{{ $p->nombre }}'
                    ]@if(!$loop->last),@endif
                @endforeach
            ]);

            var chart = new google.visualization.OrgChart(document.getElementById('organigrama_div'));
            chart.draw(data, {
                allowHtml: true,
                nodeClass: 'org-node'
            });
        }
    </script>

    <style>
        /* Solo para que veas algo de estilo en el organigrama */
        .org-node {
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            padding: 4px;
            font-family: sans-serif;
        }
    </style>
</body>
</html>
