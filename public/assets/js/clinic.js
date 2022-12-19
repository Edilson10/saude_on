//paginacao
  $(document).on('click', '.paginacao a', function(e){
    e.preventDefault();
    var select = document.getElementById("sel_espec");
     var espec = select.options[select.selectedIndex].value;
    var pag = $(this).attr('href').split('page=')[1];
    var clinic = $('#clinicSearch').val();
    getDados(clinic,espec,pag);

    });

    /* pesquicsando  pelo input*/
    $(document).on('keyup submit', '.clinic_form', function(e){
    e.preventDefault();
    var clinic = $('#clinicSearch').val();
    var select = document.getElementById("sel_espec");
     var espec = select.options[select.selectedIndex].value;
     pag = 1;
    getDados(clinic,espec,pag);
    });

    /* pesquisando por select*/
    $(document).on('change', '.clinic_form', function(e){
    e.preventDefault();

    var clinic = $('#clinicSearch').val();
    var select = document.getElementById("sel_espec");
     var espec = select.options[select.selectedIndex].value;
     pag = 1;
     getDados(clinic,espec,pag);

    });

    /* Ajax enviando dados ao controlador*/
    function getDados(clinic,espec,pag){

        var clinica = clinic;
        var especialidade = espec;
       var pesquisaAjax = true;
     $.ajax({
         type: "GET",
         url: "/clinica?page="+pag,
         data:{
            clinicSearch: clinica,
            especialidade: especialidade,
            pesquisaAjax: pesquisaAjax
        },
        /*dataType: "JSON",*/
         success: function (data) {

            //alert(clinica);
            if (data) {
                $('#clinic_search_ajax').html(data);
            }else{
                $('#clinic_search_ajax').html("<p style='color:red;'>Clinica inexistente</p>");
            }
         }
     });

    }
