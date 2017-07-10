<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function getDownload($id)
    {
        $oDocument = Document::id($id)->first(['name', 'code']);

        if ($oDocument) {
            $file = storage_path('/app/docs/' . $oDocument->code);

            if (file_exists($file)) {
                return response()->download($file, $oDocument->name, ['Content-Type: application/pdf']);
            } else {
                abort(404);
            }
        }

        abort(400);
    }
}