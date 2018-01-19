@extends('layouts.logged')

@section('title')
    {{ $account->name }}
    <span style="vertical-align: middle" class="subtitle">{{ $balance }}&euro;</span>
    <a class="button is-pulled-right is-primary is-inverted"
       href="{{ route('transactions.create', ['account_id' => $account->id]) }}">
        Add transaction
    </a>
@endsection

@section('main')
    @include('accounts.filters')
    <div class="columns">
        <div class="column">
            <p class="subtitle is-5"><strong>Expenses:</strong> {{ $expenses }}&euro;</p>
        </div>
        <div class="column">
            <p class="subtitle is-5"><strong>Income:</strong> {{ $income }}&euro;</p>
        </div>
        <div class="column">
            <p class="subtitle is-5"><strong>Balance:</strong> {{ $income - $expenses }}&euro;</p>
        </div>
    </div>

    @if ($chart)
        <canvas id="myChart" height="100"></canvas>
        <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chart['labels']) !!},
                    datasets: [{
                        label: '',
                        data: {!! json_encode($chart['data']) !!},
                        backgroundColor: {!! json_encode($chart['colors']) !!},
                        borderColor: {!! json_encode($chart['colors']) !!},
                        borderWidth: 1
                    }]
                },
                options: {

                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex].label + ' ' + (tooltipItem.yLabel).toFixed(2) + '€';
                            }
                        }
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    @endif

    @if ($transactions->isEmpty())
        <div class="notification">
            No transactions found in the account
        </div>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Category</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
                <tr id="transaction">
                    <td>{{ $transaction->date }}</td>
                    <td>
                        <strong>{{ $transaction->name }}</strong>
                        @if ($transaction->tags->isNotEmpty())
                            <p style="font-size: 13px">
                                {{ $transaction->tags()->pluck('name')->implode(', ') }}
                            </p>
                        @endif
                    </td>
                    <td>
                        @if ($transaction->category)
                            <span class="tag" style="background-color: {{ $transaction->category->color }}; color: white;">
                                {{ $transaction->category->name }}
                            </span>
                        @endif
                    </td>
                    <td style="color: {{ $transaction->color }}">
                        <span class="amount">{{ $transaction->formattedAmount }}</span>&euro;
                    </td>
                    <td>
                        <a class="button is-pulled-left is-small is-info" href="{{ route('transactions.edit', [$transaction]) }}">
                            Edit
                        </a>
                        <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('transactions.destroy', ['id' => $transaction->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="button is-small is-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $transactions->appends(request()->all())->links() }}

        <div class="total-selected is-pulled-right">
            Total selected:
            <span class="tag is-medium is-primary">
                <span class="total">0</span>€
            </span>
        </div>

        <script>
            $(document).ready(function () {
                var sum = 0;
                $('#transaction td').on('click', function () {
                    var row = $(this).parent();
                    $(row).toggleClass('is-selected');
                    var amount = $(row).find('.amount');
                    if ($(row).hasClass('is-selected')) {
                        sum += parseFloat(amount.html());
                        console.log(sum);
                        $('.total').html(sum.toFixed(2));
                    }
                    else {
                        sum -= parseFloat(amount.html());
                        $('.total').html((sum).toFixed(2));
                    }
                });
            });
        </script>
    @endif
@endsection