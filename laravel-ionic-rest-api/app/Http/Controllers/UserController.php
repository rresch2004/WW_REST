<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

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

    public function getCurrentUser(Request $request)
    {
        return $request->user();
    }

    public function checkUserExists($username)
    {
        $userExists = User::where('username', $username)->exists();

        return response()->json($userExists);
    }
}
