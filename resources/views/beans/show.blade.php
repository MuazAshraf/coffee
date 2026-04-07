<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-caramel-600">Bean</p>
                <h2 class="mt-1 font-serif text-4xl text-espresso-700">{{ $bean->name }}</h2>
                @if($bean->roaster) <p class="mt-1 text-espresso-500">{{ $bean->roaster }}</p> @endif
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('beans.edit', $bean) }}" class="px-4 py-2 rounded-2xl bg-cream-100 text-espresso-700 hover:bg-cream-200 transition-all">Edit</a>
                <form method="POST" action="{{ route('beans.destroy', $bean) }}" onsubmit="return confirm('Delete this bean?')">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2 rounded-2xl bg-red-50 text-red-700 hover:bg-red-100 transition-all">Delete</button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 p-6 rounded-3xl bg-cream-50 border border-cream-200">
                <div class="w-16 h-16 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center font-serif text-3xl">
                    {{ strtoupper(substr($bean->name, 0, 1)) }}
                </div>
                <dl class="mt-6 space-y-4 text-sm">
                    <div>
                        <dt class="text-xs uppercase tracking-widest text-espresso-400">Origin</dt>
                        <dd class="mt-1 text-espresso-700">{{ $bean->origin ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-widest text-espresso-400">Roast level</dt>
                        <dd class="mt-1 text-espresso-700 capitalize">{{ $bean->roast_level }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-widest text-espresso-400">Notes</dt>
                        <dd class="mt-1 text-espresso-600 leading-relaxed">{{ $bean->notes ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="lg:col-span-2 p-6 rounded-3xl bg-cream-50 border border-cream-200">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif text-2xl text-espresso-700">Brew history</h3>
                    <a href="{{ route('brews.create') }}" class="text-sm font-medium text-caramel-600 hover:text-caramel-500 transition-colors">+ Log brew</a>
                </div>

                <div class="mt-5 divide-y divide-cream-200">
                    @forelse($bean->brews()->latest('brewed_at')->get() as $brew)
                        <a href="{{ route('brews.show', $brew) }}" class="flex items-center gap-4 py-4 group hover:bg-cream-100 -mx-3 px-3 rounded-2xl transition-colors">
                            <div class="w-11 h-11 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center font-serif group-hover:rotate-6 transition-transform">
                                {{ strtoupper(substr($brew->method, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-espresso-700 capitalize">{{ str_replace('_',' ', $brew->method) }}</div>
                                <div class="text-xs text-espresso-400">{{ $brew->dose_grams }}g &rarr; {{ $brew->yield_grams }}g &middot; {{ optional($brew->brewed_at)->diffForHumans() }}</div>
                            </div>
                            <div class="flex gap-0.5 text-caramel-500">
                                @for($i=1;$i<=5;$i++)
                                    <svg class="w-4 h-4 {{ $i <= $brew->rating ? 'opacity-100' : 'opacity-20' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.17c.969 0 1.371 1.24.588 1.81l-3.374 2.45a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.374-2.45a1 1 0 00-1.176 0l-3.374 2.45c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.17a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                                @endfor
                            </div>
                        </a>
                    @empty
                        <div class="py-12 text-center text-espresso-400">No brews logged for this bean yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
