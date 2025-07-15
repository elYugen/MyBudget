<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $operations = Operation::whereHas('account', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->get();

        return response()->json($operations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'type' => 'required|in:entrée,sortie',
            'nom' => 'required|string',
            'montant' => 'required|numeric',
            'categorie_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
            'note' => 'nullable|string'
        ]);

        // vérifier que le compte appartient à l'utilisateur
        if ($request->user()->accounts()->where('id', $request->account_id)->doesntExist()) {
            return response()->json(['error' => 'Compte invalide ou non autorisé.'], 403);
        }

        $operation = Operation::create([
            'account_id' => $request->account_id,
            'type' => $request->type,
            'nom' => $request->nom,
            'montant' => $request->montant,
            'categorie_id' => $request->categorie_id,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return response()->json($operation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Operation $operation)
    {
        if ($operation->account->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Non autorisé.'], 403);
        }

        return response()->json($operation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Operation $operation)
    {
        if ($operation->account->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Non autorisé.'], 403);
        }

        $request->validate([
            'type' => 'in:entrée,sortie',
            'nom' => 'string',
            'montant' => 'numeric',
            'categorie_id' => 'nullable|exists:categories,id',
            'date' => 'date',
            'note' => 'nullable|string'
        ]);

        $operation->update($request->only([
            'type', 'nom', 'montant', 'categorie_id', 'date', 'note'
        ]));

        return response()->json($operation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Operation $operation)
    {
        if ($operation->account->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Non autorisé.'], 403);
        }

        $operation->delete();

        return response()->json(['message' => 'Opération supprimée.']);
    }
}
