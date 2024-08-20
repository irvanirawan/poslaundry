<?php

namespace Modules\Penjualan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Modules\Penjualan\Models\Penjualan;
use Modules\Penjualan\Models\PenjualanItems;
use Modules\Item\Models\Item;
use Modules\Pelanggan\Models\Pelanggan;

class ApiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $penjualan = Penjualan::with('createdByUser', 'updatedByUser', 'pelaanggan', 'items.item');

        if($request->has('status')) {
            $penjualan->where('status', $request->input('status'));
        }
        
        if($request->has('count')) {
            $result = $penjualan->count();
        } else {
            $result = $penjualan->get();
        }

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjualan::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'kode_penjualan' => 'nullable|string|max:10',
            'pelanggan_id' => 'nullable|integer',
            'total_harga' => 'nullable|integer',
            'total_item' => 'nullable|integer',
            'total_bayar' => 'nullable|integer',
            'total_kembalian' => 'nullable|integer',
            'status' => 'nullable|string|max:10',
            'diskon' => 'nullable|integer',
            'pajak' => 'nullable|integer',
            'total_harga_final' => 'nullable|integer',
            'keterangan' => 'nullable|string',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        $penjualan = Penjualan::create($validatedData);

        $items = $request->input('items');
        foreach ($items as $item) {
            $item = Item::find($item['item_id']);
            $penjualanItem = new PenjualanItems();
            $penjualanItem->penjualan_id = $penjualan->id;
            $penjualanItem->item_id = $item->id;
            $penjualanItem->harga = $item->harga;
            $penjualanItem->jumlah = $item['jumlah'];
            $penjualanItem->total_harga = $item->harga * $item['jumlah'];
            $penjualanItem->keterangan = $item['keterangan'];
            $penjualanItem->save();
        }

        return response()->json($penjualan, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('penjualan::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('penjualan::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
