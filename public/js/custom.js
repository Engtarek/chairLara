let param2;
function chair(param2){
  let down=false;
  let startPoint=null;
  let x=0;
  let y=0;
  let offset=25;
  $('.parent').on('mousedown touchstart',function (e) {
      down=true;
      if(e.type == 'mousedown'){
          startPoint=e.clientX;
      }else if(e.type == 'touchstart'){
          startPoint=e.originalEvent.touches[0].clientX;
      }


  });
  $('.parent').on('mousemove touchmove',function (e) {
      if(e.type == 'mousemove'){
        if(down){
            if((e.clientX-startPoint)-offset>0){

                startPoint=e.clientX;
                if(x===-2100){
                    x=0;
                    y-=700;
                    $(this).css('background-position',x +'px '+y+'px');

                }else{
                    x-=700;
                    $(this).css('background-position',x +'px '+y+'px');
                }

            }else if((e.clientX-startPoint)+offset<0){
              startPoint=e.clientX;
              if(x===0){
                  x-=2100;
                  y-=700;
                  $(this).css('background-position',x +'px '+y+'px');

              }else{
                  x+=700;
                  $(this).css('background-position',x +'px '+y+'px');
              }
            }

  }
}else if(e.type == 'touchmove'){
        if(down){
            if((e.originalEvent.touches[0].clientX-startPoint)-offset>0){

                startPoint=e.originalEvent.touches[0].clientX;
                if(x===-2100){
                    x=0;
                    y-=700;
                    $(this).css('background-position',x +'px '+y+'px');

                }else{
                    x-=700;
                    $(this).css('background-position',x +'px '+y+'px');
                }

            }else if((e.originalEvent.touches[0].clientX-startPoint)+offset<0){
              startPoint=e.originalEvent.touches[0].clientX;
              if(x===0){
                  x-=2100;
                  y-=700;
                  $(this).css('background-position',x +'px '+y+'px');

              }else{
                  x+=700;
                  $(this).css('background-position',x +'px '+y+'px');
              }
            }

  }

      }
  });
  $('.parent').on('mouseup touchend',function (e) {
      down=false;
      startPoint=null;
  });
//   let down=false;
//   let startPoint=null;
//   let x=0;
//   let y=0;
//   let offset=25;
//   $('.parent').on('mousedown',function (e) {
//       down=true;
//       startPoint=e.clientX;
//   });
//   $('.parent').on('mousemove',function (e) {
//       if(down){
//           if((e.clientX-startPoint)-offset>0){
//
//               startPoint=e.clientX;
//               if(x===-2100){
//                   x=0;
//                   y-=700;
//                   $(this).find('.'+param2+'').css('background-position',x +'px '+y+'px');
//
//               }else{
//                   x-=700;
//                   $(this).find('.'+param2+'').css('background-position',x +'px '+y+'px');
//               }
//
//           }else if((e.clientX-startPoint)+offset<0){
//             startPoint=e.clientX;
//             if(x===0){
//                 x-=2100;
//                 y-=700;
//                 $(this).find('.'+param2+'').css('background-position',x +'px '+y+'px');
//
//             }else{
//                 x+=700;
//                 $(this).find('.'+param2+'').css('background-position',x +'px '+y+'px');
//             }
//           }
//
// }
//   });
//   $('.parent').on('mouseup touchend',function (e) {
//       down=false;
//       startPoint=null;
//   });

}
