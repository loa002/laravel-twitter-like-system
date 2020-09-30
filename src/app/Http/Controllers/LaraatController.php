<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laraat;
use App\Models\Ff_relationship;
use App\Models\Comment;
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
        $user = Auth::user();
        return view('laraat.create',[
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Laraat $laraat)
    {
        $laraat_data = $request->all();
        $validator = Validator::make($laraat_data, [
            'txt_content' => ['required', 'string', 'max:150'],
        ]);

        //自動リダイレクト
        $validator->validate();

        //登録処理
        $laraat->laraatRegister(Auth::id(),$laraat_data);

        return redirect('laraat/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laraat $laraat, Comment $comment)
    {
        $laraat = $laraat->getLaraat($laraat->id);

        $comments = $comment->getComments($laraat->id);

        return view('laraat.show', [
            'laraat' => $laraat,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laraat $laraat)
    {
        $user = auth()->user();
        $laraat = $laraat->getLaraat($laraat->id);

        //存在しないツイートの編集画面にアクセスした場合
        if(!isset($laraat)){
            return redirect('/laraat');
        }

        return view('laraat.edit', [
            'user' => $user,
            'laraat' => $laraat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laraat $laraat)
    {
        $laraat_data = $request->all();
        $validator = Validator::make($laraat_data, [
            'txt_content' => ['required', 'string', 'max:150'],
        ]);

        //自動リダイレクト
        $validator->validate();

        //登録処理
        $laraat->laraatUpdate(Auth::id(),$laraat_data);

        return redirect('laraat/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laraat $laraat)
    {
        Log::debug('削除ここまできてる');
        $laraat->laraatDelete($laraat->id);

        return redirect('laraat/');
    }
}
