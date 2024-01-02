<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if(Session::has('message'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.success("{{ session('message') }}");
      @endif
      Date.prototype.addHours= function(h){
            this.setHours(this.getHours()+h);
            return this;
        }
</script>
</body>
</html>	