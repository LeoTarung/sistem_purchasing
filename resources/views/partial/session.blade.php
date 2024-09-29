@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        })

        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}",
        })
    </script>
@elseif (session()->has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            // timer: 1500,
            timerProgressBar: true,
        })

        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}",
        })
    </script>
@endif
