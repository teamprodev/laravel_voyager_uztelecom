<div class="my-24">
    @if(session()->has('success'))
        <div class="alert alert-success w-full bg-green-500">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('danger'))
        <div class="alert alert-success w-full bg-red-500">
            {{ session()->get('danger') }}
        </div>
    @endif
</div>
