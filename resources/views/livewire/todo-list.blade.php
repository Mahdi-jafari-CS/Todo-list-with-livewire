<div>
    @if (@session('error'))

    <P>{{ session('error') }}</P>

    @endif
    @include('livewire.includes.create-todos')

    @include('livewire.includes.searchbox')
    <div id="todos-list">
        @foreach ($todos as $todo)
            @include('livewire.includes.todo-card')
        @endforeach


        <div class="my-2">
            <!-- Pagination goes here -->
            {{ $todos->links() }}
        </div>
    </div>

</div>
