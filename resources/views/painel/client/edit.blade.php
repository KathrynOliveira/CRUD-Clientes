<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Editar Cliente') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-full">
                    <form method="POST" action="{{ route('client.update', $client) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div class="">
                                    <x-input-label for="name" :value="__('Nome')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" value="{{ $client->name }}" />
                                    <x-input-error :messages="$errors->updateName->get('name')" class="mt-2" />
                                </div>
                                <div class="">
                                    <x-input-label for="cpf" :value="__('Cpf')" />
                                    <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full" autocomplete="cpf" value="{{ $client->cpf }}" />
                                    <x-input-error :messages="$errors->updatecpf->get('cpf')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div class="">
                                    <x-input-label for="email" :value="__('E-mail')" />
                                    <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" autocomplete="email" value="{{ $client->email }}"/>
                                    <x-input-error :messages="$errors->updateEmail->get('email')" class="mt-2" />
                                </div>
                                <div class="">
                                    <x-input-label for="birthdate" :value="__('Dt.Nascimento')" />
                                    <x-text-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" autocomplete="birthdate" value="{{ $client->birthdate }}"/>
                                    <x-input-error :messages="$errors->updateBirthdate->get('birthdate')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div class="">
                                    <x-input-label for="zip_code" :value="__('Cep')" />
                                    <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full" autocomplete="zip_code" oninput="searchZip_code()" value="{{ $client->address->zip_code }}"/>
                                    <x-input-error :messages="$errors->updateZip_code->get('zip_code')" class="mt-2" />
                                </div>
                                <div class="">
                                    <x-input-label for="street" :value="__('Endereço')" />
                                    <x-text-input id="street" name="street" type="text" class="mt-1 block w-full" autocomplete="street" value="{{ $client->address->street }}"/>
                                    <x-input-error :messages="$errors->updateStreet->get('street')" class="mt-2" />
                                </div>
                               
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div class="">
                                    <x-input-label for="house_number" :value="__('Número')" />
                                    <x-text-input id="house_number" name="house_number" type="text" class="mt-1 block w-full" autocomplete="house_number" value="{{ $client->address->house_number }}"/>
                                    <x-input-error :messages="$errors->updateHouse_number->get('house_number')" class="mt-2" />
                                </div>
                                <div class="">
                                    <x-input-label for="city" :value="__('Cidade')" />
                                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" autocomplete="city" value="{{ $client->address->city }}" />
                                    <x-input-error :messages="$errors->updateCity->get('city')" class="mt-2" />
                                </div>
                                <div class="">
                                    <x-input-label for="state" :value="__('Estado(UF)')" />
                                    <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" autocomplete="state" value="{{ $client->address->state }}"/>
                                    <x-input-error :messages="$errors->updateState->get('state')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex justify-end gap-4 md:grid-cols-2">
                                <x-success-button>{{ __('Salvar') }}</x-success-button>
                                
                                <x-primary-button-href link="{{ route('client.index')}}">{{ __('Voltar') }}</x-primary-button-href>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>

function searchZip_code() {
    const input = document.getElementById('zip_code').value;
    const zip_code = input.replace(/\D/g, '');

    if (zip_code.length === 8) {
        axios.get(`https://viacep.com.br/ws/${zip_code}/json/`)
            .then(response => {
                const addressData = response.data;
                document.getElementById('street').value = addressData.logradouro || '';
                document.getElementById('city').value = addressData.localidade || '';
                document.getElementById('state').value = addressData.uf || '';
            })
            .catch(error => {
                console.error('Erro ao consultar o CEP:', error);
            });
    } else {
        document.getElementById('street').value = '';
        document.getElementById('city').value = '';
        document.getElementById('state').value = '';
    }
}
</script>