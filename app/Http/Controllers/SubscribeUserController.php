<?php

namespace App\Http\Controllers;

use App\Models\SubscribeUser;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreSubscribeUserRequest;
use App\Http\Requests\UpdateSubscribeUserRequest;

class SubscribeUserController extends Controller
{
    // Handle subscribe dari frontend
    public function storeFrontend(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
        ]);

        SubscribeUser::updateOrCreate([
                'email' => $request->email
        ], [
            'email' => $request->email,
            'unsubcribe' => false,
        ]);
        Alert::success('Berhasil!', 'Berhasil subscribe! Silakan cek email Anda untuk promo terbaru.');
        return back()->with('success', 'Berhasil subscribe! Silakan cek email Anda untuk promo terbaru.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribeUsers = SubscribeUser::orderByDesc('created_at')->get();
        return view('admin.subscribe-users.index', compact('subscribeUsers'));
    }

    public function massUnsubscribe(\Illuminate\Http\Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        SubscribeUser::whereIn('id', $ids)->update(['unsubcribe' => true]);
        return redirect()->route('admin.subscribe-users.index')->with('success', 'Berhasil unsubscribe user terpilih.');
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
    public function store(StoreSubscribeUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscribeUser $subscribeUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribeUser $subscribeUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscribeUserRequest $request, SubscribeUser $subscribeUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribeUser $subscribeUser)
    {
        //
    }
}
