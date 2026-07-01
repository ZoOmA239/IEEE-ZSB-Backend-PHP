<x-layout title="Home">

    <form method="post" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('PATCH')
        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-white">Edit Your Idea</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3" class="textarea w-full">{{ $idea->description }}</textarea>
                <x-forms.error name="description" />
            </div>
        </div>

        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit" class="btn btn-primary">Update</button>
            <button form="delete-idea-form" type="submit" class="btn btn-neutral">Delete</button>

        </div>
    </form>

    <form id="delete-idea-form" method="post" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout>