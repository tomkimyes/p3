@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h2 class="card-title mb-4">고객 목록</h2>

            {{-- 검색 및 등록 폼 --}}
            <form method="GET" action="{{ route('customers.index') }}" class="mb-3">
                <div class="row g-2">
                    <div class="col-12 col-md-8">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="이름, 연락처, 이메일 검색">
                    </div>
                    <div class="col-6 col-md-2">
                        <button class="btn btn-outline-primary w-100" type="submit">검색</button>
                    </div>
                    <div class="col-6 col-md-2">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#customerModal" onclick="openCreateModal()">+ 고객 등록</button>
                    </div>
                </div>
            </form>

            {{-- 고객 테이블 --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>한글이름</th>
                            <th>연락처</th>
                            <th class="d-none d-md-table-cell">이메일</th>
                            <th class="d-none d-md-table-cell">생년월일</th>
                            <th class="d-none d-md-table-cell">성별</th>
                            <th class="d-none d-md-table-cell">영문이름</th>
                            <th class="text-center d-none d-md-table-cell">관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->name_kr }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td class="d-none d-md-table-cell">{{ $customer->email }}</td>
                                <td class="d-none d-md-table-cell">{{ $customer->birthday }}</td>
                                <td class="d-none d-md-table-cell">{{ $customer->gender }}</td>
                                <td class="d-none d-md-table-cell">{{ $customer->name_en }}</td>
                                <td class="text-center d-none d-md-table-cell">
                                    <button class="btn btn-sm btn-outline-secondary me-1" onclick="openEditModal({{ $customer->id }})">수정</button>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('정말 삭제할까요?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">삭제</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 페이지네이션 --}}
            <div class="mt-3">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>

{{-- 모달 --}}
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="customerForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">고객 등록</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="닫기"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" id="customerId">
                    <div class="col-md-6">
                        <label class="form-label">한글이름</label>
                        <input type="text" name="name_kr" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">연락처</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">이메일</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">생년월일</label>
                        <input type="date" name="birthday" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">성별</label>
                        <select name="gender" class="form-select">
                            <option value="">선택</option>
                            <option value="MR">MR</option>
                            <option value="MS">MS</option>
                            <option value="MSTR">MSTR</option>
                            <option value="MISS">MISS</option>
                            <option value="INF">INF</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">영문이름</label>
                        <input type="text" name="name_en" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">여권번호</label>
                        <input type="text" name="passport_no" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">여권만료일</label>
                        <input type="date" name="passport_expiry" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">이력</label>
                        <textarea name="history" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">메모</label>
                        <textarea name="memo" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">저장</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    const form = document.getElementById('customerForm');
    form.action = "{{ route('customers.store') }}";
    form.reset();
    form.querySelector('input[name="_method"]').value = "POST";
    document.getElementById('customerModalLabel').textContent = "고객 등록";
}

function openEditModal(id) {
    fetch(`/customers/${id}/edit`)
        .then(res => res.json())
        .then(data => {
            const form = document.getElementById('customerForm');
            form.action = `/customers/${id}`;
            form.querySelector('input[name="_method"]').value = "PUT";
            document.getElementById('customerModalLabel').textContent = "고객 수정";

            Object.keys(data).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input) input.value = data[key];
            });

            new bootstrap.Modal(document.getElementById('customerModal')).show();
        });
}
</script>
@endsection