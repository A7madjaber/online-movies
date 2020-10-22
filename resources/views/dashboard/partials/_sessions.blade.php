@if(session('success'))

    <script>
        Noty.overrideDefaults({
            theme    : 'sunset',
        });
        new Noty({
            type: 'alert',
            layout: 'topRight',
            timeout:'1750',
            text: "{{session('success')}}",
            killer: true,
        }).show();

    </script>


@endif
