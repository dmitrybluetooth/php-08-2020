<?php

namespace App\Http\Controllers;

use App\Interfaces\ExternalAuthInterface;
use App\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    private $authService;

    public function __construct(ExternalAuthInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
            'login' => 'required|string|max:255',
            'password' => 'required|min:1',
        ]);

        $login = $request->input('login');
        $system = rtrim($this->authService::LOGIN_PREFIX, '_');

        if ($this->authService->login($login, $request->input('password'))) {
            return response()->json([
                'status' => 'success',
                'token' => (new JwtService())->createToken($login, $system),
            ]);
        }

        return response()->json([
            'status' => 'failure',
        ]);
    }
}
