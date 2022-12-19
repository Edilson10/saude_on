
 @if (isset($doctors) && count($doctors) > 0)
 <div class="row">
     <!-- Doctor -->
     @foreach ($doctors as $doctor)
         <div class="col-lg-4 col-md-6 hvr-bob margin-bottom-45px">
             <div class="background-white box-shadow">
                 <div class="thum">
                     <a href="{{route('doctor_detail', ['id_doctor' => $doctor->id_usuario])}}"><img src="assets/img/Medico/{{$doctor->id_usuario}}/{{$doctor->imagem}}" alt=""></a>
                 </div>
                 <div class="padding-30px">

                     <h5 class="margin-tb-15px"><a class="text-dark" href="#">Dr.{{$doctor->nome}}</a></h5>

                 </div>
             </div>
         </div>
     @endforeach
     <!-- // Doctor -->
 </div>
 @else
 <p style="color:red;">Médico inexistente</p>
 @endif

 <div class="paginacao">
     {{$doctors->links()}}
 </div>
