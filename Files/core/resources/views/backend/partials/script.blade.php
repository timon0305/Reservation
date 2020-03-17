<script src="{{asset('assets/backend/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/plugin/bootstrap-4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/backend/js/bootadmin.min.js')}}"></script>
<script src="{{asset('assets/plugin/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('assets/plugin/niceditor/nicEdit.js')}}"></script>
<script src="{{asset('assets/plugin/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugin/gijgo-combined-1.9.11/js/gijgo.min.js')}}"></script>
<script src="{{asset('assets/plugin/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugin/date-time/mdtimepicker.min.js')}}"></script>
<script src="{{asset('assets/plugin/print_this.js')}}"></script>
<script src="{{asset('assets/plugin/vue/vue.js')}}"></script>
<script src="{{asset('assets/plugin/axios/axios.js')}}"></script>
<script src="{{asset('assets/backend/js/custom.js')}}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: "bootstrap4"
        });
    });
</script>
<script>
    window.Laravel = @php echo json_encode([
       'csrfToken' => csrf_token(),
   ]) ; @endphp ;

    function printContent(el){
        var restorepage  = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        location.reload();
    }
</script>
@yield('script')
