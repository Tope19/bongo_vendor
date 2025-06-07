<?php

namespace App\Services\User;

use App\Models\User;
use App\Constants\AppConstants;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{
    public User $user;

    public function __construct() {}

    public function create(array $data): User
    {
        DB::beginTransaction();
        try {
            $data = array_merge([
                'status' => 1,
                'role' => AppConstants::VENDOR_ROLE
            ], $data);

            $data['password'] = !empty($data['password'] ?? null) ? Hash::make($data['password']) : null;
            // unset data password_confirmation
            unset($data['password_confirmation']);
            // dd($data);
            $user = User::create($data);
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}
