<?php

namespace Modules\Pelanggan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Pelanggan\Models\Pelanggan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pelanggan = Pelanggan::with('createdByUser', 'updatedByUser');

        if($request->has('status')) {
            $pelanggan->where('status', $request->input('status'));
        }

        if($request->has('count')) {
            $result = $pelanggan->count();
        } else {
            $result = $pelanggan->get();
        }

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'nullable|string|max:10',
            'nama' => 'nullable|string|max:50',
            'alamat' => 'nullable',
            'telepon' => 'nullable|string|max:15',
            'status' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $pelanggan = Pelanggan::create($validatedData);
        return response()->json($pelanggan, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Pelanggan::find($id);

        if(!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kode' => 'nullable|string|max:10',
            'nama' => 'nullable|string|max:50',
            'alamat' => 'nullable',
            'telepon' => 'nullable|string|max:15',
            'status' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $data->update($validatedData);
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Pelanggan::find($id);

        if(!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // if($data->order()->count() > 0) {
        //     return response()->json(['message' => 'Data has relation'], 400);
        // }

        $data->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }
}
