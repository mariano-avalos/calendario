@extends('layouts.app')
@section('content')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<div class= "container">

		<div id="agenda">
			
		</div>
<input id="authenticated" type="hidden" value="{{ auth()->check() }}">
<!-- Butin trigger Modal -->	
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-targe="#evento">
	
</button>
				

<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Datos del Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      	<form action="" id="formularioEventos">

      	{!! csrf_field() !!} <!--  permite identificar los datos de este formulario -->

      		<div class="form-group ">
      		  <label for="id">ID</label>
      		    <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
      		    <small id="helpId" class="form-text text-muted">help text</small>
      		  </div>

      		<div class="form-group">
      		  <label for="title">Titulo</label>
      		    <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Escribe el titulo del evento">
      		    <small id="helpId" class="form-text text-muted">help text</small>
      		  </div>

      		 <div class="form-group">

      		 	<label for="">Descripcion</label>
      		 	<textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>

      		 </div>
      		 <div >

      		 	<label for="">Ubicacion</label>
      		 	 <div id="map" style="height: 350px"></div>
             <input id="lat" name="lat" type="hidden">
             <input id="lon" name="lon" type="hidden">

      		 </div>
			 <div class="form-group d-none">
      		  <label for="start">start</label>
      		    <input type="date" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="">
      		    <small id="helpId" class="form-text text-muted">help text</small>
      		  </div>

      		  <div class="form-group d-none">
      		  <label for="end">end</label>
      		    <input type="date" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="">
      		    <small id="helpId" class="form-text text-muted">help text</small>
      		  </div>

      	</form>

      </div>
      <div class="modal-footer">

      	<button type="button" class="btn btn-success" id="btnGuardar" >Guardar</button>
      	<button type="button" class="btn btn-warning" id="btnModificar" >Modificar</button>
      	<button type="button" class="btn btn-danger" id="btnEliminar" >Eliminar</button>
        <button type="button" class="btn btn-success" id="btnConfirmar" >Confirmar Asistencia</button>
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="confirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Datos de asistencia al Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="" id="formularioConfirmacion">

        {!! csrf_field() !!} <!--  permite identificar los datos de este formulario -->


          <div class="form-group">
            <label for="title">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombres">
             
            </div>

           <div class="form-group">
            <label for="title">Apellidos</label>
              <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Apellidos">
             
            </div>

            <div class="form-group">
            <label for="title">Correo Electronico</label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Direccion de correo electronico">
             
            </div>

             <div class="form-group">
            <label for="title">Cuidad</label>
              <input type="text" class="form-control" name="cuidad" id="cuidad" aria-describedby="helpId" placeholder="Cuidad del participante">
             
            </div>


             <div class="form-group">
            <label for="title">Contacto Telefonico</label>
              <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Telefono de contacto">
             
            </div>

        </form>

      
      <div class="modal-footer">

        <button type="button" class="btn btn-success" id="btnGuardarConfirmar">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        
      </div>
    </div>
  </div>
</div>

@endsection