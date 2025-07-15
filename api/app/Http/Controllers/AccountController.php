<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $accounts = Account::where('user_id', $request->user()->id)->get();
        return response()->json($accounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'type'=> 'required',
            'solde_initial' => 'required|numeric',
            'solde_actuel' => 'required|numeric'
        ]);

        $account = Account::create([
            'user_id' => $request->user()->id,
            'nom' => $request->nom,
            'type' => $request->type,
            'solde_initial' => $request->solde_initial,
            'solde_actuel' => $request->solde_actuel
        ]);

        return response()->json($account, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return response()->json($account);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json(['message' => 'Compte supprimée.']);

    }
}
