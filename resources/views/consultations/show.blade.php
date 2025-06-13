@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">상담 상세정보</h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">고객명: {{ $consultation->customer->name_kr }}</h5>
            <p class="card-text"><strong>상담일:</strong> {{ \Carbon\Carbon::parse($consultation->consulted_at)->format('Y-m-d') }}</p>
            <p class="card-text"><strong>담당자:</strong> {{ $consultation->agent }}</p>
            <p class="card-text"><strong>진행상태:</strong> {{ $consultation->status }}</p>
            <p class="card-text"><strong>방문경로:</strong> {{ $consultation->referral_path }}</p>
        </div>
    </div>

    <a href="{{ route('consultations.index') }}" class="btn btn-secondary mt-4">목록으로</a>
</div>
@endsection
