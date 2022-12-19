$(document).on('click', '.paginacao a', function(e){
    e.preventDefault();
    var select = document.getElementById("speciality");
    var speciality = select.options[select.selectedIndex].value;
    var pag = $(this).attr('href').split('page=')[1];
    var doctor = $('#searchDoctor').val();
    getDoctor(doctor,speciality,pag);

 });


  /* pesquicsando  pelo input*/
  $(document).on('keyup submit', '.doctor_form', function(e){

    e.preventDefault();
    var doctor = $('#searchDoctor').val();

    var select = document.getElementById("speciality");
    var speciality = select.options[select.selectedIndex].value;
     pag = 1;
     getDoctor(doctor,speciality, pag);
    });

    /* pesquisando por select*/
    $(document).on('change', '.doctor_form', function(e){
        e.preventDefault();
        var doctor = $('#searchDoctor').val();
        var select = document.getElementById("speciality");
        var speciality = select.options[select.selectedIndex].value;

         pag = 1;
         getDoctor(doctor,speciality,pag);

    });

function getDoctor(doctor,speciality,pag){


    var  searchDoc = doctor;
    var searchspec = speciality;
    var _token = $("input[name=_token]").val();
    var pesquisaAjax = true;
    $.ajax({
        type: "GET",
        url: "/medico?page="+pag,
        // dataType: "html",
        data:{

            searchDoctor: searchDoc,
            speciality:  searchspec,
            pesquisaAjax: pesquisaAjax,
            _token:_token
        },
        success: function (data) {

            if (data) {

                $('#doctor').html(data);
            }else{
                $('#doctor').html('Pesquisa nao encontrada');
            }
        }

    });
}


