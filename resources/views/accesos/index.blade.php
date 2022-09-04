@extends('layouts/template')

@section('content')
<div class="form">
  <h2 class="form__title">Control de Acceso Vehicular</h2>

  <div class="form__options">
    <a href="{{ route('accesos.entrada') }}">
      <button>Registrar entrada</button>
    </a>
    </form>

    <a href="{{ route('accesos.salida') }}">
      <button>Registrar salida</button>
    </a>

    <a href="{{ route('accesos.reporte') }}">
      <button>Ver reporte</button>
    </a>
  </div>

</div>
@endsection

@section('js')
<script>
  @if(session('success'))
  Swal.fire("", "{{ session('success') }}", "success")
  @elseif(session('error'))
  Swal.fire("", "{{ session('error') }}", "error")
  console.log("{{ session('mensaje') }}");
  @endif

  
</script>
@endsection
