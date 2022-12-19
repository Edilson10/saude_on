@extends('admin.layout_admin')

@section('title', 'Saude ON')

@section('content')
<div class="col-md-12" id="specialty">
    <!-- Page Title -->
    <div id="page-title" class="padding-30px background-white full-width">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Especialidade</li>
            </ol>
            <h1 class="font-weight-300">Especialidades</h1>
        </div>
    </div>
    <!-- // Page Title -->
    <div class="alert alert-success" id="success-alert" v-show="success">Eliminado com sucesso.</div>

    <div class="margin-tb-45px full-width">
        <div class="padding-30px background-white border-radius-20 box-shadow">
            <div class="row">

                <div class="form-group has-search col-md-3 margin-bottom-20px ">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Pesquisar especialidade" v-model="search">
                </div>

                <div class="col-md-6"></div>

                <div class="col-md-3 margin-bottom-20px">
                    <a href="{{route('add_clinic_specialty')}}" class="btn btn-outline-primary btn-sm pull-left"><i class="fa fa-fw fa-plus-circle"></i>Associar Especialidade</a>
                </div>

            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome</th>
                    <th scope="col" style="width: 200px;">Accoes</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="specialty in specialtys" v-bind:key="specialty.id_clinica_especialidade">
                    <th scope="row">@{{specialty.id_clinica_especialidade}}</th>
                    <td>@{{specialty.nome}}</td>
                    <td>
                        <a v-on:click.prevent="deleteSpecialty(specialty.id_clinica_especialidade);"  href="" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                        <input v-model="deleteSpec">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"  v-on:click="closeModal();">Cancel</button>
                        <button v-on:click="deleteSpecialty();" class="btn btn-primary">Excluir</button>
                    </div>
            </div>
        </div>
    </div>

</div>

<script>
    let root = new Vue({
        el:'#specialty',
        data() {
            return {
                modificar:1,
                modal:0,
                titlemodal:'',
                deleteSpec:'',
                success: false,
                search:'',
                specialtys:[],
            }
        },

        methods:{
            listar() {
                axios.get('/admin/especialidades/list').then((res)=>{
                    this.specialtys=res.data.specialty;
                })
            },
            openModal(id) {
                this.modal = 1;
                this.deleteSpec = id;
                if (this.modificar == 1) {
                    this.titlemodal = 'Deseja excluir a especialidade!!';
                }


            },

            closeModal() {
                this.modal = 0;
            },

            searchSpecialty(val) {
                axios.get('/admin/especialidades/pesquisar/'+val).then((res)=>{
                    this.specialtys = res.data.resultSpecialty;

                })

            },

            deleteSpecialty(id_specialty){


                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Pretende excluir a especialidade!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Excluir!'
                    }).then((result) => {

                        if (result.value) {

                            axios.delete('/admin/especialidades/apagar/'+id_specialty).then(()=>{
                                    Swal.fire(
                                    'Eliminado!',
                                    'Especialidade eliminada com sucesso.',
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
                this.searchSpecialty(this.search);

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

