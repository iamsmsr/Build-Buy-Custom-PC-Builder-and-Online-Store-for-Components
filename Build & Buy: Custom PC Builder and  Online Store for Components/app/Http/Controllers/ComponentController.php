<?php

namespace App\Http\Controllers;

use App\Models\Component;

use Illuminate\Http\Request;

class ComponentController extends Controller
{
    // Function to show all components of a specific type (CPU, RAM, SSD)
    public function showByType($type)
    {
        $components = Component::where('type', $type)->get();
        return view('components', compact('components'));
    }

    // Function to add a component to the session
    public function addComponent(Request $request, $type, $id)
    {
        $component = Component::find($id);
        $request->session()->put('selected_' . strtolower($type), $component);
        return redirect()->route('main.page1');
    }

    // Function to show the main page with selected components
    public function main(Request $request)
    {
        if (!$request->session()->has('user_name')) {
            $request->session()->put('user_name', 'Annonymous');
        }

        $selectedCpu = $request->session()->get('selected_cpu');
        $selectedRam = $request->session()->get('selected_memory');
        $selectedSsd = $request->session()->get('selected_ssd');

        $totalPrice = 0;
        if ($selectedCpu) $totalPrice += $selectedCpu->price;
        if ($selectedRam) $totalPrice += $selectedRam->price;
        if ($selectedSsd) $totalPrice += $selectedSsd->price;

        return view('main', compact('selectedCpu', 'selectedRam', 'selectedSsd', 'totalPrice'));
    }

    // Function to reset selections
    public function resetSelections()
    {
        session()->forget(['selected_cpu', 'selected_memory', 'selected_ssd']);
        return redirect()->route('main.page1')->with('status', 'Selections reset successfully!');
    }
}
