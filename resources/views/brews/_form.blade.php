@php
    $br = $brew ?? null;
    $field = 'block w-full rounded-2xl border-cream-200 bg-cream-50 text-espresso-700 placeholder-espresso-300 focus:border-caramel-400 focus:ring-caramel-400 transition-all';
    $brewedAt = old('brewed_at', optional($br?->brewed_at)->format('Y-m-d\TH:i') ?? now()->format('Y-m-d\TH:i'));
@endphp
<form method="POST" action="{{ $action }}" class="space-y-6"
      x-data="{
          dose: {{ (float) old('dose_grams', $br?->dose_grams ?? 18) }},
          yieldG: {{ (float) old('yield_grams', $br?->yield_grams ?? 36) }},
          get ratio() { return this.dose > 0 ? (this.yieldG / this.dose).toFixed(2) : '—'; }
      }">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div>
        <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Bean</label>
        <select name="bean_id" required class="{{ $field }}">
            <option value="">Choose a bean…</option>
            @foreach($beans as $b)
                <option value="{{ $b->id }}" {{ (int) old('bean_id', $br?->bean_id) === $b->id ? 'selected' : '' }}>{{ $b->name }} @if($b->roaster) — {{ $b->roaster }} @endif</option>
            @endforeach
        </select>
        @if($beans->isEmpty())
            <p class="mt-2 text-xs text-caramel-600">No beans yet. <a href="{{ route('beans.create') }}" class="underline hover:text-caramel-500">Add one first.</a></p>
        @endif
        @error('bean_id') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-3">Method</label>
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2">
            @foreach(['v60' => 'V60', 'aeropress' => 'Aeropress', 'espresso' => 'Espresso', 'french_press' => 'French Press', 'chemex' => 'Chemex'] as $val => $label)
                <label class="cursor-pointer">
                    <input type="radio" name="method" value="{{ $val }}" class="peer sr-only" {{ old('method', $br?->method ?? 'v60') === $val ? 'checked' : '' }}>
                    <div class="px-3 py-3 rounded-2xl text-center text-xs font-medium border border-cream-200 bg-cream-50 text-espresso-500 hover:border-caramel-300 peer-checked:bg-espresso-600 peer-checked:text-cream-50 peer-checked:border-espresso-600 peer-checked:shadow-md peer-checked:shadow-espresso-500/30 transition-all">
                        {{ $label }}
                    </div>
                </label>
            @endforeach
        </div>
        @error('method') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Live ratio calculator --}}
    <div class="grid sm:grid-cols-3 gap-5 items-end">
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Dose (g)</label>
            <input name="dose_grams" type="number" step="0.1" min="0.1" required x-model.number="dose" class="{{ $field }}">
            @error('dose_grams') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Yield (g)</label>
            <input name="yield_grams" type="number" step="0.1" min="0.1" required x-model.number="yieldG" class="{{ $field }}">
            @error('yield_grams') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="px-5 py-4 rounded-2xl bg-espresso-600 text-cream-50 text-center shadow-lg shadow-espresso-500/20">
            <div class="text-[10px] uppercase tracking-widest text-cream-200/70">Ratio</div>
            <div class="font-serif text-2xl">
                <span x-text="dose"></span>g <span class="text-caramel-300">&rarr;</span> <span x-text="yieldG"></span>g
            </div>
            <div class="text-xs text-cream-200/70">1 : <span x-text="ratio"></span></div>
        </div>
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Brew time (seconds)</label>
            <input name="brew_time_seconds" type="number" min="1" required value="{{ old('brew_time_seconds', $br?->brew_time_seconds ?? 165) }}" class="{{ $field }}">
            @error('brew_time_seconds') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Water temp (°C)</label>
            <input name="water_temp_c" type="number" step="0.5" min="0" max="100" value="{{ old('water_temp_c', $br?->water_temp_c) }}" placeholder="93" class="{{ $field }}">
            @error('water_temp_c') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Grind setting</label>
            <input name="grind_setting" type="text" value="{{ old('grind_setting', $br?->grind_setting) }}" placeholder="e.g. 18 clicks" class="{{ $field }}">
            @error('grind_setting') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Brewed at</label>
            <input name="brewed_at" type="datetime-local" required value="{{ $brewedAt }}" class="{{ $field }}">
            @error('brewed_at') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div x-data="{ rating: {{ (int) old('rating', $br?->rating ?? 4) }}, hover: 0 }">
        <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-3">Rating</label>
        <input type="hidden" name="rating" :value="rating">
        <div class="flex gap-2">
            @for($i = 1; $i <= 5; $i++)
                <button type="button" @click="rating = {{ $i }}" @mouseenter="hover = {{ $i }}" @mouseleave="hover = 0" class="transition-transform hover:scale-125 active:scale-95">
                    <svg class="w-9 h-9 transition-colors" :class="(hover ? hover >= {{ $i }} : rating >= {{ $i }}) ? 'text-caramel-500' : 'text-cream-200'" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.17c.969 0 1.371 1.24.588 1.81l-3.374 2.45a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.374-2.45a1 1 0 00-1.176 0l-3.374 2.45c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.17a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                </button>
            @endfor
        </div>
        @error('rating') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold uppercase tracking-widest text-espresso-500 mb-2">Taste notes</label>
        <textarea name="taste_notes" rows="3" placeholder="Bright, juicy acidity. Lingering chocolate finish." class="{{ $field }}">{{ old('taste_notes', $br?->taste_notes) }}</textarea>
        @error('taste_notes') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center justify-between pt-2">
        <a href="{{ route('brews.index') }}" class="text-sm text-espresso-400 hover:text-espresso-600 transition-colors">Cancel</a>
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 hover:shadow-lg hover:shadow-espresso-500/20 active:scale-95 transition-all">
            {{ $br ? 'Save changes' : 'Log brew' }}
        </button>
    </div>
</form>
