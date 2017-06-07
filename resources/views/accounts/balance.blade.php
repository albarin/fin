<nav class="level">
    <div class="level-item has-text-centered">
        <div>
            <p class="heading">Current balance</p>
            <p class="title">{{ $balance ?: 0 }}&euro;</p>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div>
            <p class="heading">Expenses</p>
            <p class="title">{{ $expenses ?: 0 }}&euro;</p>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div>
            <p class="heading">Savings</p>
            <p class="title">{{ $savings ?: 0 }}&euro;</p>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div>
            <p class="heading">Income</p>
            <p class="title">{{ $income ?: 0 }}&euro;</p>
        </div>
    </div>
</nav>