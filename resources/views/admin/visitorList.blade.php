<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Visitor List</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600" rel="stylesheet" />

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
            .admin-container {
                padding: 2rem;
                max-width: 100%;
                width: 100%;
                box-sizing: border-box;
                margin-top: 5rem;
                margin-bottom: 3rem;
                display: flex;
                flex-direction: column;
                align-items: center;
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
                margin-bottom: 1.5rem;
                color: #e2e8f0;
            }
            .card {
                background-color: rgba(30, 41, 59, 0.8);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(71, 85, 105, 0.3);
                border-radius: 1rem;
                box-shadow: 0 10px 30px -5px rgba(2, 6, 23, 0.5),
                            0 0 5px rgba(14, 165, 233, 0.2);
                width: 100%;
                max-width: 1000px;
                margin: 0 auto 2rem auto;
                padding: 2rem;
            }
            .form-group {
                margin-bottom: 1.5rem;
                text-align: left;
            }
            label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
            }
            select, input, button {
                width: 100%;
                padding: 0.75rem 1rem;
                border-radius: 0.5rem;
                border: 1px solid rgba(71, 85, 105, 0.3);
                background-color: rgba(15, 23, 42, 0.5);
                color: #e2e8f0;
                font-size: 1rem;
                transition: all 0.3s ease;
            }
            select:focus, input:focus {
                outline: none;
                border-color: #0ea5e9;
                box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.2);
            }
            button {
                background: linear-gradient(140deg, #0ea5e9, #2563eb);
                color: white;
                border: none;
                font-weight: 500;
                cursor: pointer;
                margin-top: 1rem;
                box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
            }
            button:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 25px -5px rgba(2, 6, 23, 0.5), 0 0 10px rgba(14, 165, 233, 0.4);
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1.5rem;
                color: #e2e8f0;
            }
            th, td {
                padding: 1rem;
                text-align: left;
                border-bottom: 1px solid rgba(71, 85, 105, 0.3);
            }
            th {
                font-weight: 600;
                color: #94a3b8;
            }
            tr:hover {
                background-color: rgba(15, 23, 42, 0.7);
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
            .back-icon {
                margin-right: 0.5rem;
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
            .action-btn {
                background: linear-gradient(140deg, #ef4444, #b91c1c);
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                margin-top: 0;
            }
            @media (max-width: 768px) {
                .card {
                    padding: 1.5rem;
                }
                table {
                    display: block;
                    overflow-x: auto;
                }
            }
            .alert {
                padding: 0.75rem 1rem;
                border-radius: 0.5rem;
                margin-bottom: 1rem;
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
            .loading-indicator {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 2rem;
                color: #0ea5e9;
            }
            .pagination-links {
                display: flex;
                justify-content: center;
                gap: 0.5rem;
                margin-top: 1.5rem;
            }
            .pagination-links a, .pagination-links span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 2rem;
                height: 2rem;
                padding: 0 0.5rem;
                border-radius: 0.375rem;
                background-color: rgba(30, 41, 59, 0.8);
                color: #e2e8f0;
                text-decoration: none;
                transition: all 0.2s ease;
            }
            .pagination-links a:hover {
                background-color: rgba(71, 85, 105, 0.8);
            }
            .pagination-links .active span {
                background-color: #0ea5e9;
                color: white;
            }
        </style>
    </head>
    <body>
        <a href="{{ route('admin') }}" class="back-btn">
            <span class="back-icon">←</span> Back to Admin
        </a>
        <div class="logo">Visitor<span>Management</span></div>

        <div class="admin-container">
            <h1>Visitor List</h1>
            <div class="card">
                <h2>Filter Visitors</h2>
                <form id="filter-form" action="{{ route('admin.visitors') }}" method="GET">
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <div class="form-group" style="flex: 1; min-width: 200px;">
                            <label for="location">Location:</label>
                            <select id="location" name="location">
                                <option value="">All Locations</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; min-width: 200px;">
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" value="{{ request('date') }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <h2>Visitor List</h2>
                <div id="visitor-table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="visitor-table-body">
                            @foreach($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->name }}</td>
                                    <td>{{ $visitor->location_name ?? 'No Location' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visitor->visit_datetime)->format('M d, Y h:i A') }}</td>
                                    <td>
                                        @if($visitor->left)
                                            <span style="color: #ef4444;">Left</span>
                                        @else
                                            <span style="color: #10b981;">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$visitor->left)
                                        <form action="{{ route('admin.leavingVisitor') }}" method="POST" class="checkout-form" style="margin:0;">
                                            @csrf
                                            <input type="hidden" name="visitor_id" value="{{ $visitor->id }}">
                                            <button type="submit" class="action-btn">Check Out</button>
                                        </form>
                                        @else
                                            <span style="opacity: 0.5;">Checked Out</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-links" style="margin-top: 1rem;">
                        {{ $visitors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForms = document.querySelectorAll('.checkout-form');

    checkoutForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const button = this.querySelector('button');
            const originalText = button.textContent;
            const row = this.closest('tr');

            button.disabled = true;
            button.textContent = 'Processing...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const statusCell = row.querySelector('td:nth-child(4)');
                    const actionCell = row.querySelector('td:nth-child(5)');

                    statusCell.innerHTML = '<span style="color: #ef4444;">Left</span>';
                    actionCell.innerHTML = '<span style="opacity: 0.5;">Checked Out</span>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.disabled = false;
                button.textContent = originalText;
            });
        });
    });

    const filterForm = document.getElementById('filter-form');
    const locationSelect = document.getElementById('location');
    const dateInput = document.getElementById('date');

    function updateVisitorTable() {
        const tableContainer = document.getElementById('visitor-table-container');
        const loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'loading-indicator';
        loadingIndicator.innerHTML = '<div style="text-align: center; padding: 2rem;"><span style="color: #0ea5e9;">Loading...</span></div>';

        const location = locationSelect.value;
        const date = dateInput.value;

        const params = new URLSearchParams();
        if (location) params.append('location', location);
        if (date) params.append('date', date);

        params.append('ajax', '1');

        tableContainer.innerHTML = '';
        tableContainer.appendChild(loadingIndicator);

        fetch(`${filterForm.action}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            tableContainer.innerHTML = html;

            const newCheckoutForms = tableContainer.querySelectorAll('.checkout-form');
            newCheckoutForms.forEach(form => {
                form.addEventListener('submit', handleCheckoutSubmit);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            tableContainer.innerHTML = `<div style="text-align: center; padding: 2rem; color: #ef4444;">
                Error loading data. Please try again.
            </div>`;
        });
    }

    function handleCheckoutSubmit(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const button = form.querySelector('button');
        const originalText = button.textContent;
        const row = form.closest('tr');

        button.disabled = true;
        button.textContent = 'Processing...';

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const statusCell = row.querySelector('td:nth-child(4)');
                const actionCell = row.querySelector('td:nth-child(5)');

                statusCell.innerHTML = '<span style="color: #ef4444;">Left</span>';
                actionCell.innerHTML = '<span style="opacity: 0.5;">Checked Out</span>';

                const successMessage = document.createElement('div');
                successMessage.className = 'alert alert-success';
                successMessage.textContent = 'Visitor checked out successfully!';
                successMessage.style.padding = '0.5rem';
                successMessage.style.marginTop = '0.5rem';
                successMessage.style.backgroundColor = 'rgba(16, 185, 129, 0.2)';
                successMessage.style.borderRadius = '0.375rem';
                successMessage.style.border = '1px solid rgba(16, 185, 129, 0.3)';
                successMessage.style.color = '#10b981';
                row.insertAdjacentElement('afterend', successMessage);

                setTimeout(() => {
                    successMessage.remove();
                }, 3000);
            } else {
                button.disabled = false;
                button.textContent = originalText;

                const errorMessage = document.createElement('div');
                errorMessage.className = 'alert alert-error';
                errorMessage.textContent = data.message || 'An error occurred';
                errorMessage.style.padding = '0.5rem';
                errorMessage.style.marginTop = '0.5rem';
                errorMessage.style.backgroundColor = 'rgba(239, 68, 68, 0.2)';
                errorMessage.style.borderRadius = '0.375rem';
                errorMessage.style.border = '1px solid rgba(239, 68, 68, 0.3)';
                errorMessage.style.color = '#ef4444';
                row.insertAdjacentElement('afterend', errorMessage);

                setTimeout(() => {
                    errorMessage.remove();
                }, 3000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            button.disabled = false;
            button.textContent = originalText;
        });
    }

    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        updateVisitorTable();
    });

    locationSelect.addEventListener('change', function() {
        updateVisitorTable();
    });

    dateInput.addEventListener('change', function() {
        updateVisitorTable();
    });

    document.addEventListener('click', function(e) {
        const target = e.target;

        const paginationLink = target.closest('.pagination-links a');

        if (paginationLink) {
            e.preventDefault();

            const url = paginationLink.href;

            const urlObj = new URL(url);
            urlObj.searchParams.set('ajax', '1');

            const tableContainer = document.getElementById('visitor-table-container');
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'loading-indicator';
            loadingIndicator.innerHTML = '<div style="text-align: center; padding: 2rem;"><span style="color: #0ea5e9;">Loading...</span></div>';

            tableContainer.innerHTML = '';
            tableContainer.appendChild(loadingIndicator);

            fetch(urlObj.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {
                tableContainer.innerHTML = html;

                const newCheckoutForms = tableContainer.querySelectorAll('.checkout-form');
                newCheckoutForms.forEach(form => {
                    form.addEventListener('submit', handleCheckoutSubmit);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                tableContainer.innerHTML = `<div style="text-align: center; padding: 2rem; color: #ef4444;">
                    Error loading data. Please try again.
                </div>`;
            });
        }
    });
});
</script>
</html>
