<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('job-posts.index')]" />
    @foreach ($jobPosts as $jobPost)
        <x-job-card class="mb-4" :$jobPost>
            <div>
                <x-link-button :href="route('job-posts.show', $jobPost)">
                    Show
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach
</x-layout>
