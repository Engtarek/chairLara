
<template>

  <div v-bind:class="getClass()"  v-bind:style="getStyle()"></div>
 </template>
 <script>
     export default {
     data(){
        return{
            val:'',
        }
     },
     props:['value','productid'],
     mounted() {
         this.val = JSON.parse(this.value);
         console.log(this.val.image.image);
     },
     methods:{
      getStyle(){
        return "position:absolute;z-index:"+this.val.rank+";background-image: url('/products/"+this.productid+"/image/"+this.val.image.image+"')";
      },
      getClass(){
        return  "chair img_"+this.val.rank;
      }
     },

}

 </script>
