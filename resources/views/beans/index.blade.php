<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-caramel-600">Your library</p>
                <h2 class="mt-1 font-serif text-4xl text-espresso-700">Beans</h2>
            </div>
            <a href="{{ route('beans.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 hover:shadow-lg hover:shadow-espresso-500/20 active:scale-95 transition-all">+ Add bean</a>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 250)">
        <div class="max-w-7xl mx-auto">
            {{-- Skeleton --}}
            <div x-show="!loaded" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @for($i = 0; $i < 6; $i++)
                    <div class="p-6 rounded-3xl bg-cream-50 border border-cream-200">
                        <div class="h-4 w-2/3 rounded-full bg-gradient-to-r from-cream-200 via-cream-100 to-cream-200 bg-[length:400px_100%] animate-shimmer"></div>
                        <div class="mt-3 h-3 w-1/2 rounded-full bg-gradient-to-r from-cream-200 via-cream-100 to-cream-200 bg-[length:400px_100%] animate-shimmer"></div>
                        <div class="mt-6 h-2 w-full rounded-full bg-gradient-to-r from-cream-200 via-cream-100 to-cream-200 bg-[length:400px_100%] animate-shimmer"></div>
                        <div class="mt-2 h-2 w-3/4 rounded-full bg-gradient-to-r from-cream-200 via-cream-100 to-cream-200 bg-[length:400px_100%] animate-shimmer"></div>
                    </div>
                @endfor
            </div>

            <div x-show="loaded" x-transition.opacity.duration.500ms class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($beans as $bean)
                    @php
                        $roast = $bean->roast_level;
                        $roastBadge = ['light' => 'bg-caramel-300/30 text-caramel-600', 'medium' => 'bg-caramel-500/30 text-espresso-600', 'dark' => 'bg-espresso-700 text-cream-100'][$roast] ?? 'bg-cream-200 text-espresso-500';
                    @endphp
                    <a href="{{ route('beans.show', $bean) }}" class="group relative p-6 rounded-3xl bg-cream-50 border border-cream-200 hover:border-caramel-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-espresso-500/10 transition-all duration-500 overflow-hidden">
                        <div class="absolute -top-8 -right-8 w-32 h-32 rounded-full bg-caramel-300/10 group-hover:bg-caramel-300/30 transition-colors duration-500"></div>
                        <div class="relative flex items-start justify-between gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center font-serif text-xl group-hover:rotate-6 group-hover:scale-110 transition-transform duration-500">
                                {{ strtoupper(substr($bean->name ?? 'B', 0, 1)) }}
                            </div>
                            <span class="text-[10px] uppercase tracking-widest px-2.5 py-1 rounded-full {{ $roastBadge }}">{{ $roast }}</span>
                        </div>
                        <h3 class="relative mt-5 font-serif text-2xl text-espresso-700 leading-tight">{{ $bean->name }}</h3>
                        @if($bean->roaster)
                            <p class="relative mt-1 text-sm text-espresso-500">{{ $bean->roaster }}</p>
                        @endif
                        @if($bean->origin)
                            <p class="relative mt-3 text-xs uppercase tracking-widest text-espresso-400">{{ $bean->origin }}</p>
                        @endif
                        @if($bean->notes)
                            <p class="relative mt-3 text-sm text-espresso-500 line-clamp-2">{{ $bean->notes }}</p>
                        @endif
                    </a>
                @empty
                    <div class="sm:col-span-2 lg:col-span-3 py-20 text-center rounded-3xl bg-cream-50 border border-cream-200">
                        <div class="font-serif text-3xl text-espresso-700">Your shelf is empty.</div>
                        <p class="mt-2 text-espresso-400">Add a bean to start logging brews against it.</p>
                        <a href="{{ route('beans.create') }}" class="inline-flex mt-6 px-5 py-3 rounded-2xl bg-espresso-600 text-cream-50 font-medium hover:bg-espresso-700 active:scale-95 transition-all">+ Add your first bean</a>
                    </div>
                @endforelse
            </div>

            @if($beans->hasPages())
                <div class="mt-10">{{ $beans->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
