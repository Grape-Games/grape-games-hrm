@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 text-success']) }}>
        <li>{{ $status }}</li>
        <script>
            makeToastr(
                "success",
                "{{ $status }}",
                "Password Reset Link Sent 🔏"
            );
        </script>
    </div>
@endif
