<?php

namespace Modules\SetupApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\SetupApp\Models\SetupApp;
use Illuminate\Support\Facades\Validator;

class ApiSetupAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SetupApp::first();
        return response()->json($data);
    }

    /**
     * Update the resource in storage only one record.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pajak_pb1' => 'nullable',
            'struk_header1' => 'nullable',
            'struk_header2' => 'nullable',
            'struk_header3' => 'nullable',
            'struk_header4' => 'nullable',
            'struk_header5' => 'nullable',
            'struk_footer1' => 'nullable',
            'struk_footer2' => 'nullable',
            'struk_footer3' => 'nullable',
            'struk_footer4' => 'nullable',
            'struk_footer5' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = SetupApp::updateOrCreate(
                    ['id' => SetupApp::first()->id ?? null], // Kondisi pencarian
                    $request->all() // Data untuk diupdate atau disimpan
                );

        return response()->json($data);
    }
}
