<nav class="level">
    <div class="level-right">
            <span style="margin-right: 5px" class="icon">
                <i class="fa fa-calendar"></i>
            </span>

        <form method="get" action="{{ route('accounts.show', [$account]) }}">
            <p class="control">
                    <span class="select">
                        <select name="date">
                            <option>Select month...</option>
                            <option>Mayo 2017</option>
                        </select>
                    </span>
            </p>

            <span style="margin-right: 5px; margin-left: 20px" class="icon">
                    <i class="fa fa-tag"></i>
                </span>
            <p class="control">
                    <span class="select">
                        <select name="category_id">
                            <option value="">- Select category -</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === app('request')->input('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                @if (!$category->children->isEmpty())
                                    @foreach ($category->children as $child)
                                        <option value="{{ $child->id }}" {{ $child->id === app('request')->input('category_id') ? 'selected' : '' }}>-- {{ $child->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </span>
            </p>

            <p style="margin-left: 20px">
                <button type="submit" class="button is-primary">Filter</button>
                <a style="margin-left: 5px" href="{{ route('accounts.show', $account) }}" class="button">Reset</a>
            </p>
        </form>
    </div>
</nav>