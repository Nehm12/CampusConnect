@props(['id', 'title' => '', 'size' => 'md'])

@php
    $sizeClasses = [
        'sm' => 'max-w-md',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
    ];
@endphp

{{-- Modal Component --}}
<div id="{{ $id }}"
     class="modal fixed inset-0 z-50 hidden overflow-y-auto"
     aria-labelledby="{{ $id }}-title"
     role="dialog"
     aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div class="modal-backdrop fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
             aria-hidden="true"></div>

        {{-- Modal panel --}}
        <div class="modal-panel inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle {{ $sizeClasses[$size] }} sm:w-full sm:p-6">
            {{-- Header --}}
            @if($title)
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="{{ $id }}-title">
                        {{ $title }}
                    </h3>
                    <button type="button"
                            class="modal-close text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md p-1">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>
            @endif

            {{-- Content --}}
            <div class="modal-content">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>