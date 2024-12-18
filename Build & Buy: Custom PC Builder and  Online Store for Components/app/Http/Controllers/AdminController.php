<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\Poll;
class AdminController extends Controller

{
    public function showLoginPage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            session(['user_name' => Auth::user()->name]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials or unauthorized access']);
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('user_name');
        return redirect()->route('main.page');
    }

    public function showComponents(Request $request, $type = null)
    {
        $type = $request->query('type', $type);
        $components = $type ? Component::where('type', $type)->get() : collect();
        return view('admin.dashboard', compact('components', 'type'));
    }

    public function updateComponentQuantity(Request $request, $id)
    {
        $component = Component::findOrFail($id);
        $newQuantity = $component->quantity + $request->input('quantity');
        $component->quantity = max(0, $newQuantity);
        $component->save();

        return redirect()->back()->with('success', 'Quantity updated successfully!');
    }

    public function deleteComponent($id)
    {
        $component = Component::findOrFail($id);
        $component->delete();

        return redirect()->back()->with('success', 'Component deleted successfully!');
    }

    public function addComponent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Component::create($validated);

        return redirect()->back()->with('success', 'New component added successfully!');
    }


    public function exportComponents($type = null, $format = 'excel')
    {
        $components = $type ? Component::where('type', $type)->get() : Component::all();

        if ($format == 'pdf') {
            return $this->exportPdf($components);
        } else {
            return $this->exportExcel($components);
        }
    }

    public function exportExcel($components)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Name')
            ->setCellValue('C1', 'Type')
            ->setCellValue('D1', 'Brand')
            ->setCellValue('E1', 'Price')
            ->setCellValue('F1', 'Stock Quantity')
            ->setCellValue('G1', 'Created At')
            ->setCellValue('H1', 'Updated At');

        // Add data to the sheet
        $row = 2;
        foreach ($components as $component) {
            $sheet->setCellValue('A' . $row, $component->id)
                ->setCellValue('B' . $row, $component->name)
                ->setCellValue('C' . $row, $component->type)
                ->setCellValue('D' . $row, $component->brand)
                ->setCellValue('E' . $row, $component->price)
                ->setCellValue('F' . $row, $component->quantity)
                ->setCellValue('G' . $row, $component->created_at)
                ->setCellValue('H' . $row, $component->updated_at);
            $row++;
        }

        // Write the file to the browser
        $writer = new Xlsx($spreadsheet);
        $fileName = 'components.xlsx';
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
    public function updateComponent(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $component = Component::findOrFail($id);
        $component->update($validated);

        return redirect()->back()->with('success', 'Component updated successfully!');
    }

    public function createPoll(Request $request)
    {
        // Validate the poll data
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'option1' => 'required|string|max:255',
            'option2' => 'required|string|max:255',
            'option3' => 'required|string|max:255',
            'option4' => 'required|string|max:255',
            'is_active' => 'boolean',  // Ensures it's either true or false
        ]);

        // Create a new poll
        Poll::create([
            'type' => 'poll', // This assumes that the poll type is fixed as 'poll'
            'question' => $validated['question'],
            'option1' => $validated['option1'],
            'option2' => $validated['option2'],
            'option3' => $validated['option3'],
            'option4' => $validated['option4'],
            'vote_count' => 0,  // Initial vote count is 0
            'is_active' => $validated['is_active'] ?? true,  // Default to active if not provided
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Poll created successfully!');
    }

    public function showPolls()
    {
        // Fetch all polls (active and inactive)
        $polls = Poll::all();

        return view('admin.dashboard', compact('polls'));
    }


    public function togglePoll($id)
    {
        // Find the poll by ID and toggle its active status
        $poll = Poll::findOrFail($id);
        $poll->is_active = !$poll->is_active;
        $poll->save();

        return redirect()->back()->with('success', 'Poll status updated successfully.');
    }

    public function deletePoll($id)
    {
        // Find the poll by ID and delete it
        $poll = Poll::findOrFail($id);
        $poll->delete();

        return redirect()->back()->with('success', 'Poll deleted successfully.');
    }




    public function showCoupons()
    {
        $coupons = Coupon::all(); // Fetch all coupons
        return view('admin.dashboard', compact('coupons')); // Pass to the dashboard
    }

    public function createCoupon(Request $request)
    {
        $validated = $request->validate([
            'coupon_code' => 'required|string|unique:coupons|max:50',
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        Coupon::create([
            'coupon_code' => $request->input("coupon_code"), // Use 'code' from form
            'discount' => $validated['discount']
        ]);


        return redirect()->back()->with('success', 'Coupon created successfully!');
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->back()->with('success', 'Coupon deleted successfully!');
    }

    public function updateCoupon(Request $request, $id)
    {
        $validated = $request->validate([
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($validated);

        return redirect()->back()->with('success', 'Coupon updated successfully!');
    }




}
