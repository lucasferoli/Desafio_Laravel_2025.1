<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
	public function index()
	{
		$admins = User::all();
		return view('admAdministador', compact('admins'));
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
			'photo' => 'required|string|max:255',
		]);

		$admin = new Admin();
		$admin->name = $request->input('name');
		$admin->email = $request->input('email');
		$admin->password = Hash::make($request->input('password'));
		$admin->address = $request->input('address');
		$admin->telephone = $request->input('telephone');
		$admin->birth_date = $request->input('birth_date');
		$admin->cpf = $request->input('cpf');
		$admin->photo = $request->input('photo');
		$admin->created_at = now();
		$admin->updated_at = now();
		$admin->save();

		return redirect()->route('admAdministrador')->with('success', 'Admin created successfully');
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
			'password' => 'nullable|string|min:8|confirmed',
		]);

		$admin = Admin::findOrFail($id);
		$admin->name = $request->input('name');
		$admin->email = $request->input('email');

		if ($request->filled('password')) {
			$admin->password = Hash::make($request->input('password'));
		}

		$admin->save();

		return redirect()->route('admAdministrador')->with('success', 'Admin updated successfully');
	}

	public function destroy($id)
	{
		$admin = Admin::findOrFail($id);
		$admin->delete();

		return redirect()->route('admAdministrador')->with('success', 'Admin deleted successfully');
	}
}
