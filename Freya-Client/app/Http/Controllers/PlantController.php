<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //példa kólától
    public function index()
    {
        $response = Http::freyarest()->get('plants');
        if ($response->status() != Response::HTTP_OK) {
            return view('404');
        }

        return view('plants.index', ['plants' => $response->json()]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plants.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Send the POST request to the API
        $response = Http::freyarest()->post('plants', $request->all());

        if ($response->status() !== 201) {
            return back()->withErrors('Failed to save the plant.');
        }

        return redirect()->route('plants.index')->with('success', 'Plant created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = Http::freyarest()->get("plants/{$id}");
        return view('plants.edit', ['plant' => $response->json()]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Send the PUT request to the API
        $response = Http::freyarest()->put("plant/{$id}", $request->all());

        if ($response->status() !== 200) {
            return back()->withErrors('Failed to update the plant.');
        }

        return redirect()->route('plants.index')->with('success', 'Plant updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::freyarest()->delete("plant/{$id}");

        if ($response->status() !== 200) {
            return back()->withErrors('Failed to delete the plant.');
        }

        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully!');
    }
}