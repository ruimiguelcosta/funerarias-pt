@props(['faqs' => []])

@if(count($faqs) > 0)
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-gray-900 mb-6">Perguntas Frequentes</h3>
    
    <div class="space-y-4">
        @foreach($faqs as $index => $faq)
        <div class="border border-gray-200 rounded-lg">
            <button class="w-full px-4 py-3 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-200"
                    onclick="toggleFAQ({{ $index }})"
                    aria-expanded="false"
                    aria-controls="faq-{{ $index }}">
                <span class="font-medium text-gray-900">{{ $faq['question'] }}</span>
                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" 
                     id="icon-{{ $index }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="faq-{{ $index }}" 
                 class="hidden px-4 pb-3 text-gray-700 text-sm leading-relaxed">
                {{ $faq['answer'] }}
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
function toggleFAQ(index) {
    const content = document.getElementById(`faq-${index}`);
    const icon = document.getElementById(`icon-${index}`);
    const button = icon.closest('button');
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
        button.setAttribute('aria-expanded', 'true');
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
        button.setAttribute('aria-expanded', 'false');
    }
}
</script>

<!-- JSON-LD FAQ Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach($faqs as $index => $faq)
        {
            "@type": "Question",
            "name": "{{ $faq['question'] }}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{ $faq['answer'] }}"
            }
        }{{ $index < count($faqs) - 1 ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endif
