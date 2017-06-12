function change_image(product_id,ch_layer_id2,img_pos){

  $.ajax({url: "/change_image/"+product_id+"/"+ch_layer_id2+"/"+img_pos, success: function(result){
    $('.chair').css('background-image','url('+result["image"]+')');
    $('#load').css('display','none');

    let img=new Image();
    img.onload=function(){
      $('.chair').css('background-image','url('+$(this).attr("src")+')');
      }
    img.src='/products/'+product_id+'/history/'+result["name"]+'.jpg';
   },
 });

}
