<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Trigram;

use Datatables;

class TrigramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trigrams = Trigram::select('*');

        return Datatables::of($trigrams)
            ->editColumn('verified', function ($trigram) {
                return $trigram->verified ? 'Ya' : 'Tidak';
            })
            ->addColumn('action', function ($trigram) {
                $urlApprove = action('TrigramsController@show', [ 'id' => $trigram->id, 'intent' => 'verify' ]);
                $urlEdit    = action('TrigramsController@show', [ 'id' => $trigram->id, 'intent' => 'edit' ]);
                $urlDelete  = action('TrigramsController@show', [ 'id' => $trigram->id, 'intent' => 'delete' ]);

                return view('partials.datatable.actions', compact('urlApprove', 'urlEdit', 'urlDelete'));
            })
            ->escapeColumns([ 'word' ])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Trigram $trigram
     * @param  string      $intent
     * @return \Illuminate\Http\Response
     */
    public function show(Trigram $trigram, $intent)
    {
        $data = [ 'gram' => $trigram ];
        $view;

        if ($intent == 'verify') {
            $data['action'] = action('TrigramsController@verify', [ 'id' => $trigram->id ]);
            $view           = 'partials.verify';
        } else if ($intent == 'edit') {
            $data['action'] = action('TrigramsController@update', [ 'id' => $trigram->id ]);
            $view           = 'partials.edit';
        } else if ($intent == 'delete') {
            $data['action'] = action('TrigramsController@destroy', [ 'id' => $trigram->id ]);
            $view           = 'partials.delete';
        } else {
            return 'Unknown request';
        }

        return view($view, $data);
    }

    /**
     * Verify the specified resource in storage.
     *
     * @param  App\Trigram $trigram
     * @return \Illuminate\Http\Response
     */
    public function verify(Trigram $trigram)
    {
        $trigram->verified = true;
        $trigram->save();

        return response()->json([
            'success' => 'konfirmasi berhasil.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  App\Trigram $trigram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trigram $trigram)
    {
        $trigram->update($request->all());

        return response()->json([
            'success' => 'pengubahan berhasil.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Trigram $trigram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trigram $trigram)
    {
        $trigram->delete();

        return response()->json([
            'success' => 'penghapusan berhasil.'
        ]);
    }
}
