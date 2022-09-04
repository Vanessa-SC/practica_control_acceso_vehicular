@extends('layouts.template')

@section('content')
<div class="form w-500">
  <h2 class="form__title">Vehiculos en estancia</h2>
  <a href="{{ route('accesos.index') }}"><button class="btn_back ">Volver</button></a>
  <table class="form__table">
    <thead>
      <tr>
        <th>Placas</th>
        <th>Hora</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @if($vehiculos->count() == 0)
        <tr>
          <td colspan="3">No hay vehiculos registrados</td>
        </tr>
      @endif
      @foreach($vehiculos as $vehiculo)
      <tr>
        <td>{{ $vehiculo->acceso->placas }}</td>
        <td>{{ date('d-m-Y H:i:s', strtotime($vehiculo->hora_entrada)) }}</td>
        <td>
          <form action="{{ route('accesos.salida_registrar') }}" method="POST" id="form_salida">
            @csrf
            <input type="text" name="estancia_id" hidden value="{{ $vehiculo->id }}">
            <button type="submit" class="form__submit">
              Registrar salida
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection

@section('js')
  <script>
    let form = document.querySelector(".form_salida");
    
  </script>
@endsection

