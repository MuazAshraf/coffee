<x-app-layout>
    <x-slot name="header">
        <p class="text-xs uppercase tracking-[0.2em] text-caramel-600">Editing</p>
        <h2 class="mt-1 font-serif text-4xl text-espresso-700">{{ $bean->name }}</h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto p-8 sm:p-10 rounded-3xl bg-cream-50 border border-cream-200 shadow-xl shadow-espresso-500/5">
            @include('beans._form', ['action' => route('beans.update', $bean), 'method' => 'PUT', 'bean' => $bean])
        </div>
    </div>
</x-app-layout>
