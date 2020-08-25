<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $all_user = $user->getAllusers(Auth::id());

        return view('user.index', [
            'all_user' => $all_user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //今回使わない
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //今回使わない
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //今回使わない
    }

    //FF機能

    //フォロー機能
    public function follow(User $user){
        $myself = Auth::user();
        //フォロー判定
        //返り値 = フォローデータ or 空白
        $follow_result = $myself->following_judge($user->id);
        // Log::debug('○フォロー機能｜フォロー対象のユーザーid:' . $user->id . '判定結果:' . $follow_result);
        if(empty($follow_result)){
            $myself->follow($user->id);
        }
        return redirect('/user');
    }

    //フォロー解除機能
    public function unfollow(User $user){
        $myself = Auth::user();
        //フォロー判定
        $follow_result = $myself->following_judge($user->id);
        // Log::debug('○フォロー解除機能｜フォロー対象のユーザーid:' . $user->id . '判定結果:' . $follow_result);
        if(!empty($follow_result)){
            $myself->unfollow($user->id);
        }
        return redirect('/user');
    }
}
