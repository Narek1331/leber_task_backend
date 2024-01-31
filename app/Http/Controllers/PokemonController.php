<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PokemonService;
use App\Http\Requests\Pokemon\StoreRequest as PokemonStoreRequest;
use App\Http\Requests\Pokemon\UpdateRequest as PokemonUpdateRequest;
class PokemonController extends Controller
{
    /**
     * PokemonService instance.
     *
     * @return void
     */
    public function __construct(PokemonService $pokemon_service)
    {
        $this->pokemon_service = $pokemon_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $pokemons = $this->pokemon_service->get(...$request->all());

        return response()->json([
            'status' => true,
            'data' => $pokemons
        ], 200);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id, Request $request)
    {
        try {
            $pokemon = $this->pokemon_service->getById($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable Pokemon data.'], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $pokemon
        ], 200);

    }

    /**
     * Store pokemon data.
     *
     * @param PokemonStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PokemonStoreRequest $request)
    {
        $pokemon = $this->pokemon_service->store(...$request->all());

        return response()->json([
            'status' => true,
            'data' => $pokemon
        ], 201);

    }

    /**
     * Update pokemon data.
     *
     * @param PokemonUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, PokemonUpdateRequest $request)
    {
        try {
            $this->pokemon_service->getById($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Pokemon not found.'], 500);
        }

        $pokemon = $this->pokemon_service->update($id,...$request->all());

        return response()->json([
            'status' => true,
            'data' => $pokemon
        ], 200);

    }

    /**
     * Destroy data.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->pokemon_service->destroy($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete Pokemon.'], 500);
        }

        return response()->json([
            'status' => true,
        ], 200);
    }
    
}
