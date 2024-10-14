<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'address' => ['nullable', 'string', 'max:255'], // Validasi alamat
            'school' => ['nullable', 'string', 'max:255'],  // Validasi asal sekolah
            'start_internship' => ['nullable', 'date'],     // Validasi tanggal masuk magang
            'end_internship' => ['nullable', 'date'],       // Validasi tanggal selesai magang
        ];
    }
    public function update(ProfileUpdateRequest $request)
{
    // Update user profile
    $request->user()->update($request->validated());

    auth()->user()->refresh();


    return back()->with('status', 'profile-updated');
}

}