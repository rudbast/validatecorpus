<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Bigram;

use Datatables;

class BigramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bigrams = Bigram::select('*');

        return Datatables::of($bigrams)
            ->editColumn('verified', function ($bigram) {
                return $bigram->verified ? 'Ya' : 'Tidak';
            })
            ->addColumn('action', function ($bigram) {
                $urlApprove = action('BigramsController@show', [ 'id' => $bigram->id, 'intent' => 'verify' ]);
                $urlEdit    = action('BigramsController@show', [ 'id' => $bigram->id, 'intent' => 'edit' ]);
                $urlDelete  = action('BigramsController@show', [ 'id' => $bigram->id, 'intent' => 'delete' ]);

                return view('partials.datatable.actions', compact('urlApprove', 'urlEdit', 'urlDelete'));
            })
            ->escapeColumns([ 'word' ])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Bigram  $bigram
     * @param  string      $intent
     * @return \Illuminate\Http\Response
     */
    public function show(Bigram $bigram, $intent)
    {
        $data = [ 'gram' => $bigram ];
        $view;

        if ($intent == 'verify') {
            $data['action'] = action('BigramsController@verify', [ 'id' => $bigram->id ]);
            $view           = 'partials.verify';
        } else if ($intent == 'edit') {
            $data['action'] = action('BigramsController@update', [ 'id' => $bigram->id ]);
            $view           = 'partials.edit';
        } else if ($intent == 'delete') {
            $data['action'] = action('BigramsController@destroy', [ 'id' => $bigram->id ]);
            $view           = 'partials.delete';
        } else {
            return 'Unknown request';
        }

        return view($view, $data);
    }

    /**
     * Verify the specified resource in storage.
     *
     * @param  App\Bigram $bigram
     * @return \Illuminate\Http\Response
     */
    public function verify(Bigram $bigram)
    {
        $bigram->verified = true;
        $bigram->save();

        return response()->json([
            'success' => 'konfirmasi berhasil.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  App\Bigram $bigram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bigram $bigram)
    {
        $bigram->update($request->all());

        return response()->json([
            'success' => 'pengubahan berhasil.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Bigram $bigram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bigram $bigram)
    {
        $bigram->delete();

        return response()->json([
            'success' => 'penghapusan berhasil.'
        ]);
    }
}
