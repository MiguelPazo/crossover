<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StandTest extends TestCase
{
    /**
     * Test stand details
     *
     * @return void
     */
    public function testGetDetails()
    {
        $this->json('GET', '/api/stand/1')
            ->seeJsonStructure(['id', 'number', 'price', 'status', 'event_id']);
    }

    /**
     * Test stand details value
     *
     * @return void
     */
    public function testGetDetailsValue()
    {
        $this->json('GET', '/api/stand/2')
            ->seeJson([
                'status' => 'free'
            ]);
    }

    /**
     * Test stand photo
     *
     * @return void
     */
    public function testGetPhoto()
    {
        $lstStand = \App\Stand::all();

        foreach ($lstStand as $key => $oStand) {
            $this->json('GET', "/api/stand/{$oStand->id}/photo")
                ->assertResponseOk();
        }
    }

    /**
     * Test all save reservation process
     * 1. Upload document
     * 2. Upload logo
     * 3. Save reservation
     *
     * @return void
     */
    public function testPostSave()
    {
        //Uploading document
        \Illuminate\Support\Facades\File::copy(storage_path('/app/test/BROCHURE 1.pdf'), storage_path('/app/test/BROCHURE 2.pdf'));

        $file = storage_path('/app/test/BROCHURE 2.pdf');
        $oFile = new \Illuminate\Http\UploadedFile($file, 'BROCHURE 1.pdf', 'application/pdf', null, null, true);

        $response = $this->call('POST', '/api/stand/upload/documents', [], [], ['file' => $oFile], ['Accept' => 'application/json']);
        $this->assertResponseOk();

        $content = json_decode($response->getContent());
        $this->assertObjectHasAttribute('document', $content);
        $document = $content->document;

        $this->assertFileExists(storage_path('/app/docs/' . $content->document));

        //Uploading logo
        \Illuminate\Support\Facades\File::copy(storage_path('/app/test/icon_big.jpg'), storage_path('/app/test/icon_big_copy.jpg'));

        $file = storage_path('/app/test/icon_big_copy.jpg');
        $oFile = new \Illuminate\Http\UploadedFile($file, 'icon_big_copy.jpg', 'image/jpg', null, null, true);

        $response = $this->call('POST', '/api/stand/upload/logo', [], [], ['file' => $oFile], ['Accept' => 'application/json']);
        $this->assertResponseOk();

        $content = json_decode($response->getContent());
        $this->assertObjectHasAttribute('logo', $content);

        $this->assertFileExists(storage_path('/app/logos/' . $content->logo));

        //Sending reservation request
        $this->json('POST', '/api/stand', [
            'id' => 1,
            'company' => 'Gozzio',
            'email' => 'miguel.ps19@gmail.com',
            'phone' => '+51986607692',
            'address' => 'Lima, Perú',
            'logo' => ['code' => $content->logo],
            'lstDocuments' => [
                [
                    'name' => 'BROCHURE 1.pdf',
                    'code' => $document,
                ]
            ],
        ])->assertResponseOk();
    }

    /**
     * Test logo company
     *
     * @return void
     */
    public function testGetLogo()
    {
        $oCompany = \App\Company::first();

        if ($oCompany) {
            $this->json('GET', "/api/company/{$oCompany->id}/logo")
                ->assertResponseOk();
        } else {
            $this->json('GET', "/api/company/{$oCompany->id}/logo")
                ->assertResponseStatus(404);
        }

    }
}
