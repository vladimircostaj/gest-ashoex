<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    public function check(): JsonResponse
    {
        // Verificacion de la conexion a la base de datos como parte del health check()
        try {
            DB::connection()->getPdo();
            $dbStatus = 'Connected';
        } catch (\Exception $e) {
            $dbStatus = 'Disconnected';
        }

        return response()->json([
            'status' => 'healthy',
            'database' => $dbStatus,
            'timestamp' => now(),
        ]);
    }
}
