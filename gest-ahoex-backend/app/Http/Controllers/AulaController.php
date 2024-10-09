/**
 * @OA\Get(
 *     path="/api/aulas",
 *     tags={"Aulas"},
 *     summary="Obtener lista de aulas",
 *     description="Devuelve una lista de todas las aulas disponibles",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de aulas",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Aula"))
 *     )
 * )
 */
public function index()
{
    return Aula::all();
}

/**
 * @OA\Post(
 *     path="/api/aulas",
 *     tags={"Aulas"},
 *     summary="Crear una nueva aula",
 *     description="Crea una nueva aula en la base de datos",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Aula")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Aula creada correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/Aula")
 *     )
 * )
 */
public function store(Request $request)
{
    $aula = Aula::create($request->all());
    return response()->json($aula, 201);
}