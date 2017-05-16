var class1,class2,imgextention,product_id;
function changeimage(class1,class2,imgextention,product_id) {
  $("."+class1+"").click(function(){
    var imgsrc = $(this).find('img').attr("src");
    var imgname = imgsrc.substring(imgsrc.lastIndexOf('/') + 1).split('.')[0];
    $("."+class2+"").css("background-image","url(/products/"+product_id+"/image/"+imgname+"."+imgextention+")");
  });
}
var param,product_id;
function changepostion(param,product_id){
  $(".parent").click(function(){

      var myPos = $(this).find("."+param+"").css("background-position").split(" ");
    myPos[0] = parseInt(myPos[0].replace("px",""));
    myPos[1] = parseInt(myPos[1].replace("px",""));

    if(myPos[0] > -2100 && myPos[1] == 0 ){
       myPos[0] = myPos[0] - 700;
       myPos[1] = 0;
         $(this).find("."+param+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
    }else if(myPos[0] == -2100 && myPos[1] == 0 ){
      myPos[0] = 0;
      myPos[1] = -700;
        $(this).find("."+param+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
   }else if(myPos[0] > -2100 && myPos[1] == -700 ){
     myPos[0] = myPos[0] -700;
     myPos[1] = -700;
      $(this).find("."+param+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
   }else{
     myPos[0] = 0;
     myPos[1] = 0;
      $(this).find("."+param+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
   }
  });
}
