<div class="mb-3">
    <label for="">Categoría del producto</label>
    <select name="category_id" wire:model="category_id" class="select-formularios form-select"
        aria-label="Default select example">
        <option selected>Selecciona una opción</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
@error('category_id')
    <p class=" text-red-600 p-2 rounded">{{ $message }}</p>
@enderror
