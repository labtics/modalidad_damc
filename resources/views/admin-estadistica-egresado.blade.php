@extends('layouts.app')

@section('title') 
  Modalidad
@endsection


@section('contenido') 

<link rel="stylesheet" href="{{asset('css/caja_azul.css')}}">
<style type="text/css" media="screen">

table {
   margin: auto;
   width: 100%;
   border: 1px solid #5ABA47;


}
th, td {
   width: 0%;
   text-align: center;
   vertical-align: top;
   padding: 0.3em;
   caption-side: bottom;
}

th {
   background: #5ABA47;
    color: #fff;
    vertical-align: top;
}

p{
   font-weight: bold;
 }

</style>

 <center><p class="caja"> ESTADÍSTICAS DESCRIPTIVAS </p> </center>
  <br>

  

<form action="{{route('modalidad.estadisticaDinamica')}}" method="get">
<div class="col-md-6">
    <div class="form-group">  
        <select class="form-control" name="pe" id="pe">
                <option value=""> Selecciona Programa Educativo </option>
                <option value="lmc"> Médico Cirujano</option>
                <option value="le"> Enfermería</option>
                <option value="lrf"> Rehabilitación Física</option>
                <option value="lapyd"> Atención Prehospitalaria y Desastres</option>
                <option value="todos"> Todos</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group"> 
        <select class="form-control" name="ciclo" id="ciclo">
                <option value=""> Selecciona Ciclo Escolar </option>
                <option value="09"> 2009</option>
                <option value="10"> 2010</option>
                <option value="11"> 2011</option>
                <option value="12"> 2012</option>
                <option value="13"> 2013</option>
                <option value="14"> 2014</option>
                <option value="15"> 2015</option>
                <option value="16"> 2016</option>
                <option value="17"> 2017</option>
                <option value="18"> 2018</option>
                <option value="todos"> Todos</option>
        </select>
    </div>
</div>  
<div class="col-md-12">
        <div class="form-group">
                 <button class="btn btn-warning" > <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar </button>
        </div>
</div>
</form>
<form action="{{route('modalidad.estadistica')}}" method="get">  
    <div class="col-md-6">
            <div class="form-group">
                <div id="container1"></div>
                <p class="highcharts-description"> </p>
            </div>
    </div>

    <div class="col-md-6">
            <div class="form-group">
                <div id="container2"></div>
                <p class="highcharts-description"> </p>
            </div>
    </div>
    
    <div class="col-md-6">
            <div class="form-group">
                <div id="container3"></div>
                <p class="highcharts-description"> </p>
            </div>
    </div>

    <div class="col-md-6">
            <div class="form-group">
                <div id="container4"></div>
                <p class="highcharts-description"> </p>
            </div>
        </div>

    <div class="col-md-6">
            <div class="form-group">
                <div id="container5"></div>
                <p class="highcharts-description"> </p>
            </div>
    </div>


    <div class="col-md-6">
            <div class="form-group">
                <div id="container6"></div>
                <p class="highcharts-description"> </p>
            </div>
    </div>

    <div class="col-md-6">
            <div class="form-group">
                <div id="container7"></div>
                <p class="highcharts-description"> </p>
            </div>
    </div>
    <div class="col-md-6">
            <div class="form-group">
                <div id="container8"></div>
                <p class="highcharts-description"> </p>
            </div>
    </div>
</form>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>


//GRAFICO SOLICITUDES EN PROMEDIO POR MES

Highcharts.chart('container1', {
    chart: {
        type: 'area'
    },
    title: {
        align: 'center',
        text: 'Solicitudes en promedio por mes'
    },
    subtitle: {
        align: 'left',
        //text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },

    xAxis: {

       categories:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto','Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
    },
    yAxis: {
        title: {
            text: 'Promedio de solicitudes'
        }
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        area: {
            marker: {
                enabled: true,
                symbol: 'circle',
                radius: 4,
                states: {
                    hover: {
                        enabled: true
                
                    }
                }
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:5px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Solicitudes<br/>'
    },
    series: [
        {
            name: 'Meses',
            data: <?= $jsonDataMes ?>
        }
    ]
    
});

//GRAFICO SOLICITUDES EN PROMEDIO POR DIA

Highcharts.chart('container2', {
    chart: {
        type: 'line'
    },
    title: {
        align: 'center',
        text: 'Solicitudes en promedio por día'
    },
    subtitle: {
        align: 'left',
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {

       categories:['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
    },
    yAxis: {
        title: {
            text: 'Promedio de solicitudes'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        area: {
            marker: {
                enabled: true,
                symbol: 'circle',
                radius: 4,
                states: {
                    hover: {
                        enabled: true
                
                    }
                }
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:5px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Solicitudes<br/>'
    },
    series: [
        {
            name: 'Dias',
            data: <?= $jsonDataDia ?>
        }
    ]
    
});

//GRAFICO SOLICITUDES POR MODALIDADES DE TITULACIÒN

Highcharts.chart('container3', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 'Solicitudes por Modalidaes de Titulación'
    },
    subtitle: {
        align: 'left',
        //text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Número de solicitudes'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:5px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Solicitudes<br/>'
    },

    series: [
        {
            name: 'Modalidades de Titulación',
            colorByPoint: true,
            data: <?= $jsonDataModalidad ?>
        }
    ]
    
});
       
//GRAFICO SOLICITUDES POR PROGRAMAS EDUCATIVOS

Highcharts.chart('container4', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Solicitudes por Programas Educativos',
        align: 'center'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Solicitudes',
        data: <?= $jsonDataModalidad_Licenciatura ?>
    }]
});

//GRAFICO MODALIDADES DE TITULACIÓN POR PROMEDIOS
var promedios = {!! $jsonDataPromedio !!};
    
Highcharts.chart('container5', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Modalidades de titulación por promedios',
        align: 'center'
    },
    subtitle: {
        text: 'Source: <a ' +
            'href="https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population"' +
            'target="_blank">Wikipedia.org</a>',
        align: 'left'
    },
    xAxis: {
        categories: ['Artículo','Tesis', 'Promedio', 'Resolucion', 'CENEVAL', 'EGC', 'Diplomado', 'Maestría'],
        title: {
            text: 'Promedios'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' puntos'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 3,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Diez',
        data: promedios.map(function(item) { return item.diez })
    }, 
    
    {
        name: 'Nueve',
        data: promedios.map(function(item) { return item.nueve })
    }, 
    
    {
        name: 'ocho',
        data: promedios.map(function(item) { return item.ocho })
    }, 
    
    {
        name: 'Siete',
        data: promedios.map(function(item) { return item.siete })
    }
    ]
});
//GRAFICO EGRESADOS CON ACTIVIDAD LABORAL POR MODALIDADES DE TITULACIÓN

Highcharts.chart('container6', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 'Egresados con actividad laboral por modalidades de titulación'
    },
    subtitle: {
        align: 'left',
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Cantidad de egresados con actividad laboral'
        }
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:5px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Solicitudes<br/>'
    },

    series: [
        {
            name: 'Modalidades de Titulación',
            colorByPoint: true,
            data: <?= $jsonDataActividadLaboral?>
        }
    ]
    
});

// GRAFICO POR ESTADO CIVIL
Highcharts.chart('container7', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: true,
        type: 'pie'
    },
    title: {
        text: 'Estado Civil',
        align: 'center'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Estado Civil',
        data: <?= $jsonDataEstadoCivil ?>
    }]
});

//-------------------------------------------------------------
var EstadoCivilActividadLaboral = {!! $jsonEstadosCivilesActsLabs!!};
    
Highcharts.chart('container8', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Actividades laborales por estado civil',
        align: 'center'
    },
    subtitle: {
        text: 'Source: <a ' +
            'href="https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population"' +
            'target="_blank">Wikipedia.org</a>',
        align: 'left'
    },
    xAxis: {
        categories: ['No Laboran','Si Laboran'],
        title: {
            text: 'Actividad Laboral'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: 'Egresados'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 3,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Soltero',
        data: EstadoCivilActividadLaboral.map(function(item) { return item.soltero })
    }, 
    {
        name: 'Casado',
        data: EstadoCivilActividadLaboral.map(function(item) { return item.casado })
    },
    {
        name: 'Separado',
        data: EstadoCivilActividadLaboral.map(function(item) { return item.separado })
    },
    {
        name: 'Viudo',
        data: EstadoCivilActividadLaboral.map(function(item) { return item.viudo })
    },
    {
        name: 'Unión Libre',
        data: EstadoCivilActividadLaboral.map(function(item) { return item.union_libre})
    }
    ]
});



</script>

@endsection