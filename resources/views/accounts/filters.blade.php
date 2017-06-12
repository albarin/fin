<nav class="level">
    <form method="get" action="{{ route('accounts.show', [$account]) }}">
        <div class="field is-horizontal" style="display: flex; align-items: center;">
            <p style="margin-right: 10px" class="control has-icons-left">
                <input style="width: 245px" class="input" name="daterange">
                <span class="icon is-small is-left">
                    <i class="fa fa-calendar"></i>
                </span>
            </p>

            <p class="control has-icons-left">
                <span class="select">
                    <select name="category_id">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $selectedCategoryId ? 'selected' : '' }}>{{ $category->name }}</option>
                            @if (!$category->children->isEmpty())
                                @foreach ($category->children as $child)
                                    <option value="{{ $child->id }}" {{ $child->id == $selectedCategoryId ? 'selected' : '' }}>-- {{ $child->name }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </span>
                <span class="icon is-small is-left">
                    <i class="fa fa-tag"></i>
                </span>
            </p>

            <p style="margin-left: 10px">
                <button type="submit" class="button is-primary">Filter</button>
                <a style="margin-left: 5px" href="{{ route('accounts.show', $account) }}" class="button">Reset</a>
            </p>
        </div>
    </form>
</nav>

<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            startDate: '{{ $startDate }}',
            endDate: '{{ $endDate }}',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 days': [moment().subtract(6, 'days'), moment()],
                'Last 30 days': [moment().subtract(29, 'days'), moment()],
                'This month': [moment().startOf('month'), moment().endOf('month')],
                'Last month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This year': [moment().startOf('year'), moment().endOf('year')],
                'Last year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
            }
        });
    });
</script>