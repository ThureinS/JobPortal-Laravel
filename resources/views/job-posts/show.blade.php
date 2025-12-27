<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('job-posts.index'), $jobPost->title => '#']" />
    <x-job-card :$jobPost />
</x-layout>
