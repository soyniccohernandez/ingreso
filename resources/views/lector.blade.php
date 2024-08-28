<x-app-layout>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">

    <style>
        .table {
            max-width: 1200px;
            margin: auto;
            margin-top: 2rem;
        }

        label {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
    </style>

    <div class="container mt-5">

        @if (session('mensaje'))
            <script>
                $(document).ready(function() {
                    alert('{{ session('mensaje') }}');
                    $('#qrModal').modal('show'); // Mostrar el modal automáticamente
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-12">
                <button id="scan-qr-button" class="btn btn-primary w-100 p-3">Leer QR</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <table class="table" id="listado_asistentes">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IDENTIFICACIÓN</th>
                            <th>NOMBRE</th>
                            <th>EMAIL</th>
                            <th>TIPO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invitados as $invitado)
                            <tr>
                                <td>{{ $invitado->id }}</td>
                                <td>{{ $invitado->identificacion }}</td>
                                <td>{{ $invitado->nombre }}</td>
                                <td>{{ $invitado->email }}</td>
                                <td>{{ $invitado->tipo }}</td>
                                <td>
                                    @if ($invitado->ingreso == 0)
                                        <a href="/registro/ingreso/{{ $invitado->id }}"
                                            class="btn btn-primary">Registrar
                                            Ingreso</a>
                                    @else
                                    <span>Ya ingreso</span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal para el lector de QR -->
        <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrModalLabel">Lector de QR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="reader" style="width: 100%; height: 500px; border: 2px solid #ccc;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye los scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Script para manejar el escaneo y la búsqueda en la tabla -->
    <script>
        $(document).ready(function() {
            const table = $('#listado_asistentes').DataTable({
                dom: 'ftrpi',
            });

            // Muestra el modal cuando se hace clic en el botón de leer QR
            $('#scan-qr-button').on('click', function() {
                $('#qrModal').modal('show'); // Muestra el modal

                // Inicializa el lector de QR
                function onScanSuccess(decodedText, decodedResult) {
                    // Muestra el texto del QR escaneado en la consola
                    console.log(`Código QR escaneado: ${decodedText}`);

                    // Busca en la tabla usando DataTables
                    table.search(decodedText).draw();

                    // Detiene el escaneo después de un éxito
                    html5QrCode.stop().then(ignore => {
                        // El escaneo ha terminado
                        $('#qrModal').modal('hide'); // Oculta el modal
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
                        }
                    }, // Tamaño del área de escaneo
                    onScanSuccess,
                    onScanError
                ).catch(err => {
                    // Maneja el error en caso de que no se pueda iniciar el escaneo
                    console.error(`Error al iniciar el escaneo: ${err}`);
                });
            });

            // Elimina el lector de QR cuando se cierra el modal
            $('#qrModal').on('hidden.bs.modal', function() {
                html5QrCode.stop().then(ignore => {
                    console.log('Escaneo detenido.');
                }).catch(err => {
                    console.error(`Error al detener el escaneo: ${err}`);
                });
            });
        });
    </script>
</x-app-layout>
