<?php

namespace App\Http\Controllers;

use App\Document;
use App\Stand;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StandController extends Controller
{
    public function getDetails($id)
    {
        $oStand = Stand::id($id)->first(['id', 'number', 'price', 'status', 'event_id']);

        if ($oStand) {
            return response()->json($oStand->toArray());
        } else {
            abort(400);
        }
    }

    public function getPhoto($id)
    {
        $oStand = Stand::id($id)->first(['photo']);

        if ($oStand) {
            $file = storage_path("/app/public/stands/{$oStand->photo}");

            if (file_exists($file)) {
                return response()->file($file);
            } else {
                abort(404);
            }
        } else {
            abort(400);
        }
    }

    public function postUploadDocuments(Request $request)
    {
        try {
            $newName = bin2hex(random_bytes(10)) . '.pdf';
            $oFile = $request->file;

            $oFile->move(storage_path('/app/docs/'), $newName);

            return response()->json(['document' => $newName]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage() . "\n" . $ex->getTraceAsString());
            abort(500);
        }
    }

    public function postUploadLogo(Request $request)
    {
        try {
            $newName = bin2hex(random_bytes(10)) . '.jpg';
            $oFile = $request->file;

            $oFile->move(storage_path('/app/logos/'), $newName);

            return response()->json(['logo' => $newName]);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage() . "\n" . $ex->getTraceAsString());
            abort(500);
        }
    }

    public function postSave(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required',
                'company' => 'required|max:45',
                'email' => 'required|max:45',
                'phone' => 'required|max:45',
                'address' => 'required|max:45',
                'logo' => 'required|max:45',
                'lstDocuments' => 'required',
            ]);

            $id = $request->get('id');
            $company = $request->get('company');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $address = $request->get('address');
            $logo = $request->get('logo');
            $lstDocuments = $request->get('lstDocuments');
            $documents = [];

            foreach ($lstDocuments as $key => $document) {
                $documents[] = [
                    'name' => $document['name'],
                    'code' => $document['code']
                ];
            }

            if (count($documents) == 0) {
                abort(400);
            }

            DB::beginTransaction();

            $oUser = User::create([
                'email' => $email
            ]);

            $oCompany = $oUser->company()->create([
                'company' => $company,
                'phone' => $phone,
                'address' => $address,
                'logo' => $logo['code']
            ]);

            $oCompany->documents()->createMany($documents);

            Stand::id($id)->update(['status' => 'reserved', 'company_id' => $oCompany->id]);

            DB::commit();

            return response(200);
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage() . "\n" . $ex->getTraceAsString());
            abort(500);
        }
    }

    public function getDocuments($id)
    {
        $oStand = Stand::id($id)->first(['company_id']);

        if ($oStand) {
            $lstDocuments = Document::companyId($oStand->company_id)->get();

            return response()->json($lstDocuments->toArray());
        }

        abort(400);
    }
}
