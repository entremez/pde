<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="UTF-8">
	<title>Recomendación | PDE</title>
</head><body>
	<style>



@font-face {
    font-family: 'Barlow';
    src: url('{{ storage_path('/fonts/Barlow-Bold.ttf')}}');
    font-weight: bold;
}
@font-face {
    font-family: 'BarlowR';
    src: url('{{ storage_path('/fonts/Barlow-Regular.ttf')}}');
    font-weight: 400;
}

	html, body {
    display: block;
     font-family: 'BarlowR';
     margin-bottom: 15px;
     margin-left: 4%;
     margin-right: 0;
     margin-top: 20px;
     color: #000033;
}
.display-header,
.response-header{
      background-color: #000033;
      color: white;    
      background-size: cover;
      width: 100%;
      text-align: center;
}

.font-regular{
	font-size: 13px; font-family: 'BarlowR'; font-weight: 400;
}
.font-bold{
	font-size: 13px; font-family: 'Barlow'; font-weight: bold;
}

.padding-title{
	padding-top: 1px;
	padding-bottom: 5px;
	font-size: 14px;
}
.container{
	width: 100%;
}
.left,
.right{
	position: relative;
	width: 45%;
	float:left;
}

.center{
	width: 2%;
	float:left;
}


.same-level{
	color: gray;
	font-size: 11px;
}
.providers-title{
	padding-left: 15px;
	padding-right: 15px;
	text-align: center;
}

.providers-image{
	width: 100%;
    vertical-align: middle;
    text-align: center;
    margin:0 auto;
}

.text-center{
	text-align: center;
	margin: 0 auto;
}

.web{
	margin-top: 0px;
	padding-top: 0;
	font-size: 9px;
}

.text-center > .font-bold{
	font-size: 10px;
}
</style>
	<div style="height: 70px; margin-bottom: 10px; margin-right: 8%">
		<table width="100%">
				<tr>
					<td>
						<img height="69px" src="images/logo-bp-0051.png" style="text-align: left;">
						<div style="text-align: center; margin-top: -50px">{{ $company }}</div>
					</td>
				</tr>
		</table>
	</div>

	<div class="left" >
		<div class="font-bold">
			<div class="response-header" >
			    <div class="padding-title">Resultado de Evaluación</div>
			</div>
		</div>
			<table>
				<tr >
					<td width="60%" height="160px" style="margin-top: 10px">
						<p class="date font-regular">{{ $date }}</p>
						<p class="font-regular">Actualmente <span class="font-bold">{{ $phrase }}</span></p>
					</td>
					<td width="40%"  height="160px">
						<img height="120px" src="images/stairs/{{ $image }}" alt="" style="margin-top: 30px; margin-left: 20px">	
					</td>
				</tr>
			</table>
		<div class="font-bold" style="margin-top: 15px">
			<div class="response-header" >
			    <div class="padding-title">Recomendaciones</div>
			</div>
		</div>
		<table>
			<tr>
				<th width="60%">
					<p class="font-regular"><span class="font-bold">Si quieres mejorar tu negocio </span>mediante el uso de diseño en el ámbito de {{ $area }} <span class="font-bold">te recomendamos utilizar {{ $service }}.</span></p>
				</th>
				<th width="40%">
					<img  height="100px" src="images/areas/{{ $imageArea }}" alt="" style="margin-top: 20px; margin-left: 30px">	
				</th>
			</tr>
		</table>
		<div class="font-bold" style="margin-top: 15px">
			<div class="response-header" >
			    <div class="padding-title">Proveedores</div>
			</div>
		</div>
		<p class="font-regular providers-title">Los proveedores presentes en esta plataforma que ofrecen este tipo de servicio son:</p>


		@include('partials/pdf/grid-'.$providers->count())

		<p class="same-level text-center" style="padding-top: 20px">Puedes encontrar más proveedores que ofrezcan este servicio en www.puentedisenoempresa.cl</p>
	</div>
	<div class="center">
	</div>
	<div class="right">
		<div class="font-bold">
			<div class="response-header" >
			    <div class="padding-title">Viaje del uso de diseño</div>
			</div>
		</div>
		<div>
		<div style="width:100%">
			<img src="images/travel.png" width="100%">
		</div>
</div>
		<div class="font-bold" style="margin-top: 15px">
			<div class="response-header" >
			    <div class="padding-title">Formas de Financiamiento</div>
			</div>
		</div>
		<table>
			<tr>
				<td>
					<div class="font-regular providers-title">Cifras extranjeras muestran que <span class="font-bold">el retorno del diseño es aproximadamente 20 veces la inversión.</span> Invertir en diseño te conviene.</div>
				</td>
			</tr>
			<tr>
				<td height="39px">
					<p class="same-level text-center" style="color: initial; padding-top: 30px;">Si no cuentas con los recursos existen múltiples instrumentos públicos y privados que podrían ayudarte a financiar diseño. Entre ellos están:</p>
				</td>
			</tr>
		</table>
					<table width="100%" style="margin-top: 50px">
						<tr>
							<td width="50%" height="50px">
								<div class="providers-image">
								<img  height="50px" src="images/areas/venta-postventa.png">
								</div>
							</td>
							<td width="50%" height="50px">
								<div class="providers-image">
								<img  height="50px" src="images/areas/venta-postventa.png">
								</div>
							</td>
						</tr>
						<tr>
							<td width="50%" height="50px">
								<div class="text-center">
									<div class="font-bold">Nombre de Financiamiento</div>
									<div class="web font-regular">www.financiamiento.cl</div>
								</div>
							</td>
							<td width="50%" height="50px">
								<div class="text-center">
									<div class="font-bold">Nombre de Financiamiento</div>
									<div class="web font-regular">www.financiamiento.cl</div>
								</div>
							</td>
						</tr>
					</table>
					<div style="margin-top: 20px; height:35px"class="same-level text-center">Puedes encontrar más instrumentos y formas de financiamiento en www.puentedisenoempresa.cl</div>		
	</div>
</body></html>
