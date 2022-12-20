<?php

namespace App\Http\Controllers;

use App\Models\challenge;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        return view('dashboard.login');
    }

    public function userData()
    {
        $items= user::all();
        return view('dashboard.data', compact('items'));
        

    }

    public function error()
    {
        return view('dashboard.error');
    }

    public function register()
    {
        return view('dashboard.register');
    }

    // public function user()
    // {
    //    $items= user::all();
    //     return view('dashboard.data', compact('items'));
    // }

    public function updateProfile(){
        return view('dashboard.upload-profile');
    }

    public function profile(){
        $user=User::where('id', Auth::user()->id)->first();
        return view('dashboard.profile', compact('user'));
    }

    public function inputRegister(Request$request)
    {
        $request->validate([
            'name'=> 'required|min:4|max:50',
            'email'=> 'required',
            'password'=>'required',
            'username'=> 'required|min:4|max:8',
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
            'username'=>$request->username,
            'role'=> 'user',
        ]);

        return redirect('/')->with('succes', 'Anda berhasil membuat akun');
    }

    public function auth(Request$request)
    {
        $request->validate([
            'password'=>'required',
            'username'=> 'required',
        ]);

    $user = $request->only('username', 'password');
    if(Auth::attempt($user)){
        return redirect()->route('todo.index');
    }else{
        return redirect('/')->with('fail', "Gagal login, periksa dan coba lagi!");
    }
    }

    public function logout()
    {
       Auth::logout();
       return redirect('/');
    }

    public function index()
    {
        $challenges = Challenge::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 0],
            ])->get();
        return view('dashboard.index', compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create');
    }

    public function complated()
    {
        $challenges = Challenge::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 1],
            ])->get();
        return view('dashboard.complated', compact('challenges'));
    }

    public function updateComplated($id)
    {
        //$id pada parameter mngambil data dari path dinamis {id}
        //cari data yg punya value column id dgn data id yg dikirim ke route, maka update baris data trsebut
        Challenge::where('id', $id)->update([
            'status'=>1,
            'done_time'=> Carbon::now(),
        ]);

        return redirect()->route('todo.complated')->with('done', 'todo sudah dikerjakan');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|min:3',
            'date'=> 'required',
            'description'=>'required|min:8',
        ]);

        Challenge::create([
            'title'=> $request->title,
            'date'=> $request->date,
            'description'=>$request->description,
            'status'=> 0,
            'user_id'=> Auth::user()->id,
        ]);

        return redirect()->route('todo.index')->with('successAdd', 'Berhasil menambahkan data Challenge!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $challenge= Challenge::where('id', $id)->first();
        return view('dashboard.edit', compact('challenge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required|min:3',
            'date'=> 'required',
            'description'=>'required|min:8',
        ]);

        Challenge::where('id', $id)->update([
            'title'=> $request->title,
            'date'=> $request->date,
            'description'=>$request->description,
            'status'=> 0,
            'user_id'=> Auth::user()->id,
        ]);

        return redirect('/todo/')->with('successUpdate', 'Data berhasil diperbaharui!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Challenge::where('id', '=',$id)->delete();
        return redirect()->route('todo.index')->with('successDelete', 'Berhasil menghapus data Challenge!');
    }
}

