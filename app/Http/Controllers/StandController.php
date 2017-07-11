<?php

namespace App\Http\Controllers;

use App\Document;
use App\Jobs\SendReport;
use App\Mail\RegisterMail;
use App\Stand;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StandController extends Controller
{
    /**
     * Show details of a stand
     *
     * @param $id Stand id
     * @return \Illuminate\Http\JsonResponse Stand details
     */
    public function getDetails($id)
    {
        $oStand = Stand::id($id)->first(['id', 'number', 'price', 'status', 'event_id']);

        if ($oStand) {
            return response()->json($oStand->toArray());
        } else {
            abort(400);
        }
    }

    /**
     * Show a stand's photo
     *
     * @param $id Stand id
     * @return mixed Stand real photo
     */
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

    /**
     * Upload a document and generate a new unique code for it
     * (don't saved in DB)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse New unique document code
     */
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

    /**
     * Upload a logo of company and generate a new unique code for it
     * (don't saved in DB)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse New unique image code
     */
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

    /**
     * Confirm reservation, send mail to company and job report to admin
     *
     * @param Request $request
     * @return Http code
     */
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
                'name' => $company,
                'phone' => $phone,
                'address' => $address,
                'logo' => $logo['code']
            ]);

            $oCompany->documents()->createMany($documents);

            $oStand = Stand::with('event')->id($id)->first();

            $oStand->status = 'reserved';
            $oStand->company_id = $oCompany->id;
            $oStand->event->stands_reserved = $oStand->event->stands_reserved + 1;
            $oStand->push();

            Mail::to($oUser->email)->queue(new RegisterMail($oUser, $oCompany, $oStand->event));

            dispatch(new SendReport());

            DB::commit();

            return response(200);
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage() . "\n" . $ex->getTraceAsString());
            abort(500);
        }
    }

    /**
     * Show full details of a reserved stand
     *
     * @param $id Stand id
     * @return \Illuminate\Http\JsonResponse Details of reserved stand
     */
    public function getFullDetails($id)
    {
        $oStand = Stand::id($id)->first(['id', 'company_id']);

        if ($oStand) {
            $oCompany = $oStand->company()->with('documents')->first();

            return response()->json($oCompany->toArray());
        }

        abort(400);
    }
}
