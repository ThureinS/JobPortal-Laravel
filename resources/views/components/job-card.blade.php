<x-card class="mb-4">
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">{{ $jobPost->title }}</h2>
        <div class="text-slate-500">
            ${{ number_format($jobPost->salary) }}
        </div>
    </div>

    <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
        <div class="flex space-x-4">
            <div>Company Name</div>
            <div>{{ $jobPost->location }}</div>
        </div>
        <div class="flex space-x-1 text-xs">
            <x-tag>
                <a href="{{ route('job-posts.index', ['experience' => $jobPost->experience]) }}">
                    {{ Str::ucfirst($jobPost->experience) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{ route('job-posts.index', ['category' => $jobPost->category]) }}">
                    {{ $jobPost->category }}
                </a>
            </x-tag>
        </div>
    </div>
    {{ $slot }}
</x-card>
