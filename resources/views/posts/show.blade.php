<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg mb-5">


                <div class="justify-between sm:flex">
                    <div>
                        <p class="text-xl font-bold text-slate-900">
                            {{ $post->title }}
                        </p>
                        <p class="mt-1 text-xs text-slate-600 font-bold">By {{ $post->user->name }}</p>
                        <p class="mt-1 text-xs font-medium text-slate-600">{{ $post->user->email }}</p>
                    </div>

                    <div class="flex-shrink-0 hidden ml-3 sm:block">

                        <img class="object-cover w-16 h-16 rounded-full shadow-sm"
                            src="{{ $post->user->avatar
                                ? asset('storage/' . $post->user->avatar)
                                : 'https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg' }}"
                            alt="profile" />


                    </div>
                </div>

                <div class="mt-4 sm:pr-8">
                    <p class="text-sm text-slate-500">
                        {{ $post->content }}
                    </p>
                </div>

                <dl class="flex mt-6">
                    <div class="flex flex-col-reverse">
                        <dt class="text-sm font-medium text-slate-600">Created</dt>
                        <dd class="text-xs text-slate-500">{{ $post->created_at->diffForHumans() }}</dd>
                    </div>


                </dl>
                @if ($post->user->id == auth()->user()->id && !$post->trashed())
                    <div class="mt-4 flex">
                        <a class="bg-blue-500 text-white py-1 px-3 rounded me-4"
                            href="{{ route('posts.edit', $post->uuid) }}">Edit</a>
                        <form action="{{ route('posts.destroy', $post->uuid) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded">Delete</button>
                        </form>


                    </div>
                @endif

                <div class="mt-5">
                    <div class="font-bold">Comments</div>
                    <div class="mt-3">
                        @foreach ($post->comments as $comment)
                            <div class="flex items-center justify-between">
                                <div class="mb-3">
                                    <div>{{ $comment->user->name }}</div>
                                    <div>{{ $comment->content }}</div>
                                </div>
                                @if ($comment->user_id === auth()->user()->id || $comment->post->user->id === auth()->user()->id)
                                    <div>

                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-600 rounded py-2 px-3 text-white">Delete</button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        @endforeach

                    </div>
                    @if ($post->user->id !== auth()->user()->id)
                        <div class="mt-3">
                            <form action="{{ route('comments.store', $post->uuid) }}" method="post">
                                @csrf
                                <div>
                                    <input type="text" name="content" id="" class="rounded mb-3"
                                        placeholder="Send Comment..">

                                    <button type="submit"
                                        class="bg-green-400 p-2 rounded shadow text-white mt-3">Comment</button>
                                    @if ($errors->any())
                                        <x-input-error :messages="$errors->all()" />
                                    @endif
                                </div>

                            </form>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
