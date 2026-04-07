<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-caramel-600 capitalize">{{ str_replace('_',' ', $brew->method) }}</p>
                <h2 class="mt-1 font-serif text-4xl text-espresso-700">{{ $brew->bean?->name ?? 'Brew' }}</h2>
                <p class="mt-1 text-espresso-500">{{ optional($brew->brewed_at)->format('l, F j Y · g:i a') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('brews.edit', $brew) }}" class="px-4 py-2 rounded-2xl bg-cream-100 text-espresso-700 hover:bg-cream-200 transition-all">Edit</a>
                <form method="POST" action="{{ route('brews.destroy', $brew) }}" onsubmit="return confirm('Delete this brew?')">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2 rounded-2xl bg-red-50 text-red-700 hover:bg-red-100 transition-all">Delete</button>
                </form>
            </div>
        </div>
    </x-slot>

    @php $ratio = $brew->dose_grams > 0 ? round($brew->yield_grams / $brew->dose_grams, 2) : 0; @endphp

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="relative p-8 sm:p-10 rounded-3xl bg-gradient-to-br from-espresso-600 to-espresso-800 text-cream-50 overflow-hidden">
                <div class="absolute inset-0 bg-noise opacity-30 mix-blend-overlay pointer-events-none"></div>
                <div class="relative grid sm:grid-cols-3 gap-6 text-center">
                    <div>
                        <div class="text-xs uppercase tracking-widest text-cream-200/70">Dose</div>
                        <div class="mt-1 font-serif text-4xl">{{ $brew->dose_grams }}<span class="text-cream-200/70 text-xl">g</span></div>
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-widest text-cream-200/70">Yield</div>
                        <div class="mt-1 font-serif text-4xl">{{ $brew->yield_grams }}<span class="text-cream-200/70 text-xl">g</span></div>
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-widest text-cream-200/70">Ratio</div>
                        <div class="mt-1 font-serif text-4xl">1 : {{ $ratio }}</div>
                    </div>
                </div>
                <div class="relative mt-8 flex justify-center gap-1 text-caramel-300">
                    @for($i=1;$i<=5;$i++)
                        <svg class="w-7 h-7 {{ $i <= $brew->rating ? 'opacity-100' : 'opacity-20' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.17c.969 0 1.371 1.24.588 1.81l-3.374 2.45a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.374-2.45a1 1 0 00-1.176 0l-3.374 2.45c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.17a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                    @endfor
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-5">
                <div class="p-5 rounded-3xl bg-cream-50 border border-cream-200">
                    <div class="text-xs uppercase tracking-widest text-espresso-400">Brew time</div>
                    <div class="mt-1 font-serif text-2xl text-espresso-700">{{ gmdate('i:s', (int) $brew->brew_time_seconds) }}</div>
                </div>
                <div class="p-5 rounded-3xl bg-cream-50 border border-cream-200">
                    <div class="text-xs uppercase tracking-widest text-espresso-400">Water temp</div>
                    <div class="mt-1 font-serif text-2xl text-espresso-700">{{ $brew->water_temp_c ?? '—' }}<span class="text-espresso-400 text-base">°C</span></div>
                </div>
                <div class="p-5 rounded-3xl bg-cream-50 border border-cream-200">
                    <div class="text-xs uppercase tracking-widest text-espresso-400">Grind</div>
                    <div class="mt-1 font-serif text-2xl text-espresso-700">{{ $brew->grind_setting ?? '—' }}</div>
                </div>
            </div>

            @if($brew->taste_notes)
                <div class="p-8 rounded-3xl bg-cream-50 border border-cream-200">
                    <div class="text-xs uppercase tracking-widest text-espresso-400">Taste notes</div>
                    <p class="mt-3 font-serif text-2xl text-espresso-700 italic leading-snug">&ldquo;{{ $brew->taste_notes }}&rdquo;</p>
                </div>
            @endif

            @if($brew->bean)
                <a href="{{ route('beans.show', $brew->bean) }}" class="group flex items-center gap-4 p-5 rounded-3xl bg-cream-50 border border-cream-200 hover:border-caramel-300 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center font-serif text-lg group-hover:rotate-6 transition-transform">{{ strtoupper(substr($brew->bean->name, 0, 1)) }}</div>
                    <div class="flex-1">
                        <div class="text-xs uppercase tracking-widest text-espresso-400">Brewed with</div>
                        <div class="font-serif text-xl text-espresso-700">{{ $brew->bean->name }}</div>
                    </div>
                    <span class="text-caramel-600 text-sm font-medium">View bean &rarr;</span>
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
