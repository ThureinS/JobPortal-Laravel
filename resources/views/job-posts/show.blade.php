<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('job-posts.index'), $jobPost->title => '#']" />
    <x-job-card :$jobPost>
        <p class="mb-4 text-sm text-slate-500">
            {!! nl2br(e($jobPost->description)) !!}
        </p>
    </x-job-card>
</x-layout>
