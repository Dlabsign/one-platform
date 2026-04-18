<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class FirebaseController extends Controller
{
    protected $database;

    // Inject Firebase Database via constructor
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    // 1. CREATE / UPDATE Data (Menyimpan data user)
    public function storeData()
    {
        $reference = $this->database->getReference('users/1');

        $reference->set([
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'role' => 'admin',
            'created_at' => now()->toDateTimeString()
        ]);

        return response()->json(['message' => 'Data berhasil disimpan ke Firebase!']);
    }

    // 2. READ Data (Mengambil data user)
    public function getData()
    {
        $reference = $this->database->getReference('users/1');
        $data = $reference->getValue();

        return response()->json([
            'message' => 'Data berhasil diambil dari Firebase',
            'data' => $data
        ]);
    }

    // 3. DELETE Data (Menghapus data user)
    public function deleteData()
    {
        $reference = $this->database->getReference('users/1');
        $reference->remove();

        return response()->json(['message' => 'Data berhasil dihapus dari Firebase!']);
    }
}
