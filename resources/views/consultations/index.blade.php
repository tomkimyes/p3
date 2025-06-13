@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">상담 목록</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createConsultationModal">상담 등록</button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>상담일</th>
                    <th>고객명</th>
                    <th>담당자</th>
                    <th>진행상태</th>
                    <th>방문경로</th>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($consultations as $consultation)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($consultation->consulted_at)->format('Y-m-d') }}</td>
                    <td>{{ $consultation->customer->name_kr ?? '-' }}</td>
                    <td>{{ $consultation->agent ?? '-' }}</td>
                    <td>{{ $consultation->status ?? '-' }}</td>
                    <td>{{ $consultation->referral_path ?? '-' }}</td>
                    <td>
                        <a href="{{ route('consultations.show', $consultation->id) }}" class="btn btn-outline-secondary btn-sm">보기</a>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editConsultationModal-{{ $consultation->id }}">
                            수정
                        </button>
                        <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('정말 삭제하시겠습니까?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">삭제</button>
                        </form>
                        <a href="#" class="btn btn-outline-success btn-sm">계약 전환</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">상담 내역이 없습니다.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $consultations->links() }}
    </div>
</div>

<!-- 상담 등록 모달 -->
<div class="modal fade" id="createConsultationModal" tabindex="-1" aria-labelledby="createConsultationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('consultations.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="createConsultationModalLabel">상담 등록</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="닫기"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">상담일</label>
            <input type="date" name="consulted_at" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">담당자</label>
            <input type="text" name="agent" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">진행상태</label>
            <select name="status" class="form-select">
              <option value="">선택</option>
              <option value="상담중">상담중</option>
              <option value="계약전환">계약전환</option>
              <option value="보류">보류</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">방문경로</label>
            <input type="text" name="referral_path" class="form-control">
          </div>
          <div class="col-md-12">
            <label class="form-label">고객 선택</label>
            <select name="customer_id" class="form-select">
              @foreach(App\Models\Customer::latest()->get() as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name_kr }} ({{ $customer->phone }})</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
        <button type="submit" class="btn btn-primary">등록</button>
      </div>
    </form>
  </div>
</div>

@endsection

<!-- 상담 수정 모달 -->
@foreach($consultations as $consultation)
<div class="modal fade" id="editConsultationModal-{{ $consultation->id }}" tabindex="-1" aria-labelledby="editConsultationModalLabel-{{ $consultation->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('consultations.update', $consultation->id) }}" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="editConsultationModalLabel-{{ $consultation->id }}">상담 수정</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="닫기"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">상담일</label>
            <input type="date" name="consulted_at" class="form-control" value="{{ \Carbon\Carbon::parse($consultation->consulted_at)->format('Y-m-d') }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">담당자</label>
            <input type="text" name="agent" class="form-control" value="{{ $consultation->agent }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">진행상태</label>
            <select name="status" class="form-select">
              <option value="">선택</option>
              <option value="상담중" @selected($consultation->status === '상담중')>상담중</option>
              <option value="계약전환" @selected($consultation->status === '계약전환')>계약전환</option>
              <option value="보류" @selected($consultation->status === '보류')>보류</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">방문경로</label>
            <input type="text" name="referral_path" class="form-control" value="{{ $consultation->referral_path }}">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
        <button type="submit" class="btn btn-primary">수정</button>
      </div>
    </form>
  </div>
</div>
@endforeach
