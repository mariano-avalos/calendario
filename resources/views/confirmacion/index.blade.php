 
 @extends('layouts.app')
@section('content')

 <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Registro de Confirmaciones a Eventos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href=""> Cargar una confirmacion</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered" id="datatable">
        <tr>
             <th>Nº</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo Electronico</th>
            <th>Contacto Telefonico</th>
            <th>Cuidad</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($confirmacions as $confirmacion)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $confirmacion->nombre}}</td>
            <td>{{ $confirmacion->apellido}}</td>
            <td>{{ $confirmacion->email}}</td>
            <td>{{ $confirmacion->telefono}}</td>
            <td>{{ $confirmacion->cuidad }}</td>
            <td>
                <form action="" method="POST">
   
                
                    <a class="btn btn-primary" href="">Editar</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
          
        </tr>
        @endforeach
    </table>
  
    {!! $confirmacions->links() !!}

@endsection