<?php

namespace App\Http\Controllers;

use ConvertApi\ConvertApi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;

class PdfController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function wordToPdf(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:doc,docx|max:10240', 
        ]);

        try {
            // 2. PERUBAHANNYA DI SINI: Gunakan setApiCredentials
            ConvertApi::setApiCredentials('TxeQkvz4cCYVCMK7Xa3VVaMW4LVyLNQr');

            $file = $request->file('document');
            $filePath = $file->getPathname();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $result = ConvertApi::convert('pdf', [
                'File' => $filePath,
            ], 'docx');

            $outputDir = storage_path('app/public/');
            $savedFiles = $result->saveFiles($outputDir);
            
            $pdfPath = $savedFiles[0]->getFileInfo()['dirname'] . '/' . $savedFiles[0]->getFileInfo()['basename'];

            return response()->download($pdfPath, $originalName . '.pdf')->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat konversi: ' . $e->getMessage());
        }
    }

    public function imageToPdf(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'orientation' => 'in:portrait,landscape',
            'margin' => 'in:none,small,big',
            'alignment' => 'in:center,left,right' // <-- Tambahkan validasi ini
        ]);

        try {
            $base64Images = [];
            foreach ($request->file('images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $base64 = base64_encode(file_get_contents($image->getPathname()));
                $base64Images[] = 'data:image/' . $extension . ';base64,' . $base64;
            }

            $orientation = $request->input('orientation', 'portrait');
            $margin = $request->input('margin', 'none');
            $alignment = $request->input('alignment', 'center'); // <-- Ambil data alignment

            $pdf = Pdf::loadView('pdf.images', [
                'images' => $base64Images,
                'margin' => $margin,
                'alignment' => $alignment // <-- Kirim ke Blade PDF
            ]);

            $pdf->setPaper('A4', $orientation);

            return $pdf->download('Gambar-ke-PDF.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat konversi: ' . $e->getMessage());
        }
    }


    public function mergePdf(Request $request)
    {
        $request->validate([
            'pdf_files' => 'required|array|min:2',
            'pdf_files.*' => 'required|mimes:pdf|max:10240', // Maksimal 10MB per file
        ], [
            'pdf_files.min' => 'Anda harus mengunggah minimal 2 file PDF untuk digabungkan.',
            'pdf_files.*.mimes' => 'File yang diunggah harus berformat PDF.'
        ]);
        try {
            $merger = new Merger();
            foreach ($request->file('pdf_files') as $file) {
                $merger->addFile($file->getPathname());
            }
            $mergedPdf = $merger->merge();
            return response($mergedPdf)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="Dokumen-Gabungan.pdf"');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menggabungkan file: ' . $e->getMessage());
        }
    }

    public function showImagePdf()
    {
        return view('tools.image-pdf');
    }

    public function showMergePdf()
    {
        return view('tools.merge-pdf');
    }
}
