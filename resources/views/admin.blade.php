<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body {
                    font-family: 'Figtree', sans-serif;
                    background-color: #0f172a;
                    color: #e2e8f0;
                    margin: 0;
                    padding: 0;
                    min-height: 100vh;
                    display: flex;
                    flex-direction: column;
                    overflow-x: hidden;
                    background-image:
                        radial-gradient(circle at 15% 50%, rgba(17, 24, 39, 0.8) 0%, transparent 25%),
                        radial-gradient(circle at 85% 30%, rgba(14, 165, 233, 0.15) 0%, transparent 30%);
                }
                .container {
                    padding: 2rem;
                    max-width: 100%;
                    width: 100%;
                    text-align: center;
                    box-sizing: border-box;
                    margin-top: 5rem;
                    margin-bottom: 3rem;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    flex: 1;
                }
                h1 {
                    font-size: 2.5rem;
                    font-weight: 600;
                    color: #e2e8f0;
                    margin-bottom: 2rem;
                    text-shadow: 0 2px 10px rgba(14, 165, 233, 0.2);
                    letter-spacing: -0.025em;
                }
                .card {
                    background-color: rgba(30, 41, 59, 0.8);
                    backdrop-filter: blur(12px);
                    border: 1px solid rgba(71, 85, 105, 0.3);
                    border-radius: 1rem;
                    box-shadow: 0 10px 30px -5px rgba(2, 6, 23, 0.5),
                                0 0 5px rgba(14, 165, 233, 0.2);
                    max-width: 700px;
                    margin: 0 auto;
                    padding: 3rem;
                }
                .admin-options {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                    gap: 1.5rem;
                    margin-top: 2rem;
                }
                @media (max-width: 640px) {
                    .admin-options {
                        grid-template-columns: 1fr;
                    }
                    .card {
                        padding: 2rem;
                    }
                }
                .btn {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    padding: 2rem;
                    min-height: 140px;
                    border-radius: 0.75rem;
                    font-size: 1.25rem;
                    font-weight: 500;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    border: 1px solid rgba(71, 85, 105, 0.3);
                    position: relative;
                    overflow: hidden;
                }
                .btn::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 1px;
                    background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.5), transparent);
                    transform: translateX(-100%);
                    transition: transform 0.7s ease;
                }
                .btn:hover::before {
                    transform: translateX(100%);
                }
                .btn-admin {
                    background: linear-gradient(140deg, #334155, #1e293b);
                    color: white;
                    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.4);
                }
                .btn-admin:nth-child(1) {
                    background: linear-gradient(135deg, #334155, #1e293b);
                }
                .btn-admin:nth-child(2) {
                    background: linear-gradient(145deg, #334155, #1e293b);
                }
                .btn-admin:nth-child(3) {
                    background: linear-gradient(138deg, #334155, #1e293b);
                }
                .btn:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 20px 25px -5px rgba(2, 6, 23, 0.5), 0 0 15px rgba(14, 165, 233, 0.4);
                }
                .admin-icon {
                    font-size: 2.5rem;
                    margin-bottom: 0.75rem;
                    opacity: 0.9;
                }
                .admin-label {
                    margin-top: 0.5rem;
                }
                .logo {
                    position: fixed;
                    top: 1.5rem;
                    left: 50%;
                    transform: translateX(-50%);
                    font-size: 1.25rem;
                    font-weight: 600;
                    letter-spacing: -0.025em;
                    color: #e2e8f0;
                    z-index: 10;
                }
                .logo span {
                    color: #0ea5e9;
                }
                .footer {
                    position: static;
                    margin-top: auto;
                    color: rgba(148, 163, 184, 0.7);
                    font-size: 0.875rem;
                    padding: 1rem;
                    width: 100%;
                    text-align: center;
                }
                .back-btn {
                    position: fixed;
                    top: 1.5rem;
                    left: 1.5rem;
                    color: #e2e8f0;
                    text-decoration: none;
                    display: flex;
                    align-items: center;
                    font-size: 0.875rem;
                    opacity: 0.7;
                    transition: opacity 0.2s ease;
                    z-index: 10;
                }
                .back-btn:hover {
                    opacity: 1;
                }
                .back-icon {
                    margin-right: 0.5rem;
                }
                .alert {
                    padding: 1rem;
                    border-radius: 0.5rem;
                    margin-bottom: 1.5rem;
                    font-weight: 500;
                }
                .alert-success {
                    background-color: rgba(16, 185, 129, 0.2);
                    border: 1px solid rgba(16, 185, 129, 0.3);
                    color: #10b981;
                }
                .alert-error {
                    background-color: rgba(239, 68, 68, 0.2);
                    border: 1px solid rgba(239, 68, 68, 0.3);
                    color: #ef4444;
                }
            </style>
        @endif
    </head>
    <body>
        <a href="{{ route('home') }}" class="back-btn">
            <span class="back-icon">←</span> Back to Home
        </a>
        <div class="logo">Visitor<span>Management</span></div>
        <div class="container">
            <h1>Admin Dashboard</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="admin-options">
                    <a href="{{ route('admin.locations') }}" class="btn btn-admin">
                        <div class="admin-icon">🏢</div>
                        <div>Manage Locations</div>
                    </a>
                    <a href="{{ route('admin.visitors') }}" class="btn btn-admin">
                        <div class="admin-icon">📊</div>
                        <div>View Visitors</div>
                    </a>
                    <a href="#" class="btn btn-admin" style="opacity: 0.7; cursor: not-allowed;" title="Coming soon!">
                        <div class="admin-icon">⚙️</div>
                        <div>System Settings</div>
                        <div style="font-size: 0.7rem; margin-top: 0.5rem; opacity: 0.7;">Coming soon</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer">© {{ date('Y') }} VisitorMS</div>
    </body>
</html>
