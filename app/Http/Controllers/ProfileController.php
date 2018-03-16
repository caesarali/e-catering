<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Auth;
use App\Order;
use File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        $orders = Order::where('status', 2)->where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->get();
        return view('profile', compact('profile', 'orders'));
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
        $profile = Profile::updateOrCreate(
            ['user_id' => Auth::user()->id],
            ['phone' => $request->phone, 'address' => $request->address]
        );

        if (Auth::user()->name !== $request->name) {
            $profile->changeName($request->name);
        }

        return redirect()->route('profile.index')->with('alert', 'Success!!! Data has been changed.');
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
        $profile = Profile::find($id);
        if ($request->hasFile('pict') && $request->file('pict')->isValid()) {
            // Deleteing Old File
            if (!empty($profile->pictures)) {
                $pathOld = public_path('assets/pictures/profile/'.$profile->pictures);
                File::delete($pathOld);
            }

            // Uploading
            $extension = $request->pict->extension();
            $filename = 'pict_user_'. Auth::id() . '.' . $extension;
            $path = public_path('assets/pictures/profile');
            $store = $request->pict->move($path, $filename);

            // Update Profile
            if ($store) {
                $profile->update(['pictures' => $filename]);
            }
        }
        return redirect()->route('profile.index')->with('message', 'Profile berhasil diperbarui, Terimakasih.');
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
