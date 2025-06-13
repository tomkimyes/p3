<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = Consultation::with('customer')->latest()->paginate(10);
        return view('consultations.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'consulted_at' => 'required|date',
            'agent' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'referral_path' => 'nullable|string|max:255',
            'customer_id' => 'required|exists:customers,id',
        ]);

        Consultation::create($validated);

        return redirect()->route('consultations.index')->with('success', '상담이 등록되었습니다.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        $consultation->load('customer');
        return view('consultations.show', compact('consultation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'consulted_at' => 'required|date',
            'agent' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'referral_path' => 'nullable|string|max:255',
        ]);

        $consultation = Consultation::findOrFail($id);
        $consultation->update($validated);

        return redirect()->route('consultations.index')->with('success', '상담이 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
