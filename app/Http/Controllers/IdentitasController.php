<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identitas;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;


class IdentitasController extends Controller
{
    public function index()
    {
        $identitas = Identitas::orderBy('created_at', 'desc')->get();
        return view('Data.index', compact('identitas'));
    }

    public function create()
    {
        return view('Data.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:255',
            'Ttl' => 'required|string|max:255', // Adjusted to string
            'Sekolah' => 'required|string|max:255',
            'Keterangan' => 'required|string|max:255',
        ]);
    
        Identitas::create($request->all());
    
        return redirect()->route('Data.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    
    /** Edit Data */

   // Method untuk menampilkan halaman edit
   public function edit(string $id): View
   {
       // Dapatkan data berdasarkan ID
       $identitas = Identitas::findOrFail($id);

       // Render view dengan data
       return view('Data.edit', compact('identitas'));
   }

   // Method untuk mengupdate data
   public function update(Request $request, string $id): RedirectResponse
   {
       $request->validate([
           'Nama' => 'required|string|max:255',
           'Ttl' => 'required|string|max:255',
           'Sekolah' => 'required|string|max:255',
           'Keterangan' => 'required|string|max:255',
       ]);

       $identitas = Identitas::findOrFail($id);
       $identitas->update([
           'Nama' => $request->Nama,
           'Ttl' => $request->Ttl,
           'Sekolah' => $request->Sekolah,
           'Keterangan' => $request->Keterangan,
       ]);

       return redirect()->route('Data.index')->with('success', 'Data siswa berhasil diupdate');
   }

    // **app/Http/Controllers/IdentitasController.php */
    public function destroy($id): RedirectResponse
    {
        //get siswa by ID
        $identitas = Identitas::findOrFail($id);

        //delete siswa
        $identitas->delete();

        //redirect to index
        return redirect()->route('Data.index')->with(['success' => 'Data siswa berhasil dihapus']);
    }


// search Controller
    public function search(Request $request)
    {
    $query = $request->input('query');
    $results = Identitas::where('Nama', 'LIKE', "%{$query}%")->get(); // Ganti 'column_name' dengan kolom yang sesuai

    return view('Data.search', compact('results'));
    }

}
