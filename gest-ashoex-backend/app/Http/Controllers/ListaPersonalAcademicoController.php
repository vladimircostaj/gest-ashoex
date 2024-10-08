namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ListaPersonalAcademicoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/personal-academico",
     *     summary="Obtener lista de personal académico",
     *     tags={"Personal Académico"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="Tipo_personal", type="string", example="Profesor"),
     *                     @OA\Property(property="telefono", type="string", example="123456789"),
     *                     @OA\Property(property="personal_academico_id", type="integer", example=1),
     *                     @OA\Property(property="tipo_personal_id", type="integer", example=2),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *                     @OA\Property(property="estado", type="string", example="Activo")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Operación exitosa"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No se encontraron datos",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 example={}
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=204),
     *                 @OA\Property(property="message", type="string", example="no se encontro datos")
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Lista vacía"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Error en la solicitud",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 example=null
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=404),
     *                 @OA\Property(property="message", type="string", example="Datos de entrada inválidos: {error}")
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Error en la solicitud"
     *             )
     *         )
     *     )
     * )
     */
    public function ListaPersonalAcademico() {
        try {
            $personalAcademicos = DB::table('personal_academicos')
                ->join('tipo_personals', 'personal_academicos.tipo_personal_id', '=', 'tipo_personals.id')
                ->select(
                    'tipo_personals.nombre as Tipo_personal',
                    'personal_academicos.telefono',
                    'personal_academicos.id as personal_academico_id',
                    'tipo_personals.id as tipo_personal_id',
                    'personal_academicos.name',
                    'personal_academicos.email',
                    'personal_academicos.estado'
                )
                ->get();
    
            if ($personalAcademicos->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'error' => [
                        'code' => 204,
                        'message' => 'no se encontro datos'
                    ],
                    'message' => 'Lista vacía'
                ], 204);
            }
    
            return response()->json([
                'success' => true,
                'data' => $personalAcademicos,
                'error' => null,
                'message' => 'Operación exitosa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 404,
                    'message' => 'Datos de entrada inválidos: ' . $e->getMessage()
                ],
                'message' => 'Error en la solicitud'
            ], 404);
        }
    }
}
