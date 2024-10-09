<?php
/*
namespace App\Http\Controllers;

abstract class Controller
{
    //
}*/
namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="API de Gestión de Ambientes",
 *     version="1.0.0",
 *     description="Documentación de la API para el módulo de Ambiente en el proyecto universitario.",
 *     @OA\Contact(
 *         email="soporte@tudominio.com"
 *     )
 * )
 */

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}