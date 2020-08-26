<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laraat;
use App\Models\Ff_relationship;
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
    public function show(User $user, Laraat $laraat, Ff_relationship $ff_relationship)
    {
        $all_laraat_of_user = $laraat->getAlllaraats($user->id);
        $following_count = $ff_relationship->getFollowingcount($user->id);
        $followed_count = $ff_relationship->getFollowedcount($user->id);
        $laraat_count = $laraat->getLaraatscount($user->id);

        return view('user.show', [
            'user' => $user,
            'all_laraat_of_user' => $all_laraat_of_user,
            'following_count' => $following_count,
            'followed_count' => $followed_count,
            'laraat_count' => $laraat_count
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
        return redirect('user');
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
        return redirect('user');
    }
}
