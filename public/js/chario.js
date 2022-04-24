 function get_receptions() {
 	 var client = $('#client').val();
 	 if(client == 'tous'){
 	 	$('#rcp_client').html('')
 	 }else{
 	 	getTheContent('charios/get_receptions/'+client,'#rec');
 	 	// $.ajax({
    //         type: 'get',
    //         url: racine+'charios/get_receptions/'+client,
    //         success: function (data) {
    //        		$('#rcp_client').html(data);
    //        		resetInit();
    //        		$('#rcp_client').selectpicker('refresh');         
    //         },
    //         error: function () {
    //             alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
    //         }
    //     });
 	 }
}

function get_form_cp(){
	var reception = $('#reception_ids').val();
 	getTheContent('charios/get_form_affecte_poisson/'+reception,'#charios_poissons');
} 

function printOne(id) {
    $('.ch-valeur').hide();
    $('.ch' + id).show();
    $('.ch' + id +' .select2-selection__rendered').trigger('click');
    get_form_chario_diponible(id);
}

function cacherAll() {
    $('.ch-valeur').hide();
}

function get_form_chario_diponible(id_poisson){
    getTheContent('charios/get_chario_disponible/'+id_poisson,'#select_chario'+id_poisson);
}

function get_nb_plat(valeur){
    var options = [];
        $.each($("#add_poison_in_chario option:selected"), function () {
            options.push($(this).val());
        });
        if(options.length)
            $.ajax({
                type: 'get',
                url: racine+'charios/get_nb_plat_disponible/'+options,
                success: function (data) {
                    $("#nb_plat_").html(data[0]);
                    $("#inp_chario" +valeur).val(data[1]);
                },
                error: function () {
                    alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
                }
            });        
}
function printInputNbChario(valeur){
    var nb_table = $('#take_table'+valeur).val();
    $("#inp_plat"+valeur).val(nb_table);
}

function add_poisson_to_chario(rp){
    var  nb_palt = $('#take_table'+rp).val(); 
    var  options = [];
    $.each($("#select_chario" +rp+ " option:selected"), function () {
            options.push($(this).val());
        }); 
    if(options.length && nb_palt!= ''){
        $.ajax({
                type: 'get',
                url: racine+'charios/add_poisson_to_chario/'+nb_palt+'/'+rp+'/'+options,
                success: function (data) {
                    if(data){
                        $('#take_table' + rp + ' .spinner-border').hide();
                        $('#take_table' + rp + ' .answers-well-saved').show();
                        setTimeout(function () {
                            $('#take_table' + rp + ' .answers-well-saved').hide();
                            $('#take_table' + rp + ' .main-icon').show();
                        }, 3500);
                    }
                    else{
                        var danger = '<span class="alert alert-danger">les charios selectionner insufusant </sapan>';
                         $(".ch" +rp+ " #nb_plat_").html(danger);
                    }
                },
                error: function () {
                    alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
                }
            });
    }
}
function valider_reeption_chario(){
    var reception = $('#reception_ids').val();
    if(reception == '' || reception == null )
        alert("selectionner une reception");
    else{
       confirmAction(racine+'charios/valider_reception_charios/'+reception, 'Etes vous sur de valider');   
    }
}

function imprimer_info_charios(){
    window.open(racine+"charios/get_fichier_info_charios/", '_blank');
}