<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Lista de Clientes') }}
            </h2>

            <a href="{{ route('client.create')}}">
                <x-secondary-button>Novo Cliente</x-secondary-button>
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if (session('success'))
                    <div class="p-1 text-center">
                        <div id="alert-success" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-400 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="font-medium text-xl">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                <div >
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-700 uppercase tracking-wider">#ID</th>
                                <th class="px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-700 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-700 uppercase tracking-wider">CPF</th>
                                <th class="px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-700 uppercase tracking-wider">Idade</th>
                                <th class="px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-700 uppercase tracking-wider">dt.Nascimento</th>
                                <th class="px-6 py-3 text-left text-xs leading-4 font-semibold text-gray-700 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (isset($clients) && count($clients) > 0)
                            @foreach($clients as $client)
                                <tr class="border-b-1 border-indigo-100 border-t">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $client->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $client->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $client->cpf }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $client->age }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $client->formattedDate }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                        <a href="{{ route('client.edit', $client) }}">
                                            <x-success-button>Editar</x-success-button>
                                        </a>

                                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-client-deletion_{{ $client->id }}', { id: {{ $client->id }} })"> Deletar </x-danger-button>

                                        <x-modal name="confirm-client-deletion_{{ $client->id }}"
                                            :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form action="{{ route('client.destroy', $client->id) }}"
                                                method="POST" class="p-6">
                                                @csrf
                                                @method('DELETE')
                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Tem certeza que deseja excluir este cliente?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __('Registro excluído não poderá ser recuperado.') }}
                                                </p>

                                                <div class="flex justify-end mt-6">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancelar') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ml-3">
                                                        {{ __('Excluir') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200">
                                    <p>Não há registros de clientes.</p>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
   function showAlert() {
        const alertElement = document.getElementById('alert-success');
        if (alertElement) {
            alertElement.style.display = 'block';
            setTimeout(function () {
                alertElement.style.display = 'none';
            }, 3000);
        }
    }
    window.addEventListener('load', showAlert);
</script>