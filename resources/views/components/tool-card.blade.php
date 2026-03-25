@props([
'title',
'description',
'colorClass',
'link' => '#',
'isForm' => false,
'action' => '',
'inputName' => 'file',
'accept' => '*',
'multiple' => false
])

@if($isForm)
<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="relative block bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100 group overflow-hidden">
    @csrf
    <input type="file"
        name="{{ $inputName }}{{ $multiple ? '[]' : '' }}"
        {{ $multiple ? 'multiple' : '' }}
        accept="{{ $accept }}"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
        onchange="this.form.submit()"
        required>

    <div class="{{ $colorClass }} w-12 h-12 rounded-lg flex items-center justify-center mb-4 transition relative z-0">
        {{ $slot }}
    </div>
    <h3 class="text-lg font-bold mb-2 relative z-0">{{ $title }}</h3>
    <p class="text-gray-500 text-sm relative z-0">{{ $description }} <br> <span class="font-semibold text-blue-500 text-xs mt-2 block">(Klik untuk Upload)</span></p>
</form>
@else
<a href="{{ $link }}" class="block bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100 group">
    <div class="{{ $colorClass }} w-12 h-12 rounded-lg flex items-center justify-center mb-4 transition">
        {{ $slot }}
    </div>
    <h3 class="text-lg font-bold mb-2">{{ $title }}</h3>
    <p class="text-gray-500 text-sm">{{ $description }}</p>
</a>
@endif