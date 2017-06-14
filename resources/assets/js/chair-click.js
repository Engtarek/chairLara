
window.changepostion=function(){
  $(".parent").click(function(){
      var myPos = $(this).find("div").css("background-position").split(" ");
      myPos[0] = parseInt(myPos[0].replace("px",""));
      myPos[1] = parseInt(myPos[1].replace("px",""));
      if(myPos[0] > -2100 && myPos[1] == 0 ){
        myPos[0] = myPos[0] - 700;
        myPos[1] = 0;
        $(this).find("div").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
      }else if(myPos[0] == -2100 && myPos[1] == 0 ){
        myPos[0] = 0;
        myPos[1] = -700;
        $(this).find("div").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
      }else if(myPos[0] > -2100 && myPos[1] == -700 ){
        myPos[0] = myPos[0] -700;
        myPos[1] = -700;
        $(this).find("div").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
     }else{
       myPos[0] = 0;
       myPos[1] = 0;
       $(this).find("div").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
    }
  });

} 
