<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Visitor Management</title>

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
                    margin-top: 2rem;
                    margin-bottom: 2rem;
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
                .buttons {
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                    gap: 2rem;
                    margin-top: 2rem;
                }
                @media (max-width: 640px) {
                    .buttons {
                        flex-direction: column;
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
                    width: 200px;
                    height: 140px;
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
                .btn-primary {
                    background: linear-gradient(140deg, #0ea5e9, #2563eb);
                    color: white;
                    box-shadow: 0 4px 20px rgba(14, 165, 233, 0.3);
                }
                .btn-secondary {
                    background: linear-gradient(135deg, #334155, #1e293b);
                    color: white;
                    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.4);
                }
                .btn:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 20px 25px -5px rgba(2, 6, 23, 0.5), 0 0 15px rgba(14, 165, 233, 0.4);
                }
                .btn-icon {
                    font-size: 2.5rem;
                    margin-bottom: 1rem;
                    opacity: 0.9;
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
                    font-weight: 700;
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
                .btn-primary:active {
                    transform: scale(0.98);
                }
                .btn-secondary:hover {
                    background: linear-gradient(135deg, #3f506e, #243143);
                }
            </style>
        @endif
    </head>
    <body>
        <div class="logo">Visitor<span>Management</span></div>
        <div class="container">
            <h1>Visitor Management System</h1>
            <div class="card">
                <div class="buttons">
                    <a href="{{ route('locations') }}" class="btn btn-primary">
                        <div class="btn-icon">👥</div>
                        Add Visitor
                    </a>
                    <a href="{{ route('admin') }}" class="btn btn-secondary">
                        <div class="btn-icon">⚙️</div>
                        Admin
                    </a>
                </div>
            </div>
        </div>
        <div class="footer">© {{ date('Y') }} VisitorMS | Designed by {{ config('app.designer', 'SimeonDev') }}</div>
    </body>
</html>


