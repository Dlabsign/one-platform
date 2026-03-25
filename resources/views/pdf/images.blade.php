<!DOCTYPE html>
<html>
<head>
    <title>Image to PDF</title>
    @php
        $maxWidth = '100%';
        $maxHeight = '100%';
        $marginAll = '0px';

        if ($margin === 'small') {
            $maxWidth = '90%';
            $maxHeight = '90%';
            $marginAll = '5%'; // Margin sama rata atas, bawah, kiri, kanan
        }
        if ($margin === 'big') {
            $maxWidth = '75%';
            $maxHeight = '75%';
            $marginAll = '12.5%';
        }
    @endphp
    <style>
        @page { margin: 0px; }
        body { margin: 0px; padding: 0px; background-color: #ffffff; }
        
        .page {
            width: 100%;
            /* Ini yang mengatur posisinya (center, left, right) */
            text-align: {{ $alignment }}; 
        }
        
        img {
            max-width: {{ $maxWidth }};
            max-height: {{ $maxHeight }};
            margin: {{ $marginAll }};
            object-fit: contain;
        }
    </style>
</head>
<body>
    @foreach($images as $index => $image)
        <div class="page" style="{{ $index > 0 ? 'page-break-before: always;' : '' }}">
            <img src="{{ $image }}" alt="Converted Image" />
        </div>
    @endforeach
</body>
</html>