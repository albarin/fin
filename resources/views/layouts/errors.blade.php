@if (session('flash_type'))
    <div class="alert notification is-{{session('flash_type')}}">
        {{ session('flash_message') }}
    </div>
@endif