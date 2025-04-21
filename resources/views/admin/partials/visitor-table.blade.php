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
