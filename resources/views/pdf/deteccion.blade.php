<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page { margin: 1cm 2cm 2cm 2cm;}
        body {
            /*border: 1px solid #000;*/
            font-family: "Arial", Helvetica, sans-serif;
        }
        .page_break {
            page-break-after: always;
        }
        .footer {
            width: 100%;
            position: fixed;
            bottom: 0.1cm;
        }

        .footer p {
            font-size: 9pt;
        }
        .preFooter{
            width: 100%;
            position: fixed;
            bottom: 1.1cm
        }
        .preFooter p {
            font-size: 9pt;
            font-family: "Tahoma", Geneva, sans-serif
        }
        .preFooter p a{
            font-weight: bold
        }

        .center {
            text-align: center;
            font-size: 10pt;
        }
        .leftAlinement{
            text-align: left;
            font-size: 10pt;
        }

        .uline {
            border-bottom: 1px solid #000;
        }

        .tline {
            border-top: 1px solid #000;
        }

        .header {
            width: 100%;
            text-align: center;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 25px;
        }

        .header p {
            margin: 0;
            font-size: 12pt;
            margin-bottom: 10px;
        }

        .logo {

            position: fixed;
            top: 0;
            left: 0;
        }
        .logo img{
            width: 52px;
            margin-left: 35px;
            margin-top: 14px;
        }

        #title {
            font-size: 10pt;
            font-weight: bold;
            /* text-justify:inter-word; */
        }
        .titleCentered p{
            font-size: 10pt;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }

        .espacio{
            margin-bottom: 20px;
        }
        .titles {
            font-size: 10pt;
            font-weight: 500;
            white-space: nowrap;
        }

        .content {
            font-size: 10pt;
            font-weight: 700;
        }

        .infoTitles {
            width: 100%;
            margin-bottom: 1pt;
            font-size: 11pt;
            font-weight: bold;
            text-align: center;
            background-color: lightgrey;
        }

        .titulo{
            width: 95%;
            margin-bottom: 19pt;
            font-size: 10pt;
            font-weight: bold;
            text-align: justify;

        }

        .w100 {
            width: 100%;
        }

        .w90 {
            width: 90%;
            text-align: right;
        }

        .w50 {
            width: 50%;
        }
        .mb-3{
            margin-bottom: 30px;
        }
        .m-0 p{
            margin: 0;
        }

        .mt-5{
            padding-top: 25px;
        }
        .mb-2{
            margin-bottom: 19px;
        }
        .mb-l{
            margin-bottom: 17px;
        }
        table.custom {
            border: 1px solid #000000;
            border-collapse: collapse;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
        }
        table.custom td, table.custom th {
            border: 1px solid #000000;
            padding: 5px 4px;
        }
        table.custom tbody td {
            font-size: 13px;
            width: 100%;
        }
        table.custom thead {
            background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            border-bottom: 1px solid #000000;
        }
        table.custom thead th {
            font-size: 13px;
            color: #000000;
            text-align: left;
            font-weight: inherit;
        }
        table.custom tfoot {
            font-size: 14px;
            font-weight: bold;
            color: #000000;
            border-top: 3px solid #000000;
        }
        table.custom tfoot td {
            font-size: 14px;
        }

        table.customA  {
            border: 1px solid #000000;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            font-family: Arial,Helvetica Neue,Helvetica,sans-serif;
        }
        table.customA td, table.customA th {
            border: 1px solid #000000;
            padding: 5px 4px;
        }
        table.customA tbody tr th {
            font-size: 10px;
            text-align: center;
            font-weight: inherit;
        }
        table.customA thead {
            text-anchor: middle;
            background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            border-bottom: 1px solid #000000;
        }
        table.customA thead th {
            font-size: 10px;
            text-anchor: middle;
            color: #000000;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="w100">
        <div class="header">
            <p>INSTITUTO TECNOLÓGICO DE TUXTLA GUTIÉRREZ</p>
        </div>

    <div class="logo">
        <img src="./resources/img/logopdf.png">
    </div>
    <div class="titleCentered espacio">
        <p >Subdirección Académica</p>
        <p >Departamento Académico:  {{  }} </p>
    </div>
    <div class="titleCentered mb-3">
        <p>DIAGNÓSTICO DE NECESIDADES DE</p>
        <p>FORMACIÓN Y ACTUALIZACIÓN PROFESIONAL DOCENTE </p>
    </div>
    <div class="leftAlinement m-0 mb-2">
        <p  id="title">PARA LOS(AS) PROFESORES(AS) DE LA ACADEMIA DE  {{  }} </p>
        <p>Fecha de realización del diagnóstico: {{ date('Y-m-d') }} </p>
    </div>

    <div class="mb-l">
        <div class="leftAlinement m-0">
            <p>Jefe (a)  del Departamento Académico</p>
        </div>
        <table class="custom">
            <thead>
            <tr>
                <th >Nombre</th>
                <th >Firma</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td > {{  }} </td>
                <td> </td>
            </tr>
            </tbody>

        </table>
    </div>
    <div class="mb-l">
        <div class="leftAlinement m-0">
            <p>Presidente (s) de Academia</p>
        </div>
        <table class="custom">
            <thead>
            <tr>
                <th >Nombre</th>
                <th >Firma</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> {{  }} </td>
                <td>  </td>
            </tr>
            </tbody>

        </table>
    </div>
    <div class="titulo">

        <p>
            a)     PRIORIZAR LAS DIMENSIONES DE LA EVALUACIÓN DOCENTE EN LAS QUE
            REQUIERE LA FORMACIÓN DOCENTE DE EL/LA PROFESOR(A), AVALADOS
            POR LA ACADEMIA
        </p>
    </div>

    <table class="customA">
        <thead>
        <tr>
            <th>Dimensión(es) en la(s) que se requiere Formación Docente</th>
            <th>Competencia(s) en la(s) que se requiere la Formación Docente</th>
            <th>Número de profesores(as) que requieren Formación Docente</th>
            <th>Periodo en el que se requiere la Formación Docente (enero-junio o agosto-diciembre) </th>
            <th>Facilitador (a) que impartirá el curso/taller</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th>  </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
            </tr>
        </tbody>
    </table>

    <div class="titulo">

        <p>
            b)	PRIORIZAR LAS ASIGNATURAS EN LAS QUE REQUIERE ACTUALIZACIÓN
            PROFESIONAL DE EL/LA PROFESOR(A), AVALADOS POR LA ACADEMIA.
        </p>
    </div>
    <div class="w100">
        <table class="customA ">
            <thead>
            <tr>
                <th>Asignaturas en la que se requiere formación o actualización</td>
                <th>Contenidos temáticos en que se requiere la formación o actualización</td>
                <th>Número de profesores(as) que la requieren</td>
                <th>Periodo en el que se requiere la formación o actualización </td>
                <th>Facilitador (a) que impartirá el curso/taller</td>
            </tr>
            </thead>
                <tbody>
                    <tr>
                        <td>  </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                </tbody>
        </table>
        <div class="preFooter">
            <p>
                <a>Nota: </a> La formación docente estará atendida prioritariamente con el Programa Nacional de Formación Docente Centrado en el Aprendizaje (Formación DOCA)
            </p>
        </div>
        <div class="footer" style="padding-top:10px">
            <!--  i will make this dinamic for sure -->
            <p style="display:inline;float:left"> aqui folio </p>
            <p style="display:inline;float:right"> aqui numero de revision </p>
        </div>
    </div>
</div>
<div class="page_break"></div>
<div>
</div>
<div class="w100">
    <div class="logo">
        <img src="img/logodocs.png">
    </div>
    <div class="header">
        <p >INSTITUTO TECNOLÓGICO DE TUXTLA GUTIÉRREZ</p>
    </div>

    <div class="titleCentered mb-3 ">
        <p> CONCENTRADO DEL DIAGNÓSTICO DE NECESIDADES DE </p>
        <p> FORMACIÓN Y ACTUALIZACIÓN PROFESIONAL DOCENTE  </p>
    </div>
    <div class="titulo">

        <p>
            c)  ACTIVIDADES O EVENTOS QUE SE LLEVARÁN A CABO PARA LA FORMACIÓN
            DOCENTE DE EL/LA PROFESOR(A) EN LAS DIMENSIONES DE LA EVALUACIÓN
            DOCENTE.

        </p>
    </div>
    <table class="customA ">
        <thead>
        <tr>
            <th> Nombre del curso, taller, conferencias, etc. </td>
            <th> Fecha en que se realizará la actividad o evento </td>
            <th> Horario en que se realizará la actividad o evento </td>
            <th> Objetivo de la actividad o evento  </td>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th>  </th>
                <th> </th>
                <th> </th>
                <th> </th>
            </tr>
        </tbody>

    </table>

    {{-- ultima tabla especialidad --}}

    <div class="titulo">

        <p>
            d)	ACTIVIDADES O EVENTOS QUE SE LLEVARÁN A CABO PARA LA
            ACTUALIZACIÓN PROFESIONAL DE EL/LA PROFESOR(A) EN ASIGNATURAS
            QUE SE REQUIEREN.
        </p>
    </div>
    <table class="customA ">
        <thead>
        <tr>
            <th> Nombre del curso, taller, conferencias, etc. </td>
            <th> Fecha en que se realizará la actividad o evento </td>
            <th> Horario en que se realizará la actividad o evento </td>
            <th> Objetivo de la actividad o evento  </td>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
            </tr>
        </tbody>
    </table>

    <div class="mb-l mt-5">
        <div class="leftAlinement m-0">
            <p> Subdirección Académica </p>
        </div>
        <table class="custom">
            <thead>
            <tr>
                <th >Nombre</th>
                <th >Firma</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td >  {{  }} </td>
                <td> </td>
            </tr>
            </tbody>

        </table>
    </div>
    <div class="mb-l">
        <div class="leftAlinement m-0">
            <p> Jefes(as) de Departamento Académico </p>
        </div>
        <table class="custom">
            <thead>
            <tr>
                <th> Nombre </th>
                <th> Departamento </th>
                <th> Firma </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            </tbody>

        </table>
    </div>
    <div class="preFooter">
        <p>
            <a>Nota: </a> La formación docente estará atendida prioritariamente con el Programa Nacional de Formación Docente Centrado en el Aprendizaje (Formación DOCA)
        </p>
    </div>
    <div class="footer" style="padding-top:10px">
        <!--  i will make this dinamic for sure -->
        <p style="display:inline;float:left"> aqui folio </p>
        <p style="display:inline;float:right"> aqui revicion </p>
    </div>
</div>
</body>
</html>
