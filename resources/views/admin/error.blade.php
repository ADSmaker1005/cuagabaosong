@if (session()->has('success'))
    <div id="alert--box">
        <div class="alert alert-success bg-success text-white">
            {{ session('success') }}
        </div>
    </div>
@endif
@if (session()->has('danger'))
    <div id="alert--box">
        <div class="alert alert-danger bg-danger text-white">
            {{ session('danger') }}
        </div>
    </div>
@endif
@if (session()->has('warning'))
    <div id="alert--box">
        <div class="alert alert-warning bg-warning text-white">
            {{ session('warning') }}
        </div>
    </div>
@endif
<style>
    #alert--box{
        position: fixed;
        bottom: 5%;
        right: 5%;
        z-index: 999;
        min-width: 300px;
    }
</style>
@push('scripts')
    <script type="text/javascript">
        $('#alert--box').delay(3000).hide("slow");
    </script>
@endpush

