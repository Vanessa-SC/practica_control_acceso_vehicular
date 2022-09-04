@extends('layouts.template')

@section('content')

<div class="form w-800 align-top">

  <a href="{{ route('accesos.index') }}"><button class="btn_back w-100">Volver</button></a>
  <div class="form__title">Reporte de acceso vehicular</div>
  <div class="row">
    <div class="col">
      {{-- ------------------FILTRO-------------------- --}}
      <form action="{{ route('accesos.reporte') }}" method="POST">
        @csrf
        <div class="row justify-space-between">
          <div class="form__group">
            <input type="date" name="fecha" id="fecha" class="form__input" placeholder=" " required>
            <label for="fecha" class="form__label">Fecha</label>
          </div>
          <div class="form__group">
            <select name="hora" id="hora" class="form__input">
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
            </select>
            <label for="hora" class="form__label">Hora</label>
          </div>
          <button class="btn_filtrar">Filtrar</button>
        </div>
        

      </form>
    </div>
    <div class="col">
      <div class="exports">
        <button class="button_sm" onclick="printPDF()">Export to PDF</button>
        <button class="button_sm" onclick="exportExcel()">Export to Excel</button>
      </div>
    </div>
  </div>



  <div class="table-responsive" id="contentToPrint">
    <table id="table">
      <thead>
        <tr>
          <th>Núm. placa</th>
          <th>Entrada</th>
          <th>Salida</th>
          <th>Tiempo estacionado</th>
          <th>Tipo</th>
          <th>Cantidad a pagar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($accesos as $acceso)
        <tr>
          <td>{{ $acceso->placas }}</td>
          <td>{{ date('H:i:s', strtotime($acceso->hora_entrada ))}}</td>
          <td>{{ $acceso->hora_salida 
                      ? date('H:i:s', strtotime($acceso->hora_salida )) 
                      : 'No ha salido' }}</td>
          <td>{{ $acceso->tiempo }}</td>
          <td>{{ $acceso->tipo }}</td>
          <td>{{ $acceso->pago == 0 ? '-' : '$'.number_format($acceso->pago , 2)}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div id="elementH"></div>

@endsection

@section('js')
{{-- tableToExcel --}}
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
{{-- html2pdf.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
  function printPDF() {
    var element = document.getElementById('contentToPrint');
    // element.style.width = '700px';
    // element.style.height = '900px';
    var opt = {
      margin: 0.5
      , filename: 'reporte.pdf'
      , html2canvas: {
        scale: 1
      }
      , jsPDF: {
        unit: 'in'
        , format: 'letter'
        , orientation: 'portrait'
        , precision: '12'
      }
    };

    html2pdf().set(opt).from(element).save();

  }

  function exportExcel() {
    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[0], {
      name: 'reporte.xlsx'
      , sheet: {
        name: 'Sheet 1'
      }
    });
  }

</script>
@endsection
