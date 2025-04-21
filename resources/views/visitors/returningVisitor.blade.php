<!-- returning visitor, find the visitor by email and show the visitor details then submit new entry with new purpose -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Returning Visitor</title>

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
                h2 {
                    font-size: 1.8rem;
                    font-weight: 600;
                    color: #e2e8f0;
                    margin-bottom: 1.5rem;
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
                    max-width: 500px;
                    margin: 0 auto;
                    padding: 2.5rem;
                    margin-bottom: 2rem;
                }
                form {
                    display: flex;
                    flex-direction: column;
                    gap: 1.25rem;
                }
                input, select, textarea {
                    width: 100%;
                    padding: 0.75rem 1rem;
                    border-radius: 0.5rem;
                    border: 1px solid rgba(71, 85, 105, 0.3);
                    background-color: rgba(15, 23, 42, 0.5);
                    color: #e2e8f0;
                    font-size: 1rem;
                    transition: all 0.3s ease;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                input:focus, select:focus, textarea:focus {
                    outline: none;
                    border-color: #0ea5e9;
                    box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.2);
                    background-color: rgba(15, 23, 42, 0.7);
                }
                input::placeholder {
                    color: rgba(148, 163, 184, 0.7);
                }
                label {
                    display: block;
                    text-align: left;
                    margin-bottom: 0.5rem;
                    font-weight: 500;
                    color: #e2e8f0;
                }
                .form-group {
                    text-align: left;
                }
                button {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0.75rem 1.5rem;
                    border-radius: 0.5rem;
                    font-size: 1rem;
                    font-weight: 500;
                    border: none;
                    background: linear-gradient(140deg, #0ea5e9, #2563eb);
                    color: white;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
                    position: relative;
                    overflow: hidden;
                }
                button::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 1px;
                    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
                    transform: translateX(-100%);
                    transition: transform 0.7s ease;
                }
                button:hover::before {
                    transform: translateX(100%);
                }
                button:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 15px 25px -5px rgba(2, 6, 23, 0.5), 0 0 10px rgba(14, 165, 233, 0.4);
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
                .btn-icon {
                    margin-right: 0.5rem;
                }
                .visitor-details {
                    background-color: rgba(15, 23, 42, 0.6);
                    padding: 1.5rem;
                    border-radius: 0.75rem;
                    margin: 1.5rem 0;
                    text-align: left;
                    border: 1px solid rgba(71, 85, 105, 0.2);
                }
                .visitor-details p {
                    margin: 0.5rem 0;
                    font-size: 1rem;
                    color: #e2e8f0;
                }
                .visitor-details p strong {
                    font-weight: 600;
                    margin-right: 0.5rem;
                    color: #94a3b8;
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
                .error-text {
                    color: #ef4444;
                    font-size: 0.875rem;
                    margin-top: 0.375rem;
                }
                @media (max-width: 640px) {
                    .card {
                        padding: 1.5rem;
                    }
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
            <h1>Returning Visitor Check-In</h1>

            <div class="card">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        Please fix the following errors:
                    </div>
                @endif

                @if(isset($locationName))
                    <div style="margin-bottom: 1.5rem; text-align: center; padding: 0.75rem; background-color: rgba(14, 165, 233, 0.1); border-radius: 0.5rem; border: 1px solid rgba(14, 165, 233, 0.2);">
                        <p style="margin: 0; font-weight: 500;">Location: {{ $locationName }}</p>
                    </div>
                @endif

                @if(isset($status) && $status === 'not_found' && isset($email))
                    <div class="alert alert-error">
                        No visitor found with email: {{ $email }}
                    </div>
                @endif

                @if(isset($status) && $status === 'not_checked_out' && isset($activeVisitor))
                    <div class="alert alert-error">
                        This visitor is already checked in and has not checked out yet.
                    </div>
                    <div class="visitor-details">
                        <p><strong>Visit Date:</strong> {{ $activeVisitor->visit_datetime }}</p>
                        <p><strong>Purpose:</strong> {{ $activeVisitor->purpose }}</p>
                        <p><strong>Name:</strong> {{ $activeVisitor->name }}</p>
                        <p><strong>Email:</strong> {{ $activeVisitor->email }}</p>
                        <p><strong>Phone:</strong> {{ $activeVisitor->phone }}</p>
                    </div>
                @endif

                <!-- Find visitor details -->
                <form action="{{ route('returningVisitor') }}" method="get">
                    <input type="email" name="email" placeholder="Enter visitor's email address" required>
                    <button type="submit">
                        <span class="btn-icon">🔍</span> Find Visitor
                    </button>
                </form>
            </div>

            @if (isset($visitor))
                <div class="card">
                    <h2>Visitor Found</h2>
                    <div class="visitor-details">
                        <p><strong>Visit Date:</strong> {{ $visitor->visit_datetime }}</p>
                        <p><strong>Purpose:</strong> {{ $visitor->purpose }}</p>
                        <p><strong>Name:</strong> {{ $visitor->name }}</p>
                        <p><strong>Email:</strong> {{ $visitor->email }}</p>
                        <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
                    </div>

                    <form action="{{ route('saveReturningVisitor') }}" method="post">
                        @csrf
                        <input type="hidden" name="visitor_id" value="{{ $visitor->id }}">
                        <input type="hidden" name="location_id" value="{{ $locationId }}">
                        <div class="form-group">
                            <label for="purpose">Purpose of Visit</label>
                            <input type="text" id="purpose" name="purpose" placeholder="Purpose of today's visit" required>
                        </div>
                        <button type="submit">
                            <span class="btn-icon">✅</span> Check-In Visitor
                        </button>
                    </form>
                </div>
            @endif
        </div>
        <div class="footer">© {{ date('Y') }} VisitorMS</div>
    </body>
</html>
