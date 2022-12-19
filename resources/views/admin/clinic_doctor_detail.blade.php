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
                <li class="active"> Detalhes Medico</li>
            </ol>
            <h1 class="font-weight-300"> Detalhes do Medico</h1>
        </div>
    </div>
    <!-- // Page Title -->



    <div class="row margin-tb-45px full-width">

            <div class="col-md-8">
                <table class="table table-hover table-bordered table-md">
                    <tbody>
                        <span v-for=" detail in details" v-bind:key="detail.id_usuario">
                            <tr>
                                <td>Codigo</td>
                                <th>@{{dataDoctor.codigo}}</th>
                            </tr>
                            <tr>
                                <td>Nome</td>
                                <th>@{{dataDoctor.nome}}</th>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <th>@{{dataDoctor.email}}</th>
                            </tr>
                            <tr>
                                <td>Celular</td>
                                <th>@{{dataDoctor.celular}}</th>
                            </tr>
                            <tr>
                                <td>Provincia</td>
                                <th>@{{dataDoctor.provincia}}</th>
                            </tr>
                            <tr>
                                <td>Estado</td>
                                <th>@{{dataDoctor.codigo}}</th>
                            </tr>
                        </span>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <img src="{{asset('assets/img/medico.png')}}" class="img-thumbnail" alt="" style="width: 100%; height:75%;">
            </div>

            <div class="col-md-5">
                <a v-on:click="modificar=true; openModal();" class="btn btn-sm border-radius-10 margin-tb-15px text-white background-second-color  box-shadow float-left padding-lr-25px margin-left-5px"><i class="fa fa-fw fa-plus-circle margin-right-7px"></i>Adicionar</a>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Especialidades</th>
                            <th>Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="specialty in specialtys" v-bind:key="specialty.id_especialidade">
                            <td>@{{specialty.nome}}</td>
                            <td>
                                <button  v-on:click="modificar=false; openModal();" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
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
                        <table id='example1' class='table table-bordered table-hover table-sm'>

                            <tr v-for="addSpecialty in addSpecialtys" :key="addSpecialty.id_especialidade">

                                <td>
                                    <input type="checkbox" name="id_especialidade[]"  id="specialty" v-bind:value="addSpecialty.id_especialidade">
                                    <label  for="specialty">@{{addSpecialty.nome}}</label>

                                </td>

                            </tr>
                        </table>
                    </div>
                    <span v-for="user in users">
                        <span id="rm">@{{user.name}}</span>
                        <span id="rm">@{{user.skill}}</span>
                    </span>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"  v-on:click="closeModal();">Cancel</button>
                        <button type="submit" class="btn btn-primary">Associar</button>
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
                modificar:true,
                modal:0,
                titlemodal:'',
                dataDoctor:{
                    codigo:'',
                    nome:'',
                    email:'',
                    celular:'',
                    provincia:'',
                    estado:'',
                },
                specialtys:[],
                addSpecialtys:[],

            }
        },

        methods:{
            openModal() {
                this.modal = 1;
                if (this.modificar) {
                    this.titlemodal = 'Adicionar Especialidade';
                }else{
                    this.titlemodal = 'Pretende excluir a especialidade';
                }


            },

            closeModal() {
                this.modal = 0;
            },

            doctorDetail() {
                var sessionString = sessionStorage.getItem('TheArray');
                var page2Array = JSON.parse(sessionString);
                this.dataDoctor.codigo = page2Array.id_usuario;
                this.dataDoctor.nome = page2Array.nome;
                this.dataDoctor.email = page2Array.email;
                this.dataDoctor.celular = page2Array.celular;
                this.dataDoctor.provincia = page2Array.provincia;
                this.dataDoctor.estado = page2Array.estado;
                console.log(page2Array);

            },

            doctorSpecialty() {
                id = this.dataDoctor.codigo;
                axios.get('/admin/medicos/detalhes/especialidades/'+id).then((res)=>{
                    this.specialtys = res.data.doctorClinicSpec;
                    console.log(this.specialtys);
                })
            },

            addDoctorSpecialty(){
                id = this.dataDoctor.codigo;
                axios.get('/admin/medicos/associar/especialidades/'+id).then((res)=>{
                    this.addSpecialtys = res.data.results;
                    const users = [
                    {name: 'Gareth', skill: "coder"},
                    {name: 'Danny', skill: "DJ"},
                    {name: 'Barry', skill: "dancer"},
                    ];
                    const excludeSkills = ["coder", "dancer"];

                    const dj = users.filter(user => !excludeSkills.includes(user.skill));
                    console.log(dj);




                })
            }
        },

        created() {
            this.doctorDetail();
            this.doctorSpecialty();
            this.addDoctorSpecialty();
        }

    });
</script>

<style scoped>
    .show{
        display: list-item;
        opacity: 1;
        background: rgba(125, 125, 125, 0.250);
    }
</style>
@endsection

