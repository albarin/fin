<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\Http\Requests\StoreBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('budgets.index', [
            'budgets' => Auth::user()->budgets,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('budgets.create', [
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    /**
     * @param StoreBudget $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBudget $request)
    {
        $budget = new Budget($request->all());
        $budget->user()
            ->associate(Auth::user())
            ->save();

        return redirect()
            ->route('budgets.index');
    }

    /**
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        return view('budgets.edit', [
            'budget' => $budget,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBudget $request
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBudget $request, Budget $budget)
    {
        $budget->update($request->all());

        return redirect()->route('budgets.index');
    }

    /**
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budgets.index');
    }
}
