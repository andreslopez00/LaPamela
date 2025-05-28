<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">➕ Añadir nuevo producto</h2>

                        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <textarea name="descripcion" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio (€):</label>
                                <input type="number" name="precio" step="0.01" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen (archivo):</label>
                                <input type="file" name="imagen" class="form-control">
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success w-50 me-2">Guardar</button>
                                <a href="/productos" class="btn btn-secondary w-50">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
