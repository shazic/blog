@if( Session::has('success'))
<!-- Old fashioned alert box through HTML and Bootsrap -->
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>

<!-- Using Toastr to display notifcations 
        toastr.success( "{{ Session::get('success') }}" )
    </script>
-->
@endif
@if( Session::has('failed'))
<!-- Old fashioned alert box through HTML and Bootsrap -->
    <div class="alert alert-danger" role="alert">
        {{ Session::get('failed') }}
    </div>

<!-- Using Toastr to display notifcations 
    <script>
        toastr.error( "{{ Session::get('failure') }}" )
    </script>
-->
@endif
@if( Session::has('info'))
<!-- Old fashioned alert box through HTML and Bootsrap -->
    <div class="alert alert-info" role="alert">
        {{ Session::get('info') }}
    </div>

<!-- Using Toastr to display notifcations 
    <script>
        toastr.info( "{{ Session::get('info') }}" )
    </script>
-->
@endif
@if( Session::has('warning'))
<!-- Old fashioned alert box through HTML and Bootsrap -->
    <div class="alert alert-warning" role="alert">
        {{ Session::get('warning') }}
    </div>

<!-- Using Toastr to display notifcations 
    <script>
        toastr.warning( "{{ Session::get('warning') }}" )
    </script>
-->
@endif