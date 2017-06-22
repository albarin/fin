@if (session('error'))
    <div class="notification is-warning">
        {{ session('error') }}
    </div>
@endif