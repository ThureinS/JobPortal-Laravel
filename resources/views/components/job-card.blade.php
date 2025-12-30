<x-card class="mb-4">
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">{{ $jobPost->title }}</h2>
        <div class="text-slate-500">
            ${{ number_format($jobPost->salary) }}
        </div>
    </div>

    <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
        <div class="flex items-center space-x-4">
            <div>{{ $jobPost->employer->company_name }}</div>
            <div>{{ $jobPost->location }}</div>
            @if ($jobPost->deleted_at)
                <span class="text-xs text-red-500">Deleted</span>
            @endif
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
