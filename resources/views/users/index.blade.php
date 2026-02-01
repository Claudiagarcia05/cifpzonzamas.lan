@foreach ($users as $user)
<p>{{ $user->name .'-'. $user->id . '-' . $user->email }}</p>
@endforeach