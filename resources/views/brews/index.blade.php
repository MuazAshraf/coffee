<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-caramel-600">Your timeline</p>
                <h2 class="mt-1 font-serif text-4xl text-espresso-700">Brews</h2>
            </div>
            <a href="{{ route('brews.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 hover:shadow-lg hover:shadow-espresso-500/20 active:scale-95 transition-all">+ Log a brew</a>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 250)">
        <div class="max-w-4xl mx-auto">
            <div x-show="!loaded" class="space-y-4">
                @for($i = 0; $i < 4; $i++)
                    <div class="p-6 rounded-3xl bg-cream-50 border border-cream-200 flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-cream-200 via-cream-100 to-cream-200 bg-[length:400px_100%] animate-shimmer"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-3 w-1/3 rounded-full bg-gradient-to-r from-cream-200 via-cream-100 to-cream-200 bg-[length:400px_100%] animate-shimmer"></div>
                            <div class="h-2 w-1/2 rounded-full bg-gradient-to-r from-cream-200 via-cream-100 to-cream-200 bg-[length:400px_100%] animate-shimmer"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <div x-show="loaded" x-transition.opacity.duration.500ms class="space-y-4">
                @php
                    $methodIcon = [
                        'v60' => 'M6 3h12l-2 14a2 2 0 01-2 2h-4a2 2 0 01-2-2L6 3z',
                        'aeropress' => 'M8 3h8v6a4 4 0 11-8 0V3zM8 21h8',
                        'espresso' => 'M5 7h14v6a5 5 0 01-5 5h-4a5 5 0 01-5-5V7zM19 9h2a2 2 0 010 4h-2',
                        'french_press' => 'M7 3h10v18H7zM7 9h10',
                        'chemex' => 'M9 3h6v4l3 6v8H6v-8l3-6V3z',
                    ];
                @endphp
                @forelse($brews as $brew)
                    @php $ratio = $brew->dose_grams > 0 ? round($brew->yield_grams / $brew->dose_grams, 1) : 0; @endphp
                    <a href="{{ route('brews.show', $brew) }}" class="group relative flex items-center gap-5 p-6 rounded-3xl bg-cream-50 border border-cream-200 hover:border-caramel-300 hover:-translate-y-0.5 hover:shadow-2xl hover:shadow-espresso-500/10 transition-all duration-500 overflow-hidden">
                        <div class="absolute inset-y-0 left-0 w-1 bg-gradient-to-b from-caramel-400 to-espresso-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="w-14 h-14 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center group-hover:rotate-6 group-hover:scale-110 transition-transform duration-500 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $methodIcon[$brew->method] ?? 'M12 3v18' }}"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="font-serif text-xl text-espresso-700 truncate">{{ $brew->bean?->name ?? 'Unknown bean' }}</h3>
                                <span class="text-[10px] uppercase tracking-widest px-2 py-0.5 rounded-full bg-cream-200 text-espresso-500">{{ str_replace('_',' ', $brew->method) }}</span>
                            </div>
                            <div class="mt-1 flex items-center gap-3 text-xs text-espresso-400 uppercase tracking-wider">
                                <span>{{ $brew->dose_grams }}g &rarr; {{ $brew->yield_grams }}g</span>
                                <span>1:{{ $ratio }}</span>
                                <span>{{ gmdate('i:s', (int)$brew->brew_time_seconds) }}</span>
                                <span>{{ optional($brew->brewed_at)->diffForHumans() }}</span>
                            </div>
                            @if($brew->taste_notes)
                                <p class="mt-2 text-sm text-espresso-500 italic line-clamp-1">&ldquo;{{ $brew->taste_notes }}&rdquo;</p>
                            @endif
                        </div>
                        <div class="flex flex-col items-end gap-1 shrink-0">
                            <div class="flex gap-0.5 text-caramel-500">
                                @for($i=1;$i<=5;$i++)
                                    <svg class="w-4 h-4 {{ $i <= $brew->rating ? 'opacity-100' : 'opacity-20' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.17c.969 0 1.371 1.24.588 1.81l-3.374 2.45a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.374-2.45a1 1 0 00-1.176 0l-3.374 2.45c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.17a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                @endfor
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="py-20 text-center rounded-3xl bg-cream-50 border border-cream-200">
                        <div class="font-serif text-3xl text-espresso-700">The journal is quiet.</div>
                        <p class="mt-2 text-espresso-400">Log your first brew to start the timeline.</p>
                        <a href="{{ route('brews.create') }}" class="inline-flex mt-6 px-5 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 active:scale-95 transition-all">+ Log a brew</a>
                    </div>
                @endforelse
            </div>

            @if($brews->hasPages())
                <div class="mt-10">{{ $brews->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
