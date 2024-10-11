<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archives') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse ($posts as $key => $post)
                <x-posts.card :post="$post"></x-posts.card>
            @empty
                <div>No Archive Yet.</div>
            @endforelse
            {{ $posts->links() }}

        </div>
    </div>
</x-app-layout>
