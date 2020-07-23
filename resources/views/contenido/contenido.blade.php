@extends('principal')
@section('contenido')

@if(Auth::check())
@if (Auth::user()->idrol == 1)

<template v-if="menu==0">
	{{-- <dashboard></dashboard> --}}
</template>

{{-- <template v-if="menu==1">
	<categoria-component/>
</template>

<template v-if="menu==2">
	<producto-component/>
</template>

<template v-if="menu==3">
	<compra></compra> 
</template>

<template v-if="menu==4">
	<proveedor-component/>
</template>

<template v-if="menu==5">
	{{-- <venta-component/> 
	</template>

	--}} <template v-if="menu==6">
		<cliente-component/>
	</template>
	
	<template v-if="menu==21">
		<vehiculo-component/>
	</template>
	
	

	<template v-if="menu==7">
		<user-component/>
	</template>

	
	<template v-if="menu==8">
		<rol-component/>
	</template>

	
	
	<template v-if="menu==11">
		<taller-component tipo_cuenta="{{ Auth::user()->idrol }}" id_cuenta="{{ Auth::user()->id }}"/>
		</template>
		<template v-if="menu==30">
			<v-app>
				<new-arrivals/>
			</v-app>
		</template>

		<template v-if="menu==12">
			<talleruser-component/>

		</template>

		@elseif (Auth::user()->idrol == 2)
		<template v-if="menu==0">
			{{-- <dashboard></dashboard> --}}
		</template>

		<template v-if="menu==1">
			<categoria-component/>
		</template>

		<template v-if="menu==2">
			<producto-component/>
		</template>

		<template v-if="menu==5">
			{{-- <venta-component/> --}}
		</template>
		<template v-if="menu==11">
			<taller-component  tipo_cuenta="{{ Auth::user()->idrol }}" id_cuenta="{{ Auth::user()->id }}"/>
			</template>
			<template v-if="menu==13">
				<arbol-component/>
			</template>
			{{--<template v-if="menu==14">
				Fallas a futuro
			</template>--}}
			<template v-if="menu==15">
				Presupuesto
			</template>
			<template v-if="menu==16">
				historial
			</template>
			<template v-if="menu==17">
				reparaciones
			</template>
			<template v-if="menu==20">
				
				<v-app>
					<cotizacion-component/>
				</v-app>
			</template>
			<template v-if="menu==21">
				<v-app>
					<reparacion-component tipo_cuenta="{{ Auth::user()->idrol }}" rut="{{ Auth::user()->num_documento }}"/>
				</v-app>
			</template>
			<template v-if="menu==40">
				<v-app>
					<historialcotizaciones-component rut="{{ Auth::user()->num_documento }}"> </historial-component>
				</v-app>
			</template>
			<template v-if="menu==22">
				<v-app>
					<historial-component rut="{{ Auth::user()->num_documento }}"> </historial-component>
				</v-app>
				<template v-if="menu==12">
					<talleruser-component/>

				</template>
			</template>
			
			{{-- <template v-if="menu==6">
				<cliente-component/>
			</template> --}}
			@elseif (Auth::user()->idrol == 3)
			{{-- <template v-if="menu==0">
				{{-- <dashboard></dashboard> --}}
			{{--</template>

				<template v-if="menu==1">
					<categoria-component/>
				</template>

				<template v-if="menu==2">
					<producto-component/>
				</template>

				<template v-if="menu==3">
					{{-- <compra></compra> --}}
				{{-- </template>

					<template v-if="menu==4">
						<proveedor-component/>
					</template> --}}
					<template v-if="menu==11">
						<taller-component  tipo_cuenta="{{ Auth::user()->idrol }}" id_cuenta="{{ Auth::user()->id }}"/>  
						</template>
						<template v-if="menu==13">
							<arbol-component/>
						</template>
						{{--<template v-if="menu==14">
							Fallas a futuro
						</template>--}}
						
						<template v-if="menu==41">
							<historialcliente-component rut="{{ Auth::user()->num_documento }}"/>
							</template>
							<template v-if="menu==42">
								<historialclientecotizaciones-component rut="{{ Auth::user()->num_documento }}"/>
								</template>
							<template v-if="menu==17">
								<reparacion-component tipo_cuenta="{{ Auth::user()->idrol }}" rut="{{ Auth::user()->num_documento }}"/>
							</template>
							@else

							@endif

							@endif


							@endsection