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
        $totalPower = 0;
        if ($selectedCpu) $totalPrice += $selectedCpu->price;
        if ($selectedRam) $totalPrice += $selectedRam->price;
        if ($selectedSsd) $totalPrice += $selectedSsd->price;
        if ($selectedCpu) $totalPower += $selectedCpu->power;
        if ($selectedRam) $totalPower += $selectedRam->power;
        if ($selectedSsd) $totalPower += $selectedSsd->power;

        return view('main', compact('selectedCpu', 'selectedRam', 'selectedSsd', 'totalPrice', 'totalPower'));
    }

    // Function to reset selections
    public function resetSelections()
    {
        session()->forget(['selected_cpu', 'selected_memory', 'selected_ssd']);
        return redirect()->route('main.page1')->with('status', 'Selections reset successfully!');
    }
    public function showBottleneckCalculator()
    {
        // Retrieve selected components from the session
        $selectedCpu = session('selected_cpu', null);
        $selectedRam = session('selected_memory', null);
        $selectedSsd = session('selected_ssd', null);

        // Pass the components to the bottleneck calculator view
        return view('bottleneck', compact('selectedCpu', 'selectedRam', 'selectedSsd'));
    }

// Calculate Bottleneck Logic
    public function calculateBottleneck(Request $request)
    {
        // Generate a random bottleneck value between 0 and 100
        $bottleneck = rand(0, 100);

        // Retrieve selected components from the session (optional if needed for further logic)
        $selectedCpu = $request->session()->get('selected_cpu');
        $selectedRam = $request->session()->get('selected_memory');
        $selectedSsd = $request->session()->get('selected_ssd');

        // Store the bottleneck value in the session and redirect back to the bottleneck calculator page
        return redirect()->route('bottleneck.calculator')->with([
            'bottleneck' => $bottleneck,
            'selectedCpu' => $selectedCpu,
            'selectedRam' => $selectedRam,
            'selectedSsd' => $selectedSsd,
        ]);
    }

}
