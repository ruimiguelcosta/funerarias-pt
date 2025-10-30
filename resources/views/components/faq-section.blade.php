@props(['faqs'])

@if($faqs && $faqs->isNotEmpty())
<div class="space-y-4">
    @foreach($faqs as $faq)
    <details class="group bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
        <summary class="flex justify-between items-center cursor-pointer p-6 list-none">
            <h3 class="text-lg font-semibold text-gray-900 pr-8">
                {{ $faq->question ?? $faq['question'] }}
            </h3>
            <svg class="w-5 h-5 text-gray-500 transition-transform group-open:rotate-180 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </summary>
        <div class="px-6 pb-6">
            <p class="text-gray-600 leading-relaxed">
                {{ $faq->answer ?? $faq['answer'] }}
            </p>
        </div>
    </details>
    @endforeach
</div>
@endif






