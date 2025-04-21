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
                    padding: 2rem;
                }
                .card-body {
                    padding: 1.5rem;
                    margin-bottom: 1rem;
                    border-radius: 0.75rem;
                    background-color: rgba(15, 23, 42, 0.5);
                    border: 1px solid rgba(71, 85, 105, 0.2);
                    transition: all 0.3s ease;
                }
                .card-body:hover {
                    background-color: rgba(15, 23, 42, 0.7);
                    border-color: rgba(14, 165, 233, 0.3);
                    transform: translateY(-2px);
                    box-shadow: 0 8px 20px rgba(2, 6, 23, 0.3);
                }
                .card-body:nth-child(1):hover {
                    transform: translateY(-3px) rotate(0.5deg);
                }
                .card-body:nth-child(2):hover {
                    transform: translateY(-2px) rotate(-0.3deg);
                }
                .card-body:nth-child(3):hover {
                    transform: translateY(-2.5px) rotate(0.2deg);
                }
                .card-title {
                    font-size: 1.5rem;
                    font-weight: 600;
                    margin-bottom: 1.25rem;
                    color: #e2e8f0;
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
                        padding: 1.5rem;
                    }
                }
                .btn {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0.75rem 1.5rem;
                    border-radius: 0.5rem;
                    font-size: 1rem;
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
                    box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
                }
                .btn-secondary {
                    background: linear-gradient(140deg, #334155, #1e293b);
                    color: white;
                    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.4);
                }
                .btn:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 15px 25px -5px rgba(2, 6, 23, 0.5), 0 0 10px rgba(14, 165, 233, 0.4);
                }
                .btn-icon {
                    font-size: 1.25rem;
                    margin-right: 0.5rem;
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
            </style>
        @endif
    </head>
<body>
    <a href="{{ route('locations') }}" class="back-btn">
        <span class="back-icon">←</span> Back to Locations
    </a>
    <div class="logo">Visitor<span>Management</span></div>
    <div class="container">
        <h1>Visitor Options</h1>
        <div class="card">
            @if(session('success'))
                <div style="padding: 1rem; margin-bottom: 1.5rem; border-radius: 0.5rem; background-color: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; font-weight: 500;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('selected_location_name'))
                <div style="margin-bottom: 1.5rem; text-align: center; padding: 0.75rem; background-color: rgba(14, 165, 233, 0.1); border-radius: 0.5rem; border: 1px solid rgba(14, 165, 233, 0.2);">
                    <p style="margin: 0; font-weight: 500;">Location: {{ session('selected_location_name') }}</p>
                </div>
            @endif

            <div class="card-body">
                <h5 class="card-title">New Visitor</h5>
                <a href="{{ route('newVisitor') }}" class="btn btn-primary">
                    <span class="btn-icon">➕</span> Register New Visitor
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">Returning Visitor</h5>
                <a href="{{ route('returningVisitor') }}" class="btn btn-primary" style="background: linear-gradient(140deg, #0369a1, #2563eb);">
                    <span class="btn-icon">🔄</span> Check-in Returning Visitor
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">Leaving Visitor</h5>
                <a href="{{ route('leavingVisitor') }}" class="btn btn-primary" style="background: linear-gradient(140deg, #0e7490, #2563eb);">
                    <span class="btn-icon">👋</span> Check-out Visitor
                </a>
            </div>
        </div>
    </div>
    <div class="footer">© {{ date('Y') }} VisitorMS</div>
</body>
</html>
