<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

// 기본 페이지를 고객 목록으로 리다이렉트
Route::redirect('/', '/customers');

// 고객 관리용 RESTful 라우트 (모달 UI 사용하므로 create/show 제외)
Route::resource('customers', CustomerController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'show']);
