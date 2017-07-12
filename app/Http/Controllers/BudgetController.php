<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\Http\Requests\StoreBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Auth::user()->budgets;

        return view('budgets.index', [
            'budgets' => $budgets,
        ]);
    }

    public function create()
    {
        return view('budgets.create', [
            'categories' => Category::parents()->get(),
        ]);
    }

    public function store(StoreBudget $request)
    {
        $budget = new Budget($request->all());
        $budget->user()
            ->associate(Auth::user())
            ->save();

        return redirect()
            ->route('budgets.index')
            ->withSuccess('New budget created successfully');
    }

    public function edit(Budget $budget)
    {
        return view('budgets.edit', [
            'budget' => $budget,
            'categories' => Category::parents()->get(),
        ]);
    }

    public function update(StoreBudget $request, Budget $budget)
    {
        $budget->update($request->all());

        return redirect()
            ->route('budgets.index')
            ->withSuccess('Budget updated successfully');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()
            ->route('budgets.index')
            ->withSuccess('Budget removed successfully');
    }
}
