    $(document).on('click', '.paginate a', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        var pag = $(this).attr('href').split('page=')[1];
        var doctor = $('#searchDoctor').val();

        searchDoctorClinic(doctor,espec,pag,data);

    });

    /* pesquicsando  pelo input*/
    $(document).on('keyup submit', '.form_search', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var doctor = $('#searchDoctor').val();
        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        pag = 1;
        searchDoctorClinic(doctor,espec,pag,data);
    });

     /* pesquisando por select*/
     $(document).on('change', '.form_search', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        var doctor = $('#searchDoctor').val();
        pag = 1;
        searchDoctorClinic(doctor,espec,pag,data);
    });

    $(document).on('change', '.form_search', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        var doctor = $('#searchDoctor').val();
        var select = document.getElementById("especialidade");
        pag = 1;
        searchDoctorClinic(doctor,espec,pag,data);
    });


    function searchDoctorClinic(doctor, espec, pag,data)
    {
        var searchDoc = doctor;
        var searchespec = espec;
        var searchData = data;
        var id_clinic = $('#id_clinica').val();
        var pesquisaAjax = true;
        var _token = $("input[name=_token]").val();

        $.ajax({
            type: "GET",
            url: "/clinica/detalhes/"+id_clinic+"?page="+pag,
            data: {
                searchDoctor: searchDoc,
                searchSpeciality: searchespec,
                id_clinic:id_clinic,
                searchData: searchData,
                pesquisaAjax: pesquisaAjax,
                _token:_token
            },

            success: function (response) {

                if (response) {
                    $('#result_search').html(response);
                }else{
                    $('#result_search').html('pesquisa nao encontrada');
                }
            }
        });
    }






    var data = new Date();
        var dia = String(data.getDate()).padStart(2, '0');
        var mes = String(data.getMonth() + 1).padStart(2, '0');
        var ano = data.getFullYear();
        dataAtual = ano + '-' + mes + '-' + dia;
       document.getElementsByName("data")[0].setAttribute('min', dataAtual);



        $(".botao-horario-consulta").click(function (e) {
            e.preventDefault();

            var clinicName = $("#hiddenClinic").val();
            document.getElementById("clinicaModal").innerHTML = clinicName;
            var valueBotton = $(this).val().split(";");
            var doctorName = valueBotton[0];
            document.getElementById("medicoaModal").innerHTML = doctorName;
            var select = document.querySelector('select');
            var option = select.children[select.selectedIndex];
            var especText = option.textContent;
            document.getElementById("especModal").innerHTML = especText;
            var dt_consult_Modal = valueBotton[2];
            document.getElementById("dt_consult_Modal").innerHTML = dt_consult_Modal;
            var hora_consulta = valueBotton[1];
            document.getElementById("hora_consult_Modal").innerHTML = hora_consulta;


            /* input dados*/

            var doctorNameInput = valueBotton[0];
            document.getElementById("medicoaModalInput").value = doctorNameInput;
            var dt_consult_ModalInput = valueBotton[2];
            document.getElementById("dt_consult_ModalInput").value = dt_consult_ModalInput;
            var hora_consult_ModalInput = valueBotton[1];
            document.getElementById("hora_consult_ModalInput").value = hora_consult_ModalInput;

            var select = document.querySelector('select');
            var option = select.children[select.selectedIndex];
            var especTextInput = option.textContent;
            document.getElementById("especModalInput").value = especTextInput;




            var id_medico = valueBotton[4];
            document.getElementById("id_medico_hidden").value = id_medico;
            var id_espc = $("#especialidade").val();
            document.getElementById("id_esp_hidden").value = id_espc;
            var id_disponibilidade = valueBotton[5];
            document.getElementById("id_disponibilidade").value = id_disponibilidade;
            var hora_inicio = valueBotton[6];
            document.getElementById("hora_inicio").value = hora_inicio;
            var hora_fim = valueBotton[7];
            document.getElementById("hora_fim").value = hora_fim;
            var dt_consulta = valueBotton[2];
            document.getElementById("dt_consulta").value = dt_consulta;




            /* verificando se a especialidade foi selecionada*/
            var select = document.querySelector('select');
            var option = select.children[select.selectedIndex];
            var especText = option.textContent;
            var especId = option.value;

            if (especId == 0) {
                //document.getElementById('ModalDadosConsulta').innerHTML = '';
                //$('#ModalDadosConsulta').remove();
                document.getElementById('erroSpecialty').innerHTML = 'Selecione uma especialidade';
                var element = document.getElementById("especialidade");
                element.classList.add("is-invalid");
                scroll(0, 350);
            }else{
                document.getElementById('erroSpecialty').innerHTML = '';
            }

        });


        function Cancel(){
            var element = document.getElementById("especialidade");
            element.classList.remove("is-invalid");
        }







