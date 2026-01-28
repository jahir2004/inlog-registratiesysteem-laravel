<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
Use Symfony\Polyfill\Idn\Idn;

class PraktijkmanagementController extends Controller
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
      return view('praktijkmanagement.index',[
        'title' => 'Praktijkmanagement Home',
      ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userResult = $this->userModel->sp_GetUserById($id);
        $userRow = $userResult[0] ?? null;

        if (!$userRow) {
            abort(404);
        }

        $user = (object) [
            'id' => $userRow->id ?? $userRow->Id ?? null,
            'name' => $userRow->name ?? $userRow->Name ?? null,
            'email' => $userRow->email ?? $userRow->Email ?? null,
            'rolename' => $userRow->rolename ?? $userRow->Rolename ?? null,
        ];

        return view('praktijkmanagement.show', [
            'title' => 'User Details',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userResult = $this->userModel->sp_GetUserById($id);
        $userRow = $userResult[0] ?? null;

        if (!$userRow) {
            abort(404);
        }

        $user = (object) [
            'id' => $userRow->id ?? $userRow->Id ?? null,
            'name' => $userRow->name ?? $userRow->Name ?? null,
            'email' => $userRow->email ?? $userRow->Email ?? null,
            'rolename' => $userRow->rolename ?? $userRow->Rolename ?? null,
        ];

        $userroles = $this->userModel->sp_GetAllUserroles();

        return view('praktijkmanagement.edit', [
            'title' => 'Wijzig Gebruikersrol',
            'user' => $user,
            'userroles' => $userroles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
            'rolename' => 'required|string|max:255',
        ]);

        $affected = $this->userModel->sp_UpdateUser(
            $id,
            $validated['name'],
            $validated['email'],
            $validated['rolename']
        );

        if ($affected === 0) {
            return redirect()->route('praktijkmanagement.edit', ['id' => $id])
                ->with('error', 'Er is geen wijziging doorgevoerd.');
        }

        return redirect()->route('praktijkmanagement.userroles')
            ->with('success', 'Gebruikersrol succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->userModel->sp_DeleteUser($id);

        $affected = 0;
        if (is_array($result) && isset($result[0])) {
            $affected = (int) ($result[0]->affected_rows ?? 0);
        }

        if ($affected === 0) {
            return redirect()->route('praktijkmanagement.userroles')
                ->with('error', 'Er is geen user verwijderd.');
        }

        return redirect()->route('praktijkmanagement.userroles')
            ->with('success', 'User succesvol verwijderd.');
    }

    public function manageUserroles()
    {
        $users = $this->userModel->sp_GetAllUsers(Auth::id());

        return view('praktijkmanagement.userroles',[
            'title' => 'Gebruikersrollen',
            'users' => $users,
        ]);
    }

}