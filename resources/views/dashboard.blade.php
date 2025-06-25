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
                    <h1 class="text-2xl font-bold mb-4">Bem-vindo, {{ auth()->user()->name }}!</h1>

                    <p class="mb-2">Tipo de usuário: 
                        {{ optional(auth()->user()->role)->name ?? 'Sem role atribuída' }}
                    </p>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Gerenciar Usuários
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
