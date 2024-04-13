<div>
    <h1>Livewire is fantastic</h1>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <form action="" wire:submit='createNewUser'>
        <input type="text" name="name" wire:model='name'>
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        <input type="email" name="email" wire:model='email'>
        @error('email')
        <p>{{ $message }}</p>
        @enderror
        <input type="password" name="password" wire:model='password'>
        @error('password')
        <p>{{ $message }}</p>
    @enderror
        <button>save</button>
    </form>
    <hr>
    @foreach ($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
    {{ $users->links() }}
</div>
