<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('produk.index', compact('data'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);
        $produk->update($request->all());
        return redirect('/produk')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        $produk->delete();
        return redirect('/produk')->with('success', 'Produk berhasil dihapus');
    }
}

