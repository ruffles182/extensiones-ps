<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Responsiva de Equipo de Trabajo</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}" type="text/css">
</head>
<body>
    <div class="titulo">
        CARTA RESPONSIVA POR LA ENTREGA Y USO DE EQUIPO DE TRABAJO<br>
        PROPIEDAD DE POSITIVO S+ IT SOLUTIONS, S.A. DE C.V.
    </div>

    <p><strong>Guadalajara, Jalisco</strong><br>
    <strong>Fecha:</strong> 
        @if(!empty($fecha))
            {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
        @endif

    </p>

    <p>Por medio de la presente, el suscrito, cuyos datos de identificación se exponen a continuación, 
    declaro que es mi responsabilidad la salvaguarda y custodia del equipo y/o herramientas de trabajo 
    que se describen más adelante (en adelante, el "Equipo de Trabajo").</p>

    <div class="seccion">
        <h3>DATOS DE IDENTIFICACIÓN DEL RESPONSABLE DEL EQUIPO DE TRABAJO ENTREGADO</h3>

        <table class="tabla-agente">
            <tr>
                <td>Nombre:</td>
                <td>{{ $nombre_responsable }}</td>
            </tr>
            <tr>
                <td>Tipo de identificación:</td>
                <td>{{ $tipo_identificacion ?? '' }}</td>
            </tr>
            <tr>
                <td>Número de identificación:</td>
                <td>{{ $numero_identificacion ?? '' }}</td>
            </tr>
            <tr>
                <td>Domicilio:</td>
                <td>{{ $domicilio ?? '' }}</td>
            </tr>
        </table>
    </div>

    <div class="seccion">
        <h3>CARACTERÍSTICAS Y DESCRIPCIÓN DEL EQUIPO DE TRABAJO ENTREGADO</h3>

        <table class="tabla-datos">
            <tr>
                <td>Tipo de equipo y/o herramienta de trabajo entregada:</td>
                <td>{{ $tipo_equipo }}</td>
            </tr>
            <tr>
                <td>Marca:</td>
                <td>{{ $marca }}</td>
            </tr>
            <tr>
                <td>Modelo:</td>
                <td>{{ $modelo }}</td>
            </tr>
            <tr>
                <td>Número de serie:</td>
                <td>{{ $numero_serie }}</td>
            </tr>
            <tr>
                <td>Color:</td>
                <td>{{ $color }}</td>
            </tr>
            <tr>
                <td>Accesorios:</td>
                <td>{{ $accesorios }}</td>
            </tr>
            <tr>
                <td>Número de inventario:</td>
                <td>{{ $numero_inventario }}</td>
            </tr>
            <tr>
                <td>Valor:</td>
                <td>${{ number_format($valor ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td>Fecha de devolución:</td>
                <td>
                    @php
                        $entrega = strtolower(trim($fecha_entrega_final ?? ''));
                    @endphp

                    @if(in_array($entrega, ['indefinida', 'indefinido', 'indeterminada', 'indeterminado']))
                        Indefinido
                    @elseif(!empty($entrega))
                        {{ \Carbon\Carbon::createFromFormat('d/m/Y', $fecha_entrega_final)->format('d/m/Y') }}
                    @else
                        —
                    @endif

                </td>
            </tr>
        </table>
    </div>

    <div class="seccion">
        <p>El suscrito manifiesto que me encuentro conforme con la descripción del Equipo de Trabajo 
        mencionado anteriormente y reconozco que la propiedad de éste pertenece a POSITIVO S+ IT SOLUTIONS, S.A. DE C.V 
        (en lo sucesivo, "Positivo S+"), que el mismo se encuentra en óptimas condiciones de uso y con todos 
        los accesorios necesarios, tales como sus componentes periféricos, los programas operativos adecuados, 
        las aplicaciones apropiadas, etc., para poder operarlo de manera eficiente para las actividades laborales 
        que se me encomienden, por lo que, en caso de alguna descompostura o falla del equipo al momento de la 
        devolución del mismo, será mi responsabilidad cubrir los gastos necesarios para su reparación.</p>

        <p>De la misma forma, declaro que el uso dado al Equipo de Trabajo estará únicamente relacionado con 
        mis funciones como empleado de Positivo S+ y que Positivo S+ está plenamente autorizado para monitorear 
        y vigilar las funciones y actividades que son realizadas mediante el Equipo de Trabajo, así como los 
        archivos que en él se descarguen y/o se envíen del mismo.</p>

        <p>Manifiesto que seré responsable de la salvaguarda del Equipo de Trabajo entregado, manteniéndolo 
        siempre en buenas condiciones, así como respondiendo por cualquier avería y/o desperfecto que sufra 
        derivado del mal uso que se le pueda dar al Equipo de Trabajo. En virtud de lo anterior, en caso de 
        que el Equipo de Trabajo requiera algún tipo de reparación o, en su defecto, una sustitución, y la 
        causa de ello sea un error provocado por negligencia y/o mal uso del Equipo de Trabajo, desde este 
        momento autorizo a Positivo S+ a realizar los descuentos correspondientes a mi nómina para cubrir los 
        gastos generados, de conformidad con el artículo 110 de la Ley Federal del Trabajo.</p>

        <p>En caso de extravío, robo o daño parcial o total del equipo, me comprometo a dar pronto aviso a 
        mi superior jerárquico inmediato.</p>

        <p>Me comprometo a devolver el Equipo de Trabajo a Positivo S+ en el momento en que me sea indicado. 
        Al momento de dicha devolución, el Equipo de Trabajo deberá encontrarse en las mismas condiciones en 
        las que me fue entregado en un principio, sin tomar en cuenta el desgaste natural por el uso razonable 
        y el paso del tiempo.</p>

        <p>Asumo también el compromiso de operar el equipo aquí descrito con precaución. Asimismo, acepto 
        cualquier futura responsabilidad civil y/o penal que derive por mi negligencia y/o mal uso de este. 
        De cualquier controversia derivada del uso dado por mi persona al Equipo de Trabajo.</p>

        <p>En consecuencia, eximo de responsabilidad a Positivo S+ por cualquier daño relacionado a lo anterior 
        y me obligo a sacar en paz y a salvo y/o a indemnizar a Positivo S+.</p>
    </div>

    <div class="centrado">
        <table class="firmas">
            <tr>
                <td>
                    <div class="firma">
                        POSITIVO S+, S.A. DE C.V.<br>
                        Representado en este acto por:<br>
                        <strong>ZELHICA JOCELYN LANDERO MERCADO</strong>
                    </div>
                </td>
                <td>
                    <div class="firma">
                        {{ strtoupper($nombre_responsable) }}<br>
                        Por derecho propio
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>