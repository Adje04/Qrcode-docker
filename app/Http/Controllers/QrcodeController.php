<?php

namespace App\Http\Controllers;

use App\Models\Qrcode;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\PngImageBackEnd;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode as GenerateQrCode;
use Illuminate\Support\Facades\Storage;


class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Qrcode::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'data' => 'required|string',
        ]);

        try {

            $qrcode_data = Qrcode::create([
                'author' => $request->author,
                'data' => $request->data,
            ]);

            $qrcode =  GenerateQrCode::size(200)->generate($qrcode_data->data);
            return  response()->json($qrcode_data, 201);
        } catch (\Throwable $th) {
        
            return response()->json([
                'success' => false,
                'error' => 'Une erreur s\'est produite lors de la création du QR code.',
                'message' => $th->getMessage(),
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Qrcode::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'author' => 'string|max:255',
            'data' => 'string',
        ]);
        try {
            $qrcode_data = Qrcode::findOrFail($id);
            $qrcode_data->update($request->all());


            if ($request->has('data')) {

                $qrcode =  GenerateQrCode::size(200)->generate($qrcode_data->data);
            }

            return  response()->json($qrcode_data, 200);
            //   view('welcome')->with('qrcode', $qrcode);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => 'Une erreur s\'est produite lors de la création du QR code.',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $qrcode = Qrcode::findOrFail($id);

        $qrcode->delete();

        return response()->json(null, 204);
    }
}
