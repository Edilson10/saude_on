<footer class="padding-tb-100px background-main-color wow fadeInUp">
    <div class="container">
        <hr class="border-white opacity-4 margin-tb-45px">
        <div class="row">
            <div class="col-lg-6">
                <p class="margin-0px text-white opacity-7 sm-mb-15px">© 2021 SOMAIT | Todos os direitos reservados. </p>
            </div>
            <div class="col-lg-6">
                <ul class="social-icon style-2 float-lg-right">
                    <li class="list-inline-item"><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                    <li class="list-inline-item"><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                    <li class="list-inline-item"><a class="google" href="#"><i class="fab fa-google-plus"></i></a></li>
                    <li class="list-inline-item"><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script  src="{{URL::asset('assets/js/sticky-sidebar.js')}}"></script>
<script  src="{{URL::asset('assets/js/YouTubePopUp.jquery.js')}}"></script>
<script  src="{{URL::asset('assets/js/owl.carousel.min.js')}}"></script>
<script  src="{{URL::asset('assets/js/imagesloaded.min.js')}}"></script>
<script  src="{{URL::asset('assets/js/wow.min.js')}}"></script>
<script  src="{{URL::asset('assets/js/custom.js')}}"></script>
<script  src="{{URL::asset('assets/js/popper.min.js')}}"></script>
<script  src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script  src="{{URL::asset('assets/js/jquery-3.2.1.min.js')}}"></script>
<script  src="{{URL::asset('assets/js/somait.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session::has('message'))
<script>
    toastr.info("{{ Session::get('message') }}");
</script>
@endif
</body>

</html>
