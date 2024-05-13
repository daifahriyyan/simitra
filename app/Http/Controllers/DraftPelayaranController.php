<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\DataOrder;
use Illuminate\Http\Request;
use App\Models\DraftPelayaran;
use Illuminate\Support\Facades\Storage;

class DraftPelayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.operasional.draft-pelayaran', [
            'draftPelayaran' => DraftPelayaran::get(),
            'dataOrder' => DataOrder::get(),
        ]);
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
        if (request()->hasFile('draft_pelayaran')) {
            $DP = $request->file("draft_pelayaran");
            $fileDP    = time() . "-" . $DP->getClientOriginalName();
            $uploadDP   = "draft_pelayaran/" . $fileDP;

            Storage::disk('public')->put($uploadDP, file_get_contents($DP));
        }

        $request['id_draft'] = 'D00' . strval(DraftPelayaran::get()->count() + 1);

        DraftPelayaran::create([
            'id_draft' => $request['id_draft'],
            'id_order' => $request['id_order'],
            'tanggal_order' => $request['tanggal_order'] ?? date('Y-m-d'),
            'draft_pelayaran' => $fileDP
        ]);

        return redirect(route('Draft Pelayaran'))->with('success', 'Draft Pelayaran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $draftPelayaran = DraftPelayaran::where('id', $id)->first();
        $fileDP = $draftPelayaran->draft_pelayaran;
        if (request()->hasFile("draft_pelayaran")) {
            $DP = request()->file("draft_pelayaran");
            $fileDP    = time() . "-" . $DP->getClientOriginalName();
            $uploadDP   = "draft_pelayaran/" . $fileDP;

            // Delete old file
            Storage::disk('public')->delete('draft_pelayaran/' . $draftPelayaran->draft_pelayaran);

            // Upload new file
            Storage::disk('public')->put($uploadDP, file_get_contents($DP));
        }
        DraftPelayaran::where('id', $id)->update([
            'id_draft' => $request['id_draft'],
            'id_order' => $request['id_order'],
            'tanggal_order' => $request['tanggal_order'],
            'draft_pelayaran' => $fileDP
        ]);

        return redirect(route('Draft Pelayaran'))->with('edit', 'Data Draft Pelayaran Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $draftPelayaran = DraftPelayaran::where('id', $id)->first();
        try {
            // Delete file from storage if it exists
            DraftPelayaran::where('id', $id)->delete();
            Storage::disk('public')->delete('draft_pelayaran/' . $draftPelayaran->draft_pelayaran);
            // Validate the value...
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect(route('Draft Pelayaran'))->with('delete', 'Data Draft Pelayaran Berhasil Dihapus');
    }
}
