@if (session('status'))
    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-800" role="status">
        {{ session('status') }}
    </div>
@endif
