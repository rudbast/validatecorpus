<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Unigram;

use Datatables;

class UnigramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unigrams = Unigram::select('*');

        return Datatables::of($unigrams)
            ->editColumn('verified', function ($unigram) {
                return $unigram->verified ? 'Ya' : 'Tidak';
            })
            ->addColumn('action', function ($unigram) {
                $urlApprove = action('UnigramsController@show', [ 'id' => $unigram->id, 'intent' => 'verify' ]);
                $urlEdit    = action('UnigramsController@show', [ 'id' => $unigram->id, 'intent' => 'edit' ]);
                $urlDelete  = action('UnigramsController@show', [ 'id' => $unigram->id, 'intent' => 'delete' ]);

                return view('partials.datatable.actions', compact('urlApprove', 'urlEdit', 'urlDelete'));
            })
            ->escapeColumns([ 'word' ])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Unigram $unigram
     * @param  string      $intent
     * @return \Illuminate\Http\Response
     */
    public function show(Unigram $unigram, $intent)
    {
        $data = [ 'gram' => $unigram ];
        $view;

        if ($intent == 'verify') {
            $data['action'] = action('UnigramsController@verify', [ 'id' => $unigram->id ]);
            $view           = 'partials.verify';
        } else if ($intent == 'edit') {
            $data['action'] = action('UnigramsController@update', [ 'id' => $unigram->id ]);
            $view           = 'partials.edit';
        } else if ($intent == 'delete') {
            $data['action'] = action('UnigramsController@destroy', [ 'id' => $unigram->id ]);
            $view           = 'partials.delete';
        } else {
            return 'Unknown request';
        }

        return view($view, $data);
    }

    /**
     * Verify the specified resource in storage.
     *
     * @param  App\Unigram $unigram
     * @return \Illuminate\Http\Response
     */
    public function verify(Unigram $unigram)
    {
        $unigram->verified = true;
        $unigram->save();

        return response()->json([
            'success' => 'konfirmasi berhasil.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  App\Unigram $unigram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unigram $unigram)
    {
        $unigram->update($request->all());

        return response()->json([
            'success' => 'pengubahan berhasil.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Unigram $unigram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unigram $unigram)
    {
        $unigram->delete();

        return response()->json([
            'success' => 'penghapusan berhasil.'
        ]);
    }
}
