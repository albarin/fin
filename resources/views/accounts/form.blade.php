{{ csrf_field() }}

<input type="text" name="name" value="{{ isset($account) ? $account->name : ''}}">

<button type="submit">Save</button>
