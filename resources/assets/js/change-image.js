window.change_image=function(product_id,ch_layer_id2,img_pos){

  $.ajax({url: "/change_image/"+product_id+"/"+ch_layer_id2+"/"+img_pos, success: function(result){

let sm_img =new Image();
  sm_img.onload=function(){
    $('.chair').css('background-image','url('++$(this).attr("src")++')');
    $('#load').css('display','none');
    let img=new Image();
    img.onload=function(){
      $('.chair').css('background-image','url('+$(this).attr("src")+')');
      }
    img.src='/products/'+product_id+'/history/'+result+'.jpg';

  }
    img.src='/products/'+product_id+'/small_image/'+result+'.jpg';

}
 });

}
