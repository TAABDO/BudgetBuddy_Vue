<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeDepenseRequest;
use App\Http\Resources\DepenseResource;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepensesController extends Controller
{
    /**
     * @OA\Get(
     *path="/api/depenses",
     *tags={"Depenses"},
     *summary="Get all depenses",
     *description="Retrieve a list of all depenses",
     *
     *@OA\Response(response="200", description="List of depenses"),
     *@OA\Response(response="404", description="No depenses found"),
     * security={{"sanctumAuth": {}}},

     *)
     */
    public function index()
    {
        $user = Auth::user();
        $depenses = Depense::where('user_id', $user->id)->get();
       if ($depenses->isEmpty()) {
            return response()->json(['message' => 'No depenses found'], 404);
        }
        return response()->json(DepenseResource::collection($depenses));
    }

    /**
     *@OA\Post(
     * path="/api/depenses",
     * tags={"Depenses"},
     *  summary="Create a new depense",
     * description="Create a new depense with provided amount and date and Description",
     *
     * @OA\RequestBody(
     * required=true,
     *
     * @OA\JsonContent(
     * required={"amount" ,"date", "Description"},
     *
     * @OA\Property(property="amount", type="number"),
     * @OA\Property(property="date", type="date"),
     * @OA\Property(property="Description", type="string")
     * ),
     * ),
     *
     *@OA\Response(response="201", description="depense created"),
     *@OA\Response(response="400", description="Bad request"),
     * security={{"sanctumAuth": {}}},

     *)
     */
    public function store(Request $request)
{
    $user = Auth::user();
    $depense = new Depense;
    $depense->user_id = $user->id;
    $depense->amount = $request->amount;
    $depense->date = $request->date;
    $depense->Description = $request->Description;
    $depense->save();

    if ($depense) {
        return response()->json([
            'message' => 'Depense created successfully',
            'depense' => $depense,
        ], 201);
    }

    return response()->json([
        'message' => 'Failed to create depense'
    ], 400);
}


    /**
     *@OA\Get(
     * path="/api/depenses/{depense}",
     * tags={"Depenses"},
     * summary="Get a depense",
     * description="Retrieve a depense by its ID",
     *
     * @OA\Parameter(
     * name="depense",
     * in="path",
     * required=true,
     * description="ID of the depense",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     *
     *@OA\Response(response="201", description="Depense found"),
     *@OA\Response(response="400", description="Depense not found"),
          * security={{"sanctumAuth": {}}},

     *)
     */
    public function show(Depense $depense)
    {
        $user = Auth::user();

        if ($depense) {
            return response()->json($depense, 201);
        } else {
            return response()->json(['message' => 'Depense not found'], 400);
        }
    }

    /**
     * @OA\Put(
     * path="/api/depenses/{depense}",
     * tags={"Depenses"},
     * summary="Update a depense",
     * description="Update a depense by its ID",
     * @OA\Parameter(
     * name="depense",
     * in="path",
     * required=true,
     * description="ID of the depense",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={ "amount" ,"date", "Description"},
     * @OA\Property(property="amount", type="number"),
     * @OA\Property(property="date", type="date"),
     * @OA\Property(property="Description", type="string")
     * )
     * ),
     * @OA\Response(response="201", description="Depense updated"),
     *
     * @OA\Response(response="400", description="Depense not found"),
     *      * security={{"sanctumAuth": {}}},

     * )
     */
    public function update(storeDepenseRequest $request, Depense $depense)
{
    $this->authorize('update', $depense);
    if ($depense) {
        $depense->update($request->validated());
        return response()->json($depense, 200);
    } else {
        return response()->json(['message' => 'Depense not found'], 404);
    }
}


    /**
     * @OA\Delete(
     * path="/api/depenses/{depense}",
     * tags={"Depenses"},
     * summary="Delete a depense",
     * description="Delete a depense by its ID",
     * @OA\Parameter(
     * name="depense",
     * in="path",
     * required=true,
     * description="ID of the depense",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
     * @OA\Response(response="200", description="Depense deleted"),
     * @OA\Response(response="404", description="Depense not found"),
     *      * security={{"sanctumAuth": {}}},

     * )
     */
    public function destroy(Depense $depense)
    {
        $this->authorize('delete',$depense);

       if ($depense) {
            $depense->delete();

            return response()->json(['message' => 'Depense deleted'], 200);
        } else {
            return response()->json(['message' => 'Depense not found'], 404);
        }
    }
}
