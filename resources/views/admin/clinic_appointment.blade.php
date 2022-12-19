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
                <li class="active">Consultas</li>
            </ol>
            <h1 class="font-weight-300">Consultas</h1>
        </div>
    </div>
    <!-- // Page Title -->

    <div class="row margin-top-45px">
        <div class="col-lg-12 margin-bottom-45px full-width">
            <div class="row">
                <div class="col-md-6 margin-bottom-20px">
                    <select class="form-control form-control-sm" placeholder="selecione a pesquisa" v-model="value">
                        <option v-bind:value="1">Medico</option>
                        <option v-bind:value="2">Paciente</option>
                        <option v-bind:value="3">Especialidade</option>
                    </select>
                    <div ><small id="erroSelect" style="color: red;"></small></div>
                </div>
                <div class="col-md-6 margin-bottom-20px">

                    <input type="date" name="date" class="form-control form-control-sm" id="date" v-model="date">

                </div>
                <div class="form-group has-search col-md-12 margin-bottom-20px ">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Pesquisar consultas" style="border-radius: 10px; color:rgb(204,204,204);" v-model="search">
                </div>
            </div>

        </div>

        <!-- Booking item -->
        <div class="col-lg-6 margin-bottom-45px full-width" v-for="appoitment in appoitments" v-bind:key="appoitment.id_consulta">
            <div class="background-white thum-hover box-shadow  hvr-float">
                <div class="padding-30px full-width">
                    <img src="http://placehold.it/60x60" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="">
                    <div class="margin-left-85px">
                        <a class="d-block text-dark text-medium margin-bottom-5px" >@{{appoitment.nome_user}}</a>
                        <div class="d-block padding-tb-5px"><strong>Data da consulta</strong>:  <a  class="text-main-color">@{{appoitment.data_consulta}}</a></div>
                        <div class="d-block padding-tb-5px"><strong>Especialidade</strong> :  <a  class="text-main-color">@{{appoitment.nome_espec}}</a></div>
                        <div class="d-block padding-tb-5px"><strong>Email</strong> :  <a  class="text-main-color">@{{appoitment.email}}</a></div>
                        <div class="d-block padding-tb-5px"><strong>Celular</strong>  :  <a  class="text-main-color">@{{appoitment.celular}}</a></div>
                        <div class="d-block padding-tb-5px"><strong>Medico</strong> :  <a  class="text-main-color">@{{appoitment.nome_medico}}</a></div>
                        <p class="margin-top-15px text-grey-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                        <a href="#" class="d-inline-block text-grey-2 text-up-small"><i class="far fa-file-alt"></i> Approve</a>
                        <a href="#" class="d-inline-block margin-lr-20px text-grey-2 text-up-small"><i class="far fa-window-close"></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- // Booking item -->
    </div>

    <!-- pagination -->
    <ul class="pagination pagination-md">
        <li class="page-item disabled"><a class="page-link rounded-0" href="#" tabindex="-1">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link rounded-0" href="#">Next</a></li>
    </ul>
    <!-- //pagination -->
</div>


<script>
    let root = new Vue({
        el:'#doctor',
        data() {
            return {
                search:'',
                value:'',
                appoitments:[],
                date: new Date().toISOString().substr(0, 10) // 05/09/2019

            }
        },

        methods:{
            listAppointment() {
                axios.get('/admin/consultas/listar').then((res)=>{
                    this.appoitments = res.data.clinicAppoitment;
                })
            },

            searchselect(val) {
                axios.get('/admin/consultas/pesquisar/'+val).then((res)=>{
                    if (this.value == 1) {
                        this.appoitments = res.data.resultMedico;
                    }else if (this.value == 2) {
                        this.appoitments = res.data.resultPatient;
                    }else if(this.value == 3) {
                        this.appoitments = res.data.resultEspec;
                    }

                })

            },
        },

        watch:{
            search (){
                if (this.value == 0) {
                    document.getElementById('erroSelect').innerHTML = 'Selecione o que deseja pesquisar';
                }else{
                    console.log(this.search);
                    this.searchselect(this.search);
                }
            }
        },

        created() {
            this.listAppointment();
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

