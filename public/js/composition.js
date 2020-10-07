$(function(){

var id_match = $('.global').data('idMatch');
// var id_compo = $('.global').data('idCompo');

// var positions = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var positions = JSON.parse(document.getElementById("composition").value);
var id_comp = JSON.parse(document.getElementById("idcomposition").value);

var banc = positions[id_comp]['banc'];
var compo = positions[id_comp]['compo'];
var selected = positions[id_comp]['selected'];

// console.log('positions : '+positions);
// console.log('banc : '+positions.banc);
// console.log('positions : '+positions);


for (i= 1; i<17 ; i++) {
  if(positions[id_comp]['compo'][i]>0) {
    $('[data-id-position="'+i+'"]').append($('[data-id-player="'+positions[id_comp]['compo'][i]+'"]'));   
  }
}

positions[id_comp]['banc'].forEach((item, index) => {
  // console.log("player au banc : " + item) //value
  // console.log(index) //index
  $('#banc').append($('[data-id-player="'+item+'"]'));   
})


positions[id_comp]['selected'].forEach((item, index) => {
  // console.log("player dans les selections : " + item) //value
  // console.log(index) //index
  $('#selected').append($('[data-id-player="'+item+'"]'));   
})



$('.draggable').draggable({
    helper: "clone",
    containment: "document",
    zIndex: 100,
    revertDuration: 500,
    start: function(event, ui){
      // $(ui.helper).addClass("ui-helper");
    //   $(ui.helper).width($(".droppable").width());
    }
  });
  
  $('.droppable').droppable({
  
    activeClass: "ui-over",
    hoverClass: "droppable-over",
    accept: '.draggable',
    drop: function(event, ui) {
  
      id = $(ui.draggable).data('id');
      // idcard = $(this).attr('id');
      previous = ui.draggable.parent();      
      
      if(!$(this).is($(previous)))
      {
          // console.log('positions : ----------------------------');
          // console.log(positions);
          
          // console.log('---------------------------- id player');

          id_player = $(ui.draggable).data('idPlayer');

          // console.log(id_player);

          id_position = $(this).data('idPosition');
          prev_position = ui.draggable.parent().data('idPosition');
          // console.log("previous id : " + ui.draggable.parent().attr('id'));
          prev_player = positions[id_comp]['compo'][id_position];
          // console.log('id_player:'+id_player+' id_position')
          // console.log('[data-id-player="'+prev_player+'"]');
          if(prev_player>0){
            if(prev_position>0) positions[id_comp]['compo'][prev_position] = prev_player;
            $(previous).append($('[data-id-player="'+prev_player+'"]'));            
          } else {
            positions[id_comp]['compo'][prev_position] = 0;
          }
          $(this).append(ui.draggable.css({
            position: 'relative'
            // background: 'green'
          }));
          if(id_position>0) positions[id_comp]['compo'][id_position] = id_player;
          
          if($(this).attr('id')=="banc"){
            positions[id_comp]['banc'].push(id_player)
          }
          if($(this).attr('id')=="selected"){
            positions[id_comp]['selected'].push(id_player)
          }
          
          if(prev_position==0) {
            if($(previous).attr('id')=="banc"){
              // console.log("banc before : " + positions[id_comp]['banc']);
              for( var i = 0; i < positions[id_comp]['banc'].length; i++){ if ( positions[id_comp]['banc'][i] == id_player) { positions[id_comp]['banc'].splice(i, 1); }}
              // console.log("banc after : " + positions[id_comp]['banc']);
            }
            if($(previous).attr('id')=="selected"){
              // console.log("selected before : " + positions[id_comp]['selected']);
              for( var i = 0; i < positions[id_comp]['selected'].length; i++){ if ( positions[id_comp]['selected'][i] == id_player) { positions[id_comp]['selected'].splice(i, 1); }}
              // console.log("selected after : " + positions[id_comp]['selected']);
            }
          }

          // console.log("positions : " + positions);
          // console.log('----------------------------');
          // console.log('compo à insérer : ' + JSON.stringify(positions))
          $.ajax({
            method: "POST",
            url: `/match/composition/update/${id_match}`,
            // data: { composition: JSON.stringify(positions)},
            // data: { composition: positions},
            // data: { composition: JSON.stringify(positions)},
            data: { composition: positions},
            error : function(xhr, textStatus, errorThrown) {  
                alert('Ajax request failed.' + errorThrown +textStatus);  
           }}  )
          .done(function( msg ) {
            // alert( "composition sauvée : " + msg );
            // alert( "composition sauvée : " + id_match );
          });


            // $post(`/match/composition/update/${id_match}`, {
            //   method: 'POST',
            // }).then(function() 
            // {     
                // bootbox.alert({
                //   message: "Mise à jour de la position ok!",
                //   className: 'rubberBand animated',
                //   size: 'small'
                // });
                // $('[data-toggle="popover"]').popover('hide');
                // $(".jail").css('visibility', 'hidden');
              // });
            // });
    
        // });
  
        // $(ui.draggable).popover('show');
  
      }
        
        
    }
  });
  



// initialisation joueurs

  











// Tooltips Initialization

    
    // alert("blah");
    // main.classList.add("loading");
    // setTimeout(function() { main.classList.remove("loading"); }, 1800); 
      //$('[data-toggle="popover"]').popover()
    // $('[data-toggle="popover"]').popover();
  
    // $('[data-toggle="popover"]').on('shown.bs.popover', function () {
  
    //   $(".jail").css('visibility', 'visible');
    //   $('#btn-cancel').click(function () {
    //     $('[data-toggle="popover"]').popover('hide');
    //     $(".jail").css('visibility', 'hidden');
    //   });
    //   $('#btn-confirm').click(function (event) {
    //     alert('bla');
    //     // var id = event.data['id'];
    //     // var idcard = event.data['idcard'];
    //     var id = $(".global").data('id');
    //     var idcard = $(".global").data('idcard');
  
    //     fetch(`/position/${id}/${idcard}`, {
    //       method: 'POST',
    //     }).then(function () 
    //       {
    //       bootbox.alert({
    //         message: "Mise à jour de la position ok!",
    //         className: 'rubberBand animated',
    //         size: 'small'
    //       });
    //       $('[data-toggle="popover"]').popover('hide');
    //       $(".jail").css('visibility', 'hidden');
    //       });
    //     });
  
    // });

  
  
  
  
    
  
  
  
    //   if (bootbox.confirm("Êtes-vous sûr?", function (result) {
    //      if (result == false ){return}
    //       fetch(`/position/${id}/${idcard}`, {
    //         method: 'POST',
    //       }).then(function () {
    //         bootbox.alert({
    //           message: "Mise à jour de la position ok!",
    //           className: 'rubberBand animated',
    //           size: 'small'
    //         });
    //       })
  
    //     })) {
  
    //   }
    // }


  });