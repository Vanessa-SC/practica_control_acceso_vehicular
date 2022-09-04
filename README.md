## Acerca de la prueba

### Requerimientos del proyecto

Se desea administrar el acceso de vehículos a un estacionamiento de pago. El estacionamiento no se encuentra automatizado, por lo que existe un empleado encargado de registrar las entradas y salidas de vehículos, por lo cual es necesario que se tenga una interfaz gráfica aunque sea simple.

Los vehículos se identifican por su número de placa. Cuando un vehículo entra en el estacionamiento el empleado registra su entrada y al salir registra su salida y, en algunos casos, cobra el importe correspondiente por el tiempo de estacionamiento.

El importe cobrado depende del tipo de vehículo:

- Los vehículos oficiales no pagan, pero se registran sus estancias para llevar el control. (Una estancia consiste en una hora de entrada y una de salida)

- Los residentes pagan a $1.00MX el minuto. La aplicación irá acumulando el tiempo (en minutos) que han permanecido estacionados.

- Los no residentes pagan a la salida del estacionamiento a razón de $3.00MX por minuto. Se prevé que en el futuro puedan incluirse nuevos tipos de vehículos, por lo que la aplicación desarrollada deberá ser fácilmente extensible en ese aspecto.

La aplicación debe tener un reporte donde pueda filtrar por día y hora y muestre las entradas y salidas de vehículos y en su caso el cobro correspondiente y dar la opción a descarga del reporte en excel y/o pdf.

Ejemplo :
13/02/20202 (d/m/y) - 1:00pm
Núm. placa         Tiempo estacionado (min.)        Tipo                    Cantidad a pagar
S1234A              30 min                                        residente            $30.00
4567ABC           1 hrs                                           no residente       $180.00
4FRU573           5 hrs                                           oficial                  -

## Tecnologías utilizadas

Utilicé el framework Laravel (version 9) para realizarlo, ya que el lenguaje de Backend que más domino es PHP, y considerando que debía considerarse como un proyecto escalable, determiné que sería lo ideal.

Para el maquetado utilicé código puro CSS con HTML.

Para la parte de exportar el reporte a PDF y Excel hice uso de las siguientes librerias Javascript:
- **[tableToExcel](https://github.com/linways/table-to-excel)**
- **[html2pdf.js](https://ekoopmans.github.io/html2pdf.js/)**

## Notas
Las migraciones incluyen la inicialización de la tabla TipoVehiculo.

