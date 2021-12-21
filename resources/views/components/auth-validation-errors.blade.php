@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-danger">
            <strong>{{ __('Whoops! Something went wrong.') }} </strong>
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
