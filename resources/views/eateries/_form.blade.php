@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5 text-red-700">
        <p class="mb-2 font-bold">Please correct these errors:</p>
        <ul class="list-inside list-disc space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-6">
    <div>
        <label for="name" class="mb-2 block font-semibold">Eatery Name</label>
        <input type="text" id="name" name="name" maxlength="100" value="{{ old('name', $eatery->name ?? '') }}" class="w-full rounded-lg border border-stone-300 p-3">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="district_id" class="mb-2 block font-semibold">District</label>
        <select id="district_id" name="district_id" class="w-full rounded-lg border border-stone-300 p-3">
            <option value="">Choose district</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id ?? '') == $district->id)>
                    {{ $district->name }}
                </option>
            @endforeach
        </select>
        @error('district_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="address" class="mb-2 block font-semibold">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address', $eatery->address ?? '') }}" class="w-full rounded-lg border border-stone-300 p-3">
        @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price_range" class="mb-2 block font-semibold">Price Range</label>
        <select id="price_range" name="price_range" class="w-full rounded-lg border border-stone-300 p-3">
            <option value="">Choose price range</option>
            <option value="budget" @selected(old('price_range', $eatery->price_range ?? '') == 'budget')>Budget (₱)</option>
            <option value="mid" @selected(old('price_range', $eatery->price_range ?? '') == 'mid')>Mid (₱₱)</option>
            <option value="splurge" @selected(old('price_range', $eatery->price_range ?? '') == 'splurge')>Splurge (₱₱₱)</option>
        </select>
        @error('price_range')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="specialty" class="mb-2 block font-semibold">Specialty</label>
        <input type="text" id="specialty" name="specialty" maxlength="100" value="{{ old('specialty', $eatery->specialty ?? '') }}" class="w-full rounded-lg border border-stone-300 p-3">
        @error('specialty')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <input type="hidden" name="is_open" value="0">
        <label class="flex items-center gap-3 font-semibold">
            <input type="checkbox" name="is_open" value="1" @checked(old('is_open', isset($eatery) ? $eatery->is_open : true)) class="h-5 w-5 rounded border-stone-300 text-orange-700">
            Eatery is open
        </label>
        @error('is_open')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <fieldset>
        <legend class="mb-3 font-semibold">Features</legend>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            @foreach ($features as $feature)
                <label class="flex items-center gap-3 rounded-lg border border-stone-200 p-3">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}" @checked(in_array($feature->id, old('features', isset($eatery) ? $eatery->features->pluck('id')->all() : []))) class="h-5 w-5 rounded border-stone-300 text-orange-700">
                    {{ $feature->name }}
                </label>
            @endforeach
        </div>
        @error('features')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('features.*')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </fieldset>

    <div>
        <label for="permit_no" class="mb-2 block font-semibold">Permit Number</label>
        <input type="text" id="permit_no" name="permit_no" value="{{ old('permit_no', isset($eatery) ? $eatery->permit?->permit_no : '') }}" placeholder="DVO-2026-0415" class="w-full rounded-lg border border-stone-300 p-3">
        @error('permit_no')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="expires_on" class="mb-2 block font-semibold">Permit Expiry Date</label>
        <input type="date" id="expires_on" name="expires_on" value="{{ old('expires_on', isset($eatery) ? $eatery->permit?->expires_on?->format('Y-m-d') : '') }}" class="w-full rounded-lg border border-stone-300 p-3">
        @error('expires_on')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="rounded-xl bg-orange-700 px-6 py-3 font-bold text-white hover:bg-orange-800">
        {{ isset($eatery) ? 'Update Eatery' : 'Add Eatery' }}
    </button>
</div>
