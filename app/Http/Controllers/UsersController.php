<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::all();
		return view('admUsuarios', compact('users'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8|confirmed',
			'address' => 'required|string|max:255',
			'telephone' => 'required|string|max:20',
			'birth_date' => 'required|date',
			'cpf' => 'required|string|max:11|unique:users',
			'balance' => 'required|numeric',
			'photo' => 'required|string|max:255',
		]);

		$user = new User();
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = Hash::make($request->input('password'));
		$user->address = $request->input('address');
		$user->telephone = $request->input('telephone');
		$user->birth_date = $request->input('birth_date');
		$user->cpf = $request->input('cpf');
		$user->balance = $request->input('balance');
		$user->photo = $request->input('photo');
		$user->created_at = now();
		$user->updated_at = now();
		$user->save();

		return redirect()->route('admUsuarios')->with('success', 'User created successfully');
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users,email,' . $id,
			'password' => 'nullable|string|min:8|confirmed',
		]);

		$user = User::findOrFail($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');

		if ($request->filled('password')) {
			$user->password = Hash::make($request->input('password'));
		}

		$user->save();

		return redirect()->route('admUsuarios')->with('success', 'User updated successfully');
	}

	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$user->delete();

		return redirect()->route('admUsuarios')->with('success', 'User deleted successfully');
	}
	
    public function getUsers(Request $request)
    {
        return $this->getPaginatedResponse(User::query());
    }

    public function getAdmins(Request $request)
    {
        return $this->getPaginatedResponse(Admin::query());
    }

    private function getPaginatedResponse($query)
    {
        $perPage = 6;
        $users = $query->paginate($perPage);

        // Formatar os dados conforme necessário
        $formattedUsers = $users->map(function ($user) {
            return [
                'name' => $user->name,
                'photo' => $user->photo
            ];
        });

        return response()->json([
            'users' => $formattedUsers,
            'totalPages' => $users->lastPage(),
            'status' => 200
        ]);
    }
}

}