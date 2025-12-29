<x-layout>
    <x-breadcrumbs class="mb-4" :links="[
        'Jobs' => route('job-posts.index'),
        $jobPost->title => route('job-posts.show', $jobPost),
        'Apply' => '#',
    ]" />

    <x-job-card :$jobPost />

    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            Your Job Application
        </h2>

        <form action="{{ route('job-posts.application.store', $jobPost) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="expected_salary" class="mb-2 block text-sm font-medium text-slate-900">Expected Salary</label>
                <x-text-input type="number" name="expected_salary" />
            </div>

            <x-button class="w-full">Apply</x-button>
        </form>
    </x-card>
</x-layout>
