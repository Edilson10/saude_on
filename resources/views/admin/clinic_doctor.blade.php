@extends('admin.layout_admin')

@section('title', 'Saude ON')

@section('content')
<div class="col-md-12"  id="doctor">
    <!-- Page Title -->
    <div id="page-title" class="padding-30px background-white full-width">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Medicos</li>
            </ol>
            <h1 class="font-weight-300">Medicos</h1>
        </div>
    </div>
    <!-- // Page Title -->
    <div class="alert alert-success" id="success-alert" v-show="success">Medico eliminado com sucesso.</div>

    <div class="margin-tb-45px full-width">
        <div class="padding-30px background-white border-radius-20 box-shadow">
            <div class="row">

                <div class="form-group has-search col-md-3 margin-bottom-20px ">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Pesquisar medico" v-model="search">
                </div>

                <div class="col-md-6"></div>

                <div class="col-md-3 margin-bottom-20px">
                    <a href="{{route('add_clinic_doctor')}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-fw fa-plus-circle"></i>Associar Medico</a>
                </div>

            </div>
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Provincia</th>
                    <th scope="col">Estado</th>
                    <th scope="col" style="width: 200px;">Accoes</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="doctor in doctors" v-bind:key="doctor.id_medico_clinica">
                    <th scope="row">@{{doctor.id_medico_clinica}}</th>
                    <td>@{{doctor.nome}}</td>
                    <td>@{{doctor.email}}</td>
                    <td>@{{doctor.celular}}</td>
                    <td>@{{doctor.provincia}}</td>
                    <td>@{{doctor.estado}}</td>
                    <td>

                        <button v-on:click="clinicDoctorDetail(doctor);"  class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i></button>
                        <button  v-on:click.prevent="destroyDoctor(doctor.id_medico_clinica);"  class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
     <!--   Modal-->
    <div class="modal fade" v-bind:class="{show:modal}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@{{titlemodal}}</h5>
                    <button class="close" type="button">
                        <span aria-hidden="true" v-on:click="closeModal();">×</span>
                    </button>
                </div>

                    <div class="modal-body">
                        <input v-model="deleteDoctor">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"  v-on:click="closeModal();">Cancel</button>
                        <button v-on:click="destroyDoctor();" class="btn btn-primary">Associar</button>
                    </div>
            </div>
        </div>
    </div>
</div>


<script>
    let root = new Vue({
        el:'#doctor',
        data() {
            return {
                modificar:1,
                modal:0,
                success: false,
                titlemodal:'',
                deleteDoctor:0,
                search:'',
                doctors:[],
            }
        },

        methods:{
            listar() {
                axios.get('/admin/medicos/list').then((res)=>{
                    this.doctors=res.data.doctor;
                })
            },

            openModal(id) {
                this.modal = 1;
                this.deleteDoctor = id;
                if (this.modificar == 1) {
                    this.titlemodal = 'Pretende excluir o medico';
                }
            },

            closeModal() {
                this.modal = 0;
            },

            clinicDoctorDetail(data={}) {
                sessionStorage.setItem('TheArray', JSON.stringify(data));
                window.location = '/admin/medicos/detalhes';
            },

            searchDoctor(val) {
                axios.get('/admin/medicos/pesquisar/'+val).then((res)=>{
                    this.doctors = res.data.searchDoctor;
                })

            },

            destroyDoctor(id){
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Pretende excluir o medico!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Excluir!'
                    }).then((result) => {

                        if (result.value) {

                            axios.delete('/admin/medicos/apagar/'+id).then(()=>{
                                    Swal.fire(
                                    'Eliminado!',
                                    'Medico eliminado com sucesso.',
                                    'success'
                                    )
                                this.listar();
                            }).catch(()=>{
                                Swal.fire('Falha!','A algo estranho.','warning');
                            });

                        }
                    })
            }
        },

        watch:{
            search (){
                console.log(this.search);
                this.searchDoctor(this.search);

            }
        },

        created() {
            this.listar();
        }


    });
</script>

<style scoped>
    .show{
        display: list-item;
        opacity: 1;
        background: rgba(125, 125, 125, 0.250);
    }

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 1rem;
        height: 2.375rem;
        margin-left: 1rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }

</style>
@endsection

