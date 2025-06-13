<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($search = $request->input('search')) {
            $query->where('name_kr', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        if ($sort = $request->input('sort')) {
            $direction = $request->input('direction', 'asc');
            $query->orderBy($sort, $direction);
        } else {
            $query->orderByDesc('created_at');
        }

        $customers = $query->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_kr' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:MR,MS,MSTR,MISS,INF',
            'name_en' => 'nullable|string|max:255',
            'passport_no' => 'nullable|string|max:100',
            'passport_expiry' => 'nullable|date',
            'history' => 'nullable|string',
            'memo' => 'nullable|string',
        ]);

        $data['phone'] = preg_replace("/^(\d{3})(\d{4})(\d{4})$/", "$1-$2-$3", $data['phone']);
        $data['name_en'] = strtoupper($data['name_en'] ?? '');

        Customer::create($data);

        return redirect()->back()->with('success', '고객이 등록되었습니다.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $data = $request->validate([
            'name_kr' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:MR,MS,MSTR,MISS,INF',
            'name_en' => 'nullable|string|max:255',
            'passport_no' => 'nullable|string|max:100',
            'passport_expiry' => 'nullable|date',
            'history' => 'nullable|string',
            'memo' => 'nullable|string',
        ]);

        $data['phone'] = preg_replace("/^(\d{3})(\d{4})(\d{4})$/", "$1-$2-$3", $data['phone']);
        $data['name_en'] = strtoupper($data['name_en'] ?? '');

        $customer->update($data);

        return redirect()->back()->with('success', '고객 정보가 수정되었습니다.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', '고객이 삭제되었습니다.');
    }
}
