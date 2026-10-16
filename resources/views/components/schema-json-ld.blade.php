@props(['schema' => null, 'data' => null])

@php
    $payload = $data ?? $schema;
@endphp

@if(!empty($payload))
    @if(is_array($payload))
        <script type="application/ld+json">
        {!! json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @else
        @php
            $trimmed = trim((string) $payload);
        @endphp
        @if(str_starts_with($trimmed, '<script'))
            {!! $trimmed !!}
        @else
            <script type="application/ld+json">
            {!! $trimmed !!}
            </script>
        @endif
    @endif
@endif
