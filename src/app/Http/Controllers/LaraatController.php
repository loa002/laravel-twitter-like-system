<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laraat;
use App\Models\Ff_relationship;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LaraatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Laraat $laraat, Ff_relationship $ff_relationship)
    {//ツイート一覧表示機能(タイムライン)

        $myself = Auth::user();
        //フォローしている人のidを取得
        $follow_ids = $ff_relationship->getFollowingids($myself->id);
        //following_idコレクションの配列化※toArray()がないとインデックスを持たない配列ではない型になってしまう
        $following_ids = $follow_ids->pluck('followed_user_id')->toArray();
        //自身のidを結合
        $following_ids[] = $myself->id;

        //フォローしている人のidと自身のidからツイート一覧を取得
        $following_laraats = $laraat->getFollowinglaraats($following_ids);

        return view('laraat.index',[
            'following_laraats' => $following_laraats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laraat $laraat)
    {
        $laraat = $laraat->getLaraat($laraat->id);

        return view('laraat.show', [
            'laraat' => $laraat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
