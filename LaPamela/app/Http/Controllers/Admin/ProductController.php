<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Mostrar formulario de creación
    public function create()
    {
        return view('admin.productos.create');
    }

    // Guardar nuevo producto
    public function store(Request $request)
{
    $data = $request->all();

    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('productos', 'public');
        $data['imagen'] = 'storage/' . $path;
    }

    Product::create($data);

    return redirect('/productos')->with('success', 'Producto añadido correctamente.');
}


    // Mostrar formulario de edición
    public function edit($id)
    {
        $producto = Product::findOrFail($id);
        return view('admin.productos.edit', compact('producto'));
    }

    // Actualizar producto existente
    public function update(Request $request, $id)
{
    $producto = Product::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('productos', 'public');
        $data['imagen'] = 'storage/' . $path;
    }

    $producto->update($data);

    return redirect('/productos')->with('success', 'Producto actualizado correctamente.');
}


    // Mostrar vista de confirmación para borrar
    public function deleteConfirm($id)
    {
        $producto = Product::findOrFail($id);
        return view('admin.productos.delete', compact('producto'));
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Product::findOrFail($id);
        $producto->delete();
        return redirect('/productos')->with('success', 'Producto eliminado correctamente.');
    }
}
