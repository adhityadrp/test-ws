<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('note.store') }}" method="post">
        @csrf
        <input type="text" value="{{ $self->id }}" name="from" readonly>
        <select name="to" id="to">
            @foreach ($user as $usr)
                <option value="{{ $usr->id }}">{{ $usr->name }}</option>
            @endforeach
        </select>
        <input type="text" name="subject" id="sub">
        <input type="text" name="message" id="mes">
        <button type="submit">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
    @if ($self->id == 1)
        <script>
            window.onload=function(){
            window.App = {!! json_encode([
                'user' => auth()->check() ? auth()->user()->id : null,
            ]) !!};
            window.Echo.channel('admin')
                .listen('AdminEvent', (e) => {
                Swal.fire({
                title: 'Dari ' + e.from,
                text: e.subject,
                icon: 'error',
                confirmButtonText: '<a href="/dashboard">LINK</a>'
                })

                // console.log('.RealTimeMessage: ' + e.message)
            });
            }
        </script>
    @endif
    @if ($self->id == 2)
        <script>
            window.onload=function(){
            window.App = {!! json_encode([
                'user' => auth()->check() ? auth()->user()->id : null,
            ]) !!};
            window.Echo.channel('user')
                .listen('UserEvent', (e) => {
                Swal.fire({
                title: 'Dari ' + e.from,
                text: e.subject,
                icon: 'error',
                confirmButtonText: '<a href="/dashboard">LINK</a>'
                })

                // console.log('.RealTimeMessage: ' + e.message)
            });
            }
        </script>
    @endif
    @if ($self->id == 3)
        <script>
            window.onload=function(){
            window.App = {!! json_encode([
                'user' => auth()->check() ? auth()->user()->id : null,
            ]) !!};
            window.Echo.channel('kasir')
                .listen('KasirEvent', (e) => {
                Swal.fire({
                title: 'Dari ' + e.from,
                text: e.subject,
                icon: 'error',
                confirmButtonText: '<a href="/dashboard">LINK</a>'
                })

                // console.log('.RealTimeMessage: ' + e.message)
            });
            }
        </script>
    @endif
    @if ($self->id == 4)
        <script>
            window.onload=function(){
            window.App = {!! json_encode([
                'user' => auth()->check() ? auth()->user()->id : null,
            ]) !!};
            window.Echo.channel('kacab')
                .listen('KacabEvent', (e) => {
                Swal.fire({
                title: 'Dari ' + e.from,
                text: e.subject,
                icon: 'error',
                confirmButtonText: '<a href="/dashboard">LINK</a>'
                })

                // console.log('.RealTimeMessage: ' + e.message)
            });
            }
        </script>
    @endif
        
</x-app-layout>


