@extends('layouts.template')

@section('content')

<form action="{{ route('accesos.entrada_registrar') }}" method="POST" class="form">
  @csrf
  <h2 class="form__title">Registrar entrada</h2>
  <a href="{{ route('accesos.index') }}"><button class="btn_back w-100">Volver</button></a>
  <div class="form__container">
    <div class="form__group">
      <input type="text" name="num_placas" id="num_placas" class="form__input" placeholder=" " required>
      <label for="num_placas" class="form__label">Número de placas</label>
      <span class="form__line"></span>
    </div>
    <div class="form__group">
      {{-- <input type="text" name="num_placas" id="num_placas" class="form__input" placeholder=" " required> --}}
      <label for="tipo">Tipo de vehículo</label>
      <select name="tipo" id="tipo" class="form__input">
        @foreach ($tipos as $tipo)
          <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="form__submit">Registrar</button>
  </div>
</form>

@endsection
