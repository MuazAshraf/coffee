@php
    $b = $bean ?? null;
    $field = 'block w-full rounded-2xl border-cream-200 bg-cream-50 text-espresso-700 placeholder-espresso-300 focus:border-caramel-400 focus:ring-caramel-400 transition-all';
@endphp
<form method="POST" action="{{ $action }}" x-data="{ name: @js(old('name', $b?->name ?? '')) }" class="space-y-6">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div>
        <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Name</label>
        <input name="name" x-model="name" type="text" required value="{{ old('name', $b?->name) }}" placeholder="e.g. Yirgacheffe Konga" class="{{ $field }}">
        <p class="mt-2 text-xs text-espresso-400" x-show="name.length > 0" x-transition.opacity>Looking good.</p>
        @error('name') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Roaster</label>
            <input name="roaster" type="text" value="{{ old('roaster', $b?->roaster) }}" placeholder="e.g. Onyx" class="{{ $field }}">
            @error('roaster') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Origin</label>
            <input name="origin" type="text" value="{{ old('origin', $b?->origin) }}" placeholder="e.g. Ethiopia" class="{{ $field }}">
            @error('origin') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-3">Roast level</label>
        <div class="grid grid-cols-3 gap-3">
            @foreach(['light' => 'Light', 'medium' => 'Medium', 'dark' => 'Dark'] as $val => $label)
                <label class="cursor-pointer">
                    <input type="radio" name="roast_level" value="{{ $val }}" class="peer sr-only" {{ old('roast_level', $b?->roast_level ?? 'medium') === $val ? 'checked' : '' }}>
                    <div class="px-4 py-3 rounded-2xl text-center text-sm font-medium border border-cream-200 bg-cream-50 text-espresso-500 hover:border-caramel-300 peer-checked:bg-espresso-600 peer-checked:text-cream-50 peer-checked:border-espresso-600 peer-checked:shadow-md peer-checked:shadow-espresso-500/30 transition-all">
                        {{ $label }}
                    </div>
                </label>
            @endforeach
        </div>
        @error('roast_level') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Tasting notes</label>
        <textarea name="notes" rows="4" placeholder="Jasmine, bergamot, honey..." class="{{ $field }}">{{ old('notes', $b?->notes) }}</textarea>
        @error('notes') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center justify-between pt-2">
        <a href="{{ route('beans.index') }}" class="text-sm text-espresso-400 hover:text-espresso-600 transition-colors">Cancel</a>
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 hover:shadow-lg hover:shadow-espresso-500/20 active:scale-95 transition-all">
            {{ $b ? 'Save changes' : 'Add bean' }}
        </button>
    </div>
</form>
