<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar

namespace App\Repositories;

use App\Models\User;
use App\Models\BookingTransaction;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function register(array $data)
    {
        $user = User::create([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'photo' => $data['photo'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
        ]);

        // perlu semacam ini karena menggunakan spatie
        $user->assignRole('customer');

        return $user->load('roles');
    }

    public function login(array $data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
                'message' => 'The provided credentials do not match our records.',
            ], 401); // 401 Unauthorized status code
        }

        // Regenerate the session ID after successful login to prevent Session Fixation attacks
        request()->session()->regenerate();

        // Retrieve the authenticated user
        $user = Auth::user();

        // Return success response with user data
        return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
            'message' => 'Login successful',
            'user' => new UserResource($user->load('roles')),
        ]);
    }

    public function tokenLogin(array $data)
    {
        // Attempt authentication using email and password
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // Return 401 Unauthorized if credentials are invalid
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        // Get the authenticated user
        $user = Auth::user();

        // Create a new API token for the user and retrieve the plain text token
        $token = $user->createToken('API Token')->plainTextToken;

        // Return success response with token and user data
        return response()->json([ // phpcs:ignore PEAR.Functions.FunctionCallSignature.ContentAfterOpenBracket
            'message' => 'Login successful',
            'token' => $token,
            'user' => new UserResource($user->load('roles')),
        ]);
    }


}