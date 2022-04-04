<div class="mt-6">

@if(!isset($application->performer_user_id))
    @php
        $role_users = \App\Models\Permission::with('roles.users')->where('key', 'Company_Performer')->first()->roles->map->users; // company performer
        $users = [];
        foreach ($role_users as $role_user) {
            foreach ($role_user as $user)
            $users[] = $user;
        }
    @endphp
    <select class="col-md-6 custom-select" name="performer_user_id" id="performer_user_id">
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
@endif
</div>
{{Aire::input()->name('user_id')->value(auth()->user()->id)->class('hidden')}}
<div class="w-full text-center pb-8 ">
    <button class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">{{ __('lang.save_close') }}</button>
</div>
