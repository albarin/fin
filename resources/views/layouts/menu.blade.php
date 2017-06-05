<aside class="menu">
    <p class="menu-label">
        Menu
    </p>
    <ul class="menu-list">
        <li>
            <a href="{{ url('/accounts') }}" class="is-active">Accounts</a>
            <ul>
                @foreach (auth()->user()->accounts as $account)
                    <li>
                        <a href="{{ route('accounts.show', ['id' => $account->id]) }}">
                            {{ $account->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li><a href="{{ url('/categories') }}">Categories</a></li>
        <li><a href="{{ url('/budgets') }}">Budgets</a></li>
        <li><a href="{{ url('/tags') }}">Tags</a></li>
        <li><a href="{{ url('/import') }}">Import</a></li>
    </ul>
</aside>
