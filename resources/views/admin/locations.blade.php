<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Manage Locations</title>

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
                    margin-top: 5rem;
                    margin-bottom: 5rem;
                    box-sizing: border-box;
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
                    max-width: 900px;
                    margin: 0 auto;
                    padding: 2.5rem;
                    margin-bottom: 2rem;
                }
                .locations-list {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 1rem;
                    margin-top: 2rem;
                    margin-bottom: 2rem;
                }
                .location-item {
                    background-color: rgba(15, 23, 42, 0.5);
                    border: 1px solid rgba(71, 85, 105, 0.2);
                    border-radius: 0.75rem;
                    padding: 1.25rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    transition: all 0.3s ease;
                    flex-wrap: wrap;
                }
                .location-item:hover {
                    background-color: rgba(15, 23, 42, 0.7);
                    transform: translateY(-2px);
                    box-shadow: 0 8px 20px rgba(2, 6, 23, 0.3);
                }
                .location-details {
                    text-align: left;
                }
                .location-name {
                    font-size: 1.25rem;
                    font-weight: 600;
                    margin-bottom: 0.5rem;
                }
                .location-description {
                    color: #94a3b8;
                    font-size: 0.875rem;
                }
                .location-status {
                    font-size: 0.875rem;
                    padding: 0.25rem 0.75rem;
                    border-radius: 9999px;
                    font-weight: 500;
                }
                .status-active {
                    background-color: rgba(16, 185, 129, 0.2);
                    color: #10b981;
                }
                .status-inactive {
                    background-color: rgba(239, 68, 68, 0.2);
                    color: #ef4444;
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
                    cursor: pointer;
                    transition: all 0.3s ease;
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
                }
                .btn-primary {
                    background: linear-gradient(140deg, #0ea5e9, #2563eb);
                    color: white;
                    box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
                }
                .btn-primary:hover {
                    box-shadow: 0 15px 25px -5px rgba(2, 6, 23, 0.5), 0 0 10px rgba(14, 165, 233, 0.4);
                }
                .btn-danger {
                    background: linear-gradient(140deg, #ef4444, #b91c1c);
                    color: white;
                    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
                }
                .btn-danger:hover {
                    box-shadow: 0 15px 25px -5px rgba(2, 6, 23, 0.5), 0 0 10px rgba(239, 68, 68, 0.4);
                }
                .form-actions {
                    display: flex;
                    gap: 0.75rem;
                    margin-top: 0.5rem;
                    flex-wrap: wrap;
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
                    margin-top: auto;
                    color: rgba(148, 163, 184, 0.7);
                    font-size: 0.875rem;
                    padding: 1rem;
                    text-align: center;
                    width: 100%;
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
                @media (max-width: 768px) {
                    .card {
                        padding: 1.5rem;
                    }
                    .location-item {
                        flex-direction: column;
                        align-items: flex-start;
                        gap: 1rem;
                    }
                    .form-actions {
                        margin-top: 1rem;
                        width: 100%;
                        justify-content: flex-start;
                    }
                    .flex-between {
                        flex-direction: column;
                        align-items: flex-start;
                    }
                }
                .section-divider {
                    height: 1px;
                    background: linear-gradient(90deg, transparent, rgba(71, 85, 105, 0.3), transparent);
                    margin: 2rem 0;
                }
                .flex-between {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 1rem;
                }
                /* Some quick hacks that might have been added later */
                .btn:focus {
                    outline: none; /* Didn't like the default outline */
                }
                button:active {
                    transform: translateY(1px); /* Feels more responsive */
                }
                /* Fix for Firefox rendering */
                @-moz-document url-prefix() {
                    .card {
                        background-color: rgba(30, 41, 59, 0.9);
                    }
                }
                /* Manual fix for a display issue on some browsers */
                .alert {
                    word-break: break-word;
                }
            </style>
        @endif
    </head>
    <body>
        <a href="{{ route('admin') }}" class="back-btn">
            <span class="back-icon">←</span> Back to Admin
        </a>
        <div class="logo">Visitor<span>Management</span></div>
        <div class="container">
            <h1>Manage Locations</h1>

            <div class="card">
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

                <h2>Add New Location</h2>
                <form action="{{ route('admin.locations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Location Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter location name" required>
                        @error('name')
                            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.375rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description (Optional)</label>
                        <textarea id="description" name="description" placeholder="Enter location description" rows="3"></textarea>
                        @error('description')
                            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.375rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; margin-top: 0.5rem;">
                        <input type="checkbox" id="active" name="active" value="1" checked style="width: auto; margin-right: 0.75rem;">
                        <label for="active" style="margin-bottom: 0;">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span class="btn-icon">➕</span> Add Location
                    </button>
                </form>

                <div class="section-divider"></div>

                <div class="flex-between">
                    <h2>All Locations</h2>
                    @if(app()->environment('local') && $locations->isEmpty())
                        <form action="{{ route('admin.locations.seed') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-icon">🔄</span> Generate Sample Locations
                            </button>
                        </form>
                    @endif
                </div>

                <div class="locations-list">
                    @forelse($locations as $location)
                        <div class="location-item">
                            <div class="location-details">
                                <div class="location-name">{{ $location->name }}</div>
                                @if($location->description)
                                    <div class="location-description">{{ $location->description }}</div>
                                @else
                                    <div class="location-description" style="font-style: italic; opacity: 0.5;">No description provided</div>
                                @endif
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                                <span class="location-status {{ $location->active ? 'status-active' : 'status-inactive' }}">
                                    {{ $location->active ? 'Active' : 'Inactive' }}
                                </span>
                                <form action="{{ route('admin.locations.toggle', $location->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $location->active ? 'btn-danger' : 'btn-primary' }}" style="padding: 0.375rem 0.75rem; font-size: 0.875rem;">
                                        {{ $location->active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $location->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 0.375rem 0.75rem; font-size: 0.875rem;">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 2rem; color: #94a3b8;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🏙️</div>
                            <p>No locations found. Add your first location using the form above.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="footer">© {{ date('Y') }} VisitorMS | Built with ☕ by {{ config('app.designer', 'SimeonDev') }}</div>
    </body>
</html>
