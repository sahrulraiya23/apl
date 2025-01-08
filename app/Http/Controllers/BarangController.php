<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);


        Barang::create($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);


        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
    public function indexKategori()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function createKategori()
    {
        return view('kategori.create');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function editKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
    public function exportBarangToXml()
    {
        // Ambil data barang beserta kategori
        $barang = Barang::with('kategori')->get();

        // Membuat objek SimpleXMLElement
        $xml = new \SimpleXMLElement('<barang/>');

        // Iterasi untuk menambahkan item barang ke XML
        foreach ($barang as $b) {
            $barangItem = $xml->addChild('barang_item');
            $barangItem->addChild('nama_barang', $b->nama_barang);
            $barangItem->addChild('kategori', $b->kategori->nama_kategori);
            $barangItem->addChild('stok', $b->stok);
            $barangItem->addChild('harga', $b->harga);
        }

        // Mengirimkan file XML sebagai response
        return response($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml');
    }
    public function importXml(Request $request)
    {
        // Validasi file yang di-upload
        $request->validate([
            'file' => 'required|file|mimes:xml',
        ]);

        // Ambil file yang di-upload
        $file = $request->file('file');
        // Membaca file XML
        $xmlContent = simplexml_load_file($file->getRealPath());

        // Iterasi untuk mengimpor data barang
        foreach ($xmlContent->barang_item as $barang) {
            // Menyimpan kategori (jika belum ada)
            $kategori = Kategori::firstOrCreate(['nama_kategori' => (string)$barang->kategori]);

            // Menyimpan data barang ke database
            Barang::create([
                'nama_barang' => (string)$barang->nama_barang,
                'kategori_id' => $kategori->id,
                'stok' => (int)$barang->stok,
                'harga' => (float)$barang->harga,
            ]);
        }

        // Redirect ke halaman index barang dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diimpor.');
    }
}
