function change_image(product_id,ch_layer_id2,img_pos){

  $.ajax({url: "/change_image/"+product_id+"/"+ch_layer_id2+"/"+img_pos, success: function(result){
    console.log(result);
  //  $('.chair').css('background-image','url('/products/'+product_id+'/small_image/'+result+'.jpg')');
      $('.chair').css('background-image','url(/products/'+product_id+'/small_image/'+result+'.jpg)');
    $('#load').css('display','none');

    let img=new Image();
    img.onload=function(){
      $('.chair').css('background-image','url('+$(this).attr("src")+')');
      }
    img.src='/products/'+product_id+'/history/'+result+'.jpg';
   },
 });

}
