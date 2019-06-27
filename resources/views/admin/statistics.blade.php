
@extends('layouts.puente')
@section('title', 'PDE | Estadistica')



@section('title-statistics', 'active-menu')



@section('content')

@include('partials/menu')


<div class="after-menu"></div>
<div class="col-md-10 offset-md-1 mt-5">

		<h3>Empresas demanda</h3>

	<table id="table_id" class="display">
	    <thead>
	        <tr>
	            <th>Nombre</th>
	            <th>Mail cuenta</th>
	            <th>Rut</th>
	            <th>Dirección</th>
	            <th>Telefono</th>
	            <th>Área</th>
	            <th>Empleados</th>
	            <th>Ganancias</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach($companies as $company)
	        <tr>
	            <td>{{ $company->name }}</td>
	            <td>{{ $company->email }}</td>
	            <td>{{ $company->getRut() }}</td>
	            <td>{{ $company->address }}</td>
	            <td>{{ $company->phone }}</td>
	            <td>{{ $company->classification->classification }}</td>
	            <td>{{ $company->employees->range }}</td>
	            <td>{{ $company->gain->range }}</td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>

	<h3 class="mt-3">Resumen</h3>

		Empresas inscritas: {{ $companies->count() }}

		<div id="sector" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>		
		<div id="region" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
		<h4>Autoevaluación</h4>
		<input type="hidden" id="max" value="{{ $statements->count() }}">
		@php
			$count = 0;
		@endphp
		@foreach($statements as $key => $statement)
			@if($key < $statements->count()-5)
				<div class="my-5">
					<div class="text-center mt-1">{{ $statement->statement }}</div>
					<input type="hidden" id="data-{{ $key }}" value="{{ $statement->graph() }}">
					<div id="graph-{{ $key }}" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto" class="mb-3"></div>
				</div>
			@elseif($key == $statements->count()-1)
				<div class="text-center mt-1">{{ $statement->statement }}</div>
				@foreach($statement->options as $key2 => $option)
					<div class="my-5">
						
						<div class="text-center mt-1">{{ $option->option }}</div>
						<input type="hidden" id="data-bar-last-{{ $key2 }}" value="{{ $option->responses() }}">
						<div id="graph-bar-last-{{ $key2 }}" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto" class="mb-3"></div>
					</div>
					@php
						$count++;
					@endphp					
				@endforeach		
			@else
				<div class="text-center mt-1">{{ $statement->statement }}</div>
				@foreach($statement->options as $option)
					<div class="my-5">
						
						<div class="text-center mt-1">{{ $option->option }}</div>
						<input type="hidden" id="data-bar-{{ $count }}" value="{{ $option->responses() }}">
						<div id="graph-bar-{{ $count }}" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto" class="mb-3"></div>
					</div>
					@php
						$count++;
					@endphp					
				@endforeach	
			@endif
		@endforeach


		<input type="hidden" id="sectors" value="{{$companies[0]->sector()}}">
		<input type="hidden" id="regions" value="{{$regions}}">

</div>




@include('partials/footer')
@endsection

@section('scripts')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">  
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
<script>

Highcharts.chart('sector', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '% de empresas en cada rubro'
    },
    tooltip: {
        pointFormat: 'N° de empresas: <b>{point.y}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Sector',
        colorByPoint: true,
        data: $.parseJSON($('#sectors').val())
    }]
});

Highcharts.chart('region', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '% de empresas por región'
    },
    tooltip: {
        pointFormat: 'N° de empresas: <b>{point.y}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Sector',
        colorByPoint: true,
        data: $.parseJSON($('#regions').val())
    }]
});

var max = $('#max').val();
for (var i = 0; i < max-5; i++) {
	chart('graph-'+i, $('#data-'+i).val());
}

for (var i = 0; i < 18; i++) {
	chartBar('graph-bar-'+i, $('#data-bar-'+i).val(), '');
}

for (var i = 0; i < 4; i++) {
	chartBarLast('graph-bar-last-'+i, $('#data-bar-last-'+i).val(), '');
}


function chartBar(id, data, title){
	Highcharts.chart(id, {
    chart: {
        type: 'column'
    },
    title: {
        text: title
    },
    xAxis: {
        categories: [
            '1<br>Para nada',
            '2',
            '3',
            '4',
            '5<br>Si, absolutamente',
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Respuestas'
        }
    },
    tooltip: {
        headerFormat: '<table>',
        pointFormat: '<tr>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
    	showInLegend: false,
        data: $.parseJSON(data)

    }]
});
}

function chartBarLast(id, data, title){
	Highcharts.chart(id, {
    chart: {
        type: 'column'
    },
    title: {
        text: title
    },
    xAxis: {
        categories: [
            '1',
            '2',
            '3',
            '4',
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Respuestas'
        }
    },
    tooltip: {
        headerFormat: '<table>',
        pointFormat: '<tr>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
    	showInLegend: false,
        data: $.parseJSON(data)

    }]
});
}


function chart(id, data){
	return Highcharts.chart(id, {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text:''
    },
    tooltip: {
        pointFormat: 'N°Empresas: <b>{point.y}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Sector',
        colorByPoint: true,
        data: $.parseJSON(data)
    }]
});
}


</script>
@endsection