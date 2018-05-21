<aside class="menu">
    <p class="menu-label">
        Menu
    </p>
    <ul class="menu-list">
        <li><a class="{{ request()->is('/') ? 'is-active' : '' }}" href="{{ url('/') }}">Start</a></li>
        <li>
            <a href="{{ url('/accounts') }}" class="{{ request()->is('accounts') ? 'is-active' : '' }}">Accounts</a>
            <ul>
                @foreach (auth()->user()->accounts as $account)
                    <li>
                        <a class="{{ request()->is("accounts/{$account->id}") || request()->is("accounts/{$account->id}/edit") ? 'is-active' : '' }}"
                           href="{{ route('accounts.show', ['id' => $account->id]) }}">
                            {{ $account->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li><a class="{{ request()->is('categories/*') ? 'is-active' : '' }}" href="{{ url('/categories') }}">Categories</a></li>
        <li><a class="{{ request()->is('budgets/*') ? 'is-active' : '' }}" href="{{ url('/budgets') }}">Budgets</a></li>
        <li><a class="{{ request()->is('tags/*') ? 'is-active' : '' }}" href="{{ url('/tags') }}">Tags</a></li>
        <li><a class="{{ request()->is('import') || request()->is('transactions/*') ? 'is-active' : '' }}" href="{{ url('/import') }}">Import transactions</a></li>
    </ul>
</aside>
