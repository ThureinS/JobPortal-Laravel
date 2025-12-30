<x-layout>
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Edit Job' => '#']" class="mb-4" />

    <x-card class="mb-8">
        <form action="{{ route('my-jobs.update', $jobPost) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">Job Title</x-label>
                    <x-text-input name="title" :value="$jobPost->title" />
                </div>

                <div>
                    <x-label for="location" :required="true">Location</x-label>
                    <x-text-input name="location" :value="$jobPost->location" />
                </div>

                <div class="col-span-2">
                    <x-label for="salary" :required="true">Salary</x-label>
                    <x-text-input name="salary" type="number" :value="$jobPost->salary" />
                </div>

                <div class="col-span-2">
                    <x-label for="description" :required="true">Description</x-label>
                    <x-text-input name="description" type="textarea" :value="$jobPost->description" />
                </div>

                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group name="experience" :value="$jobPost->experience" :all-option="false" :options="array_combine(
                        array_map('ucfirst', \App\Models\JobPost::$experience),
                        \App\Models\JobPost::$experience,
                    )" />
                </div>

                <div>
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group name="category" :all-option="false" :value="$jobPost->category" :options="\App\Models\JobPost::$category" />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full">Edit Job</x-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
