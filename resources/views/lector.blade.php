<x-app-layout>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css">

    <style>
        .table {
            max-width: 1200px;
            margin: auto;
            margin-top: 2rem;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <button id="scan-qr-button" class="btn btn-primary w-100 p-3">Leer QR</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table  class="table" id="listado_asistentes">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First</th>
                            <th>Last</th>
                            <th>Handle</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">Registrar Ingreso</a>
                            </td>
                        </tr>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">Registrar Ingreso</a>
                            </td>
                        </tr>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">Registrar Ingreso</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Contenedor para el lector de QR -->
        <div id="qr-container" style="display: none; text-align: center; margin-top: 20px;">
            <div id="reader" style="width: 500px; height: 500px; border: 2px solid #ccc; margin: auto;"></div>
            <button id="close-qr-button" class="btn btn-secondary mt-3">Cerrar</button>
        </div>
    </div>

    <!-- Incluye el script de QR -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>

    <!-- Script para manejar el escaneo -->
    <script>
        document.getElementById('scan-qr-button').addEventListener('click', function() {
            document.getElementById('qr-container').style.display = 'block';

            // Inicializa el lector de QR
            function onScanSuccess(decodedText, decodedResult) {
                // Muestra el texto del QR escaneado en la consola
                console.log(`Código QR escaneado: ${decodedText}`);
                document.write(`Código QR escaneado: ${decodedText}`)
                // Detiene el escaneo después de un éxito
                html5QrCode.stop().then(ignore => {
                    // El escaneo ha terminado
                    document.getElementById('qr-container').style.display = 'none'; // Oculta el contenedor
                }).catch(err => {
                    // Maneja el error
                    console.error(`Error al detener el escaneo: ${err}`);
                });
            }

            function onScanError(errorMessage) {
                // Maneja los errores durante el escaneo
                console.warn(`Error en el escaneo: ${errorMessage}`);
            }

            // Configura el lector
            const html5QrCode = new Html5Qrcode("reader");

            html5QrCode.start({
                    facingMode: "environment"
                }, // Opcional, puedes cambiar la cámara
                {
                    fps: 20,
                    qrbox: {
                        width: 300,
                        height: 1000
                    } // Tamaño del área de escaneo
                },
                onScanSuccess,
                onScanError
            ).catch(err => {
                // Maneja el error en caso de que no se pueda iniciar el escaneo
                console.error(`Error al iniciar el escaneo: ${err}`);
            });
        });

        document.getElementById('close-qr-button').addEventListener('click', function() {
            document.getElementById('qr-container').style.display = 'none';
            html5QrCode.stop().then(ignore => {
                // El escaneo ha terminado
                console.log('Escaneo detenido.');
            }).catch(err => {
                // Maneja el error
                console.error(`Error al detener el escaneo: ${err}`);
            });
        });

        $(document).ready(function() {
            $('#listado_asistentes').DataTable({
                // Opciones adicionales aquí si lo deseas
            });
        });
    </script>
</x-app-layout>