    <input id="is_more_than_limit" class="hidden" value="0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmSubmitText: 'Confirm',
            cancelSubmitText: 'Cancel',
            confirmSubmitClass: 'button is-success has-right-spacing',
            cancelSubmitClass: 'button is-danger',
        }).then((result) => {
            if(result.isConfirmed == true)
            {
                var a = document.getElementById('is_more_than_limit').value = 1;
                ajax();
                window.location.href = "{{route('site.applications.createA')}}"
                {{--return "{{route('site.applications.createA')}}"--}}
            }
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success')
                return "{{route('site.applications.createA')}}"
                console.log(result);
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
                return "{{route('site.applications.createA')}}"
            }
        })

        function ajax()
        {
            $.ajax({
                type: "POST",
                url: '{{route('site.applications.createA')}}',
                data: {
                    is_more_than_limit:document.getElementById('')
                },
                success: success
            });
        }
    </script>
