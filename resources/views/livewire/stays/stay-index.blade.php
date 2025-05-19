<div class="min-h-full">
    <!-- Barra de busca -->
    <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 mb-6 shadow-sm transition-colors duration-300">
        <form wire:submit.prevent="search" class="flex flex-col sm:flex-row gap-3 items-center">
            <div class="flex-grow w-full sm:w-auto">
                <flux:input icon="magnifying-glass" placeholder="Buscar por usuário" wire:model="query"
                    class="w-full dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:placeholder-gray-400" />
            </div>
            <flux:button variant="primary" type="submit"
                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 transition-colors duration-200">
                Buscar
            </flux:button>
        </form>
    </div>

    <div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th wire:click="sortByColumn('id')" scope="col" class="px-6 py-3">ID</th>
                    <th wire:click="sortByColumn('user_id')" scope="col" class="px-6 py-3">Alugado Por</th>
                    <th scope="col" class="px-6 py-3">Entrada</th>
                    <th scope="col" class="px-6 py-3">Saída</th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stays as $stay)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $stay->id }}</td>
                        <td class="px-6 py-4">{{ $stay->user->name }}</td>
                        <td class="px-6 py-4">{{ $stay->check_in }}</td>
                        <td class="px-6 py-4">{{ $stay->check_out }}</td>
                        <td class="px-6 py-4 flex space-x-2">

                            <flux:modal.trigger name="edit-stay">
                                <button wire:click="edit({{ $stay->id }})"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                    Editar
                                </button>
                            </flux:modal.trigger>

                            <button wire:click="destroy({{ $stay->id }})" wire:loading.attr="disabled"
                                wire:target="destroy"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">Nenhuma estádia encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4">
        {{ $stays->links() }}
    </div>


    <flux:modal name="edit-stay" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edite a Estádia</flux:heading>
                <flux:text class="mt-2">Edita as datas de estádia</flux:text>
            </div>

            <flux:input label="Dia de entrada" type="date" value="{{ $this->check_in }}" wire:model="check_in" />
            <flux:input label="Dia de saída" type="date" value="{{ $this->check_out }}" wire:model="check_out" />

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Confirmar</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
