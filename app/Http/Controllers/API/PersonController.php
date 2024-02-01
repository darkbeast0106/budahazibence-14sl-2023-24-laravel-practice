<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Person::all();
        $people = Person::all();
        return response()->json($people);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        //return Person::create($request->all());
        $person = new Person();
        $person->fill($request->all());
        // $person->name = $request->name;
        $person->save();
        return response()->json($person, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $person = Person::find($id);
        if (is_null($person)) {
            return response()->json(["message" => "Person not found with id: $id"], 404);
        }
        return $person;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, string $id)
    {
        $person = Person::find($id);
        if (is_null($person)) {
            return response()->json(["message" => "Person not found with id: $id"], 404);
        }
        $person->fill($request->all());
        $person->save();
        return $person;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = Person::find($id);
        if (is_null($person)) {
            return response()->json(["message" => "Person not found with id: $id"], 404);
        }
        $person->delete();
        return response()->noContent();
    }
}
