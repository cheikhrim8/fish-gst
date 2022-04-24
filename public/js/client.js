function new_reception(id_client){
    getTheContent("clients/get_form_add_detaill/"+id_client, "#detaille_reception");
}
function ajouter_quantite(element, table_article){
    var options = ''
    $.each( table_article, function( i, l ){
        options +='<option value="'+l['id']+'">'+l['libelle']+'</option>'; 
    });
    var html = '<tr>';
        html +='<td width="25%"><select  title="Selectionner..." data-live-search="true" name="poisson[]" id="article" class="form-control ">'+options+'</select></td>';
        html +='<td width="30%"><input type="number" min="1" name="quatite[]" class="form-control"/></td>';
        html +='<td width="10%"><button type="button" class="btn btn-danger" onclick="remove_tr(this)" id="remove"><i class="fas fa-trash"></i></button></td></tr>';
            $('#th_body').append(html);
            //resetInit();
}
function add_reception(element){
    saveform(element, function(data){
        afficher_detaille(element,data.reception);
        $('#detaille_reception').html('');
        window.open(racine+"clients/exporter_reception/"+data.reception, '_blank');        
    });
}

function remove_tr(element, poisson_id = 0,reception_id = 0){
    if(poisson_id != 0){
        if(confirm("confirmez la supression")){
            remove_detaile(poisson_id,reception_id);
            $('#tr'+poisson_id).remove();
        }
    }
    else
        $('#remove').closest('tr').remove();
}

function remove_detaile(poisson_id,reception_id){
    $.ajax({
            type: 'get',
            url: racine+'clients/delete_detaille/' + poisson_id+'/'+reception_id,
            success: function (data) {
            },
            error: function () {
                alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
            }
    });
}
function afficher_detaille(element,reception_id = 0){
   var reception = $('#reception').val();
   if(reception_id == 0){
        if(reception != 'tous'){
        getTheContent("clients/get_detaille_reception/"+reception, "#detaille_reception");    
       } 
   }else
        getTheContent("clients/get_detaille_reception/"+reception_id, "#detaille_reception");
   
}


function ajouter_traitement(rece_id = 0){
    var reception = $('#recept_traite').val();
    //var client = $('#id_cli').val(); remove_tr
    //alert(client);
    if(reception == 'tous' && rece_id == 0)
        alert('veiller saisir le code du reception');
    else{
        $.ajax({
            type: 'get',
            url: (rece_id)? racine+'clients/ajouter_traitement/'+rece_id :racine+'clients/ajouter_traitement/'+reception,
            success: function (data) {
                    if(data == -2)
                        alert("la reception ne contient pas de poisson pour le moment");
                    else
                        $('#detaille_reception_traitement').html(data);
            },
            error: function () {
                alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
            }
        });    
    }
}

function add_traitement_poisson(element){
    saveform(element,function(data){
        ajouter_traitement(data);
    });
}

function imprimer_traitement(){
    var reception = $('#recept_traite').val();
    if(reception == "tous")
        alert("selectionner une reception pour imprimer ?");
    else
        window.open(racine+"clients/get_pdf_traitement/"+reception , '_blank');
        //window.location.href = ;
}
function fiche_stock_client(client_id){
        window.open(racine+"clients/get_fiche_stock_client/"+client_id, '_blank');
}
function save_andgetretire(element){
    saveform(element,function(data){
        window.open(racine+"clients/get_bon_sortie/"+data, '_blank');    
    });
}