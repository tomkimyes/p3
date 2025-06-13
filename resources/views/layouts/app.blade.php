<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>고객 관리</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body.bg-dark a { color: #0d6efd; }
    body.bg-dark .card,
    body.bg-dark .modal-content {
        background-color: #343a40;
        color: #ffffff;
    }
    body.bg-dark .table {
        color: #ffffff;
    }
    body.bg-dark .table thead {
        background-color: #495057;
    }
    body.bg-dark .modal-header,
    body.bg-dark .modal-footer {
        background-color: #2f3235;
        border-color: #44474a;
    }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom shadow-sm" style="background-color: #2B3035;">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/" title="홈">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.5h3v3.5a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-6.793a1 1 0 0 0-.293-.707l-6-6a1 1 0 0 0-1.414 0l-6 6A1 1 0 0 0 1 7.707V14.5a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1z"/>
                </svg>
                <span class="fs-6">고객 목록</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex ms-auto align-items-center">
                <button id="themeToggle" class="btn btn-outline-light btn-sm">🌙</button>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="text-white text-center text-lg-start mt-auto" style="background-color: #393b3d;">
        <div class="container py-4">
            <div class="text-center">
                <p class="mb-0 small">© {{ date('Y') }} 스카이허니문 여행사 관리 시스템. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    let darkMode = localStorage.getItem('theme') === 'dark';

    function applyTheme() {
        if (darkMode) {
            body.classList.add('bg-dark', 'text-white');
            body.style.backgroundColor = '';
            themeToggle.innerText = '☀️';
        } else {
            body.classList.remove('bg-dark', 'text-white');
            body.style.backgroundColor = '#dee2e6';
            themeToggle.innerText = '🌙';
        }
    }

    themeToggle.addEventListener('click', () => {
        darkMode = !darkMode;
        localStorage.setItem('theme', darkMode ? 'dark' : 'light');
        applyTheme();
    });

    applyTheme();
    </script>
</body>
</html>