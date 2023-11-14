<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                <form method="POST" wire:submit="save">
                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700">nom</label>
                        <input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" wire:model="form.nom" />
                        @error('form.nom')
                            <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="category">Category</label>
{{--                        <select wire:model="form.category_id" name="category" id="category" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">--}}
                        <select wire:model="form.id_district" name="category" id="category" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- CHOOSE CATEGORY --</option>
                            @foreach($districts as $id => $district)
                                <option value="{{ $id }}">{{ $district }}</option>
                            @endforeach
                        </select>
{{--                        @error('form.id_district')--}}
                        @error('form.id_district')
                            <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="mt-4 px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Save Product
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>