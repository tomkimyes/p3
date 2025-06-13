@extends('layouts.app')

@php use Carbon\Carbon; @endphp

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            고객 상세정보
        </div>
        <div class="card-body">
            <p class="mb-3"><strong>한글이름:</strong> {{ $customer->name_kr }}</p>
            <p class="mb-3"><strong>연락처:</strong> {{ $customer->phone }}</p>
            <p class="mb-3"><strong>이메일:</strong> {{ $customer->email }}</p>
            <p class="mb-3"><strong>생년월일:</strong> {{ $customer->birthday ? Carbon::parse($customer->birthday)->format('Y-m-d') : '-' }}</p>
            <p class="mb-3"><strong>성별:</strong> {{ $customer->gender }}</p>
            <p class="mb-3"><strong>영문이름:</strong> {{ $customer->name_en }}</p>
            <p class="mb-3"><strong>여권번호:</strong> {{ $customer->passport_no }}</p>
            <p class="mb-3"><strong>여권만료일:</strong> {{ $customer->passport_expiry ? Carbon::parse($customer->passport_expiry)->format('Y-m-d') : '-' }}</p>
            <p class="mb-3"><strong>이력:</strong><br>{{ $customer->history }}</p>
            <p class="mb-3"><strong>메모:</strong><br>{{ $customer->memo }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('customers.index') }}" class="btn btn-sm btn-outline-secondary">목록으로</a>
        </div>
    </div>
</div>
@endsection