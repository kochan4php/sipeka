<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller {
	public function updatePassword(Request $request) {
		$request->validate([
			'old_password' => 'required',
			'new_password' => 'required|confirmed'
		]);

		$data = $request->only(['old_password', 'new_password']);

		// Match the old password
		if (!Hash::check($data['old_password'], Auth::user()->password)) {
			notify()->error("Password lama salah!", "Notifikasi");
			return back();
		}

		// Update password
		User::whereIdUser(Auth::user()->id_user)->update([
			'password' => Hash::make($data['new_password'])
		]);

		notify()->success("Password berhasil diperbarui", "Notifikasi");

		return back();
	}
}
