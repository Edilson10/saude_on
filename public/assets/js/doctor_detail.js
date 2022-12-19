
    $(document).on('click', '.paginate a', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        var pag = $(this).attr('href').split('page=')[1];
        var clinic = $('#searchClinic').val();

        searchClinicDoctor(clinic,espec,pag,data);

    });

    /* pesquicsando  pelo input*/
    $(document).on('keyup submit', '.form_search', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var clinic = $('#searchClinic').val();

        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        pag = 1;
        searchClinicDoctor(clinic,espec,pag,data);
    });

     /* pesquisando por select*/
     $(document).on('change', '.form_search', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        var clinic = $('#searchClinic').val();
        pag = 1;
        searchClinicDoctor(clinic,espec,pag,data);
    });

    $(document).on('change', '.form_search', function(e){
        e.preventDefault();
        var data = $('#date').val();
        var select = document.getElementById("especialidade");
        var espec = select.options[select.selectedIndex].value;
        var clinic = $('#searchClinic').val();
        var select = document.getElementById("especialidade");
        pag = 1;
        searchClinicDoctor(clinic,espec,pag,data);
    });


    function searchClinicDoctor(clinic, espec, pag,data)
    {
        var searchCli = clinic;
        //alert('ola');
        var searchespec = espec;
        var searchData = data;
        var url = window.location.pathname;
        var  id_doctor = url.substring(url.lastIndexOf('/') + 1);
        var pesquisaAjax = true;
        var _token = $("input[name=_token]").val();

        $.ajax({
            type: "GET",
            url: "/medico/detalhes/"+ id_doctor+"?page="+pag,
            data: {
                searchClinic: searchCli,
                searchSpeciality: searchespec,
                id_doctor:id_doctor,
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

//=====================================================================================
    var data = new Date();
    var dia = String(data.getDate()).padStart(2, '0');
    var mes = String(data.getMonth() + 1).padStart(2, '0');
    var ano = data.getFullYear();
    dataAtual = ano + '-' + mes + '-' + dia;
    document.getElementsByName("date")[0].setAttribute('min', dataAtual);

     $(".botao-horario-consulta").click(function (e) {
            e.preventDefault();
            var doctorName = $("#hiddenDoctor").val();
            document.getElementById("medicoaModal").innerHTML = doctorName;
            var valueBotton = $(this).val().split(";");
             var clinicName  = valueBotton[0];
            document.getElementById("clinicaModal").innerHTML = clinicName;
            var select = document.querySelector('select');
            var option = select.children[select.selectedIndex];
            var especText = option.textContent;
            document.getElementById("especModal").innerHTML = especText;
            var dt_consult_Modal = valueBotton[2];
            document.getElementById("dt_consult_Modal").innerHTML = dt_consult_Modal;
            var hora_consulta = valueBotton[1];
            document.getElementById("hora_consult_Modal").innerHTML = hora_consulta;


            //======================input dados===========================================================


            //Nome
            var clinicName  = valueBotton[0];
            document.getElementById("clinicInput").value = clinicName;

            var dt_consult_Modal = valueBotton[2];
            document.getElementById("dt_consult_Input").value = dt_consult_Modal;

            var hora_consulta = valueBotton[1];
            document.getElementById("hora_consult_Input").value = hora_consulta;

            var select = document.querySelector('select');
            var option = select.children[select.selectedIndex];
            var especText = option.textContent;
            document.getElementById("especInput").value = especText;


            //==========================ids===============================================================
            var id_clinica = valueBotton[4];
            document.getElementById("id_clinic_hidden").value = id_clinica;

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


            var select = document.querySelector('select');
            var option = select.children[select.selectedIndex];
            var especText = option.textContent;
            var especId = option.value;


            if (especId == 0) {

                document.getElementById('erroSpecialty').innerHTML = 'Selecione uma especialidade';
                var element = document.getElementById("especialidade");
                element.classList.add("is-invalid");
                scroll(0, 350);
            }

    });


    function Cancel(){
        var element = document.getElementById("especialidade");
        element.classList.remove("is-invalid");
    }




