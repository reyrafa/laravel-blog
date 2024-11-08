@props(['post'])
<div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg mb-5">
    <div class="justify-between sm:flex">
        <div>
            <a href="{{ route('posts.show', $post->uuid) }}" class="text-xl font-bold text-slate-900">
                {{ $post->title }}
            </a>
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
    @if ($post->trashed() && $post->user->id == auth()->user()->id)
        <div class="mt-5">
            <form action="{{ route('posts.restore', $post->uuid) }}" method="POST">
                @method('PUT')
                @csrf
                <button type="submit"
                    class="py-2 px-4 rounded shadow bg-blue-500 text-white cursor-pointer">Restore</button>
            </form>

        </div>
    @endif

</div>
