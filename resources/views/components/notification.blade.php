@props(['type' => 'success', 'title' => '', 'message' => ''])

@php
    $typeClasses = [
        'success' => 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-800 dark:text-green-200',
        'error' => 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-800 dark:text-red-200',
        'warning' => 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800 text-yellow-800 dark:text-yellow-200',
        'info' => 'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200',
    ];

    $iconClasses = [
        'success' => 'text-green-400',
        'error' => 'text-red-400',
        'warning' => 'text-yellow-400',
        'info' => 'text-blue-400',
    ];

    $icons = [
        'success' => 'check-circle',
        'error' => 'x-circle',
        'warning' => 'alert-triangle',
        'info' => 'info',
    ];
@endphp

{{-- Notification Toast Component --}}
<div class="notification fixed top-4 right-4 z-50 hidden transform transition-all duration-300 ease-in-out">
    <div class="max-w-sm w-full {{ $typeClasses[$type] }} border rounded-lg shadow-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i data-lucide="{{ $icons[$type] }}" class="h-5 w-5 {{ $iconClasses[$type] }}"></i>
            </div>
            <div class="ml-3 flex-1">
                @if($title)
                    <h4 class="text-sm font-medium">{{ $title }}</h4>
                @endif
                @if($message)
                    <p class="text-sm {{ $title ? 'mt-1' : '' }}">{{ $message }}</p>
                @endif
                {{ $slot }}
            </div>
            <div class="ml-4 flex-shrink-0">
                <button type="button"
                        class="notification-close inline-flex text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md">
                    <i data-lucide="x" class="h-4 w-4"></i>
                </button>
            </div>
        </div>
    </div>
</div>