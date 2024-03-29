<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Benutzerdaten abrufen
        $users = User::all();

        // JSON-Antwort zurückgeben
        return response()->json($users);
    }

    public function updateFlames(Request $request, $userId)
    {
        $request->validate([
            'flames' => 'required|integer',
        ]);

        $user = User::findOrFail($userId);

        $user->flames = $request->flames;
        $user->save();

        return response()->json(['message' => 'Flames erfolgreich aktualisiert'], 200);
    }
}
