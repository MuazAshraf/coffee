<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-caramel-600">Your journal</p>
                <h2 class="mt-1 font-serif text-4xl text-espresso-700 leading-tight">Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth()->user()->name)[0] }}.</h2>
            </div>
            <a href="{{ route('brews.create') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 hover:shadow-lg hover:shadow-espresso-500/20 active:scale-95 transition-all">
                + Log a brew
            </a>
        </div>
    </x-slot>

    @php($maxWeek = max($weeklyCounts->max('count'), 1))

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- Stat tiles --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach([
                    ['Total brews', $totalBrews, 'M3 8l4 8 5-12 4 8h5'],
                    ['Beans', $beansCount, 'M12 2C8 6 6 9 6 13a6 6 0 0012 0c0-4-2-7-6-11z'],
                    ['Avg rating', $avgRating . ' /5', 'M11 2l2.5 6 6.5.5-5 4.5 1.5 6.5L11 16l-5.5 3.5L7 13l-5-4.5L8.5 8z'],
                    ['This week', $thisWeek, 'M8 7V3m8 4V3M3 11h18M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z'],
                ] as $i => $tile)
                    <div class="group relative p-6 rounded-3xl bg-cream-50 border border-cream-200 hover:border-caramel-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-espresso-500/5 transition-all duration-500 overflow-hidden">
                        <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-caramel-300/10 group-hover:bg-caramel-300/30 transition-colors duration-500"></div>
                        <div class="relative w-11 h-11 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center group-hover:rotate-6 transition-transform duration-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $tile[2] }}"/></svg>
                        </div>
                        <div class="relative mt-5 text-xs uppercase tracking-widest text-espresso-400">{{ $tile[0] }}</div>
                        <div class="relative mt-1 font-serif text-3xl text-espresso-700">{{ $tile[1] }}</div>
                    </div>
                @endforeach
            </div>

            {{-- This-week chart + recent brews --}}
            <div class="grid lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1 p-6 rounded-3xl bg-cream-50 border border-cream-200">
                    <div class="flex items-center justify-between">
                        <h3 class="font-serif text-xl text-espresso-700">Brews this week</h3>
                        <span class="text-xs uppercase tracking-widest text-espresso-400">{{ $thisWeek }} total</span>
                    </div>
                    <div class="mt-8 flex items-end justify-between gap-2 h-40">
                        @foreach($weeklyCounts as $d)
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full rounded-t-xl bg-gradient-to-t from-espresso-600 to-caramel-500 transition-all duration-500 hover:from-espresso-700 hover:to-caramel-400" style="height: {{ max(4, ($d['count'] / $maxWeek) * 100) }}%"></div>
                                <span class="text-[11px] font-medium text-espresso-400">{{ $d['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-2 p-6 rounded-3xl bg-cream-50 border border-cream-200">
                    <div class="flex items-center justify-between">
                        <h3 class="font-serif text-xl text-espresso-700">Recent brews</h3>
                        <a href="{{ route('brews.index') }}" class="text-sm text-caramel-600 hover:text-caramel-500 font-medium transition-colors">View all &rarr;</a>
                    </div>

                    <div class="mt-5 divide-y divide-cream-200">
                        @forelse($recentBrews as $brew)
                            <a href="{{ route('brews.show', $brew) }}" class="flex items-center gap-4 py-4 group hover:bg-cream-100 -mx-3 px-3 rounded-2xl transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center font-serif text-lg group-hover:rotate-6 transition-transform">
                                    {{ strtoupper(substr($brew->method ?? 'B', 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-espresso-700 truncate">{{ $brew->bean?->name ?? 'Unknown bean' }}</div>
                                    <div class="text-xs text-espresso-400 uppercase tracking-wider">{{ str_replace('_',' ', $brew->method) }} &middot; {{ optional($brew->brewed_at)->diffForHumans() }}</div>
                                </div>
                                <div class="flex gap-0.5 text-caramel-500">
                                    @for($i=1; $i<=5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= ($brew->rating ?? 0) ? 'opacity-100' : 'opacity-20' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.17c.969 0 1.371 1.24.588 1.81l-3.374 2.45a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.374-2.45a1 1 0 00-1.176 0l-3.374 2.45c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.17a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                    @endfor
                                </div>
                            </a>
                        @empty
                            <div class="py-12 text-center">
                                <div class="font-serif text-2xl text-espresso-700">No brews yet.</div>
                                <p class="mt-2 text-espresso-400">Log your first cup to start the journal.</p>
                                <a href="{{ route('brews.create') }}" class="inline-flex mt-5 px-5 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 active:scale-95 transition-all">+ Log a brew</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
