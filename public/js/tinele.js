function ajouter_chario_to_tinelle(element) {
	  // var  options = [];
	  // $.each($("#tab2 option:selected"), function () {
   //          options.push($(this).val());
   //      });
   //   if(options.length){
   //   	$.ajax({
   //              type: 'get',
   //              url: racine+'tineles/add_charios_in_tinele/'+options,
   //              success: function (data) {
   //  				$('#datatableshow1').DataTable().ajax.url(racine+"tineles/getDT/"+tinele).load();
   //              },
   //              error: function () {
   //                  alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
   //              }
   //          });
   //   } 

   saveform(element,function(data){
       $('#datatableshow1').DataTable().ajax.url(racine+"charios/getDT/"+data+'/all').load();
   })
}

function deleteObjectCharioOftinele(link){
        $.ajax({
                type: 'get',
                url: link,
                success: function (data) {
                    $('#datatableshow1').DataTable().ajax.url(racine+"charios/getDT/"+data+'/all').load();
                },
                error: function () {
                    alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
                }
            });
}    


function vider_tinele(tinele_id){
      $.ajax({
                type: 'get',
                url: racine+'tineles/vider_tinelle/'+tinele_id,
                success: function (data) {
                    if(data)
                            $('#datatableshow1').DataTable().ajax.url(racine+"charios/getDT/"+tinele_id+'/all').load();
                    else
                        alert("le tinele ne contient pas de chario");
                },
                error: function () {
                    alert("Une erreur est survenue veuillez réessayer ou actualiser la page!");
                }
            });
}

function add_cartons(element){
    saveform(element,function(){
       $('#datatableshow').DataTable().ajax.url(racine+"cartons/getDT").load();
   })   
}
function get_fichier_tinele_etat(tinele){
    window.open(racine+"tineles/get_fichier_info_tinele/"+tinele, '_blank');
}