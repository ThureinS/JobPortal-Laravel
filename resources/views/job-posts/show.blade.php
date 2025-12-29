<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('job-posts.index'), $jobPost->title => '#']" />
    <x-job-card :$jobPost>
        <p class="mb-4 text-sm text-slate-500">
            {!! nl2br(e($jobPost->description)) !!}
        </p>
        <x-link-button :href="route('job.application.create', $jobPost)">
            Apply
        </x-link-button>
    </x-job-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More {{ $jobPost->employer->company_name }} Jobs
        </h2>

        <div class="text-sm text-slate-500">
            @foreach ($jobPost->employer->jobPosts as $otherJob)
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('job-posts.show', $otherJob) }}">
                                {{ $otherJob->title }}
                            </a>
                        </div>
                        <div class="text-xs">
                            {{ $otherJob->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="text-xs">
                        ${{ number_format($otherJob->salary) }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
