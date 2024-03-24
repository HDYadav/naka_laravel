@foreach ($users as $user)
<tr>
    <td> {{ $user->id }} </td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->role }}</td>
    <td>{{ $user->email }}</td>
</tr>
@if (count($user->children) > 0)
@include('admin.users.partials.subcategories', ['users' => $user->children])
@endif

@endforeach