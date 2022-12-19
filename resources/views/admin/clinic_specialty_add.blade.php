@extends('admin.layout_admin')

@section('title', 'Saude ON')

@section('content')
<div class="col-md-12" id="doctor">
    <!-- Page Title -->
    <div id="page-title" class="padding-30px background-white full-width">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Especialidades</li>
            </ol>
            <h1 class="font-weight-300">Associar Especialidades</h1>
        </div>
    </div>
    <!-- // Page Title -->

    <div class="margin-tb-45px full-width">
        <div class="padding-30px background-white border-radius-20 box-shadow">
            <div class="row">
                <div class="form-group has-search col-md-3 margin-bottom-20px ">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Pesquisar especialidade" v-model="search">
                </div>
            </div>
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome</th>


                    <th scope="col" style="width: 200px;">Accoes</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="specialty in specialtys" :key="specialty.id_especialidade">

                    <td>@{{specialty.id_especialidade}}</td>
                    <td>@{{specialty.nome}}</td>
                        <td>
                            <button  v-on:click.prevent="modificar=1; openModal(specialty);"  class="btn btn-outline-primary btn-sm"><i class="fa fa-check-circle"></i></button>
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
                        <input type="hidden" v-model='especialidades.id_especialidade'>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"  v-on:click="closeModal();">Cancel</button>
                        <button v-on:click.prevent=" associationSpec();"  type="submit" class="btn btn-primary">Associar</button>
                    </div>
            </div>
        </div>
    </div>

</div>


<script>

let root = new Vue({
    el: "#doctor",
    data() {
        return {
            modificar:1,
            modal:0,
            titlemodal:'',
            error: false,
            specialtys:[],
            especialidades:{
                id_especialidade:'',
            }

        }

    },

    methods:{

        listSpecialty(){
            axios.get('/admin/especialidades/associar/todas').then((res)=>{
                this.specialtys = res.data.allSpecialty;
            })
        },

        searchSpecialty (val){
            axios.get('/admin/especialidades/associar/pesquisa/'+val).then((res)=>{
                this.specialtys = res.data;
            })
        },

        associationSpec(){
            axios.post('/admin/especialidades/associar', this.especialidades).then(res => {
                if (res.data.error == true) {
                    toastr.error('A especialidade ja existe')
                }else{
                    toastr.success(' Especialidade Associada com sucesso!')
                    window.location = res.data.redirect;
                }

            })
        },


        openModal(data={}) {
            this.modal = 1;
            this.especialidades.id_especialidade = data.id_especialidade;
            if (this.modificar == 1) {
                this.titlemodal = 'Pretende associar a especialidade!!!';
            }
        },

        closeModal() {
            this.modal = 0;
        },

    },

    watch:{
        search (){
            console.log(this.search);
            this.searchSpecialty(this.search);
        }
    },

    created(){
        this.listSpecialty();
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

