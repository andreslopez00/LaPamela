<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-danger shadow">
                    <div class="card-body text-center">
                        <h2 class="text-danger mb-4">⚠️ Confirmar eliminación</h2>

                        <h4 class="mb-2">{{ $producto->nombre }}</h4>
                        <p class="mb-1">{{ $producto->descripcion }}</p>
                        <p class="fw-bold text-primary">{{ $producto->precio }} €</p>

                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-danger w-50 me-2">Sí, eliminar</button>
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
