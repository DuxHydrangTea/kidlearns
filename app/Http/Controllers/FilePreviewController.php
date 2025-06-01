<?php

namespace App\Http\Controllers;
use Vish4395\LaravelFileViewer\LaravelFileViewer;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FilePreviewController extends Controller
{
    //
    public function filePreview(Request $request){
        $fileName = $request->fileName;
        $filePath = $fileName;
        $disk = 'public';
        $fileUrl = asset(   'storage' . $fileName);
        $fileData = [
            [
                'label' => __('Label'),
                'value' => "Value"
            ]
        ];
        return LaravelFileViewer::show($fileName, $filePath, $fileUrl, $disk, $fileData);
    }

    public function filePreviewEmber(Request $request)
    {
        $fileName = '/storage/uploads/e5a45bae-09e4-4d68-baa8-c8eadd04459fBÀI 8  ÁNH SÁNG VÀ SỰ TRUYỀN ÁNH SÁNG^^.docx';
        $filePath = public_path($fileName);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // 1. Đọc file DOCX
        $phpWord = IOFactory::load($filePath);

        // 2. Chuyển sang HTML
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        $htmlContent = '';
        ob_start();
        $htmlWriter->save('php://output');
        $htmlContent = ob_get_clean();

        // 3. Chuẩn bị HTML cho DomPDF
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <style>
                @font-face {
                    font-family: "DejaVu Sans";
                    font-style: normal;
                    font-weight: normal;
                    src: url(' . storage_path('fonts/DejaVuSans.ttf') . ') format("truetype");
                }
                body {
                    font-family: "Times New Roman", Times, serif;
                }
            </style>
        </head>
        <body>
            ' . $htmlContent . '
        </body>
        </html>';

        // 4. Cấu hình DomPDF
        $dompdf = new Dompdf([
            'defaultFont' => 'DejaVu Sans',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
        ]);

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // 5. Xuất PDF
        return $dompdf->stream('document.pdf', [
            'Attachment' => false
        ]);
    }
}
