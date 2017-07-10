<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getLogo($id)
    {
        $oCompany = Company::id($id)->first(['logo']);

        if ($oCompany) {
            $file = storage_path("/app/logos/{$oCompany->logo}");

            if (file_exists($file)) {
                return response()->file($file);
            } else {
                abort(404);
            }
        } else {
            abort(400);
        }
    }

}