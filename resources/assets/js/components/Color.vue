
<template>
    <div v-bind:class="getClass()">
      <img v-bind:src="getImage()">
    </div>
 </template>
 <script>
     export default {
     data(){
        return{
            val:'',
            img:''
        }
     },
     props:['data','image','productid'],
     mounted() {
         this.val = JSON.parse(this.data);
         this.img = JSON.parse(this.image);
     },
     methods:{
      getImage(){
        return "/products/"+this.productid+"/color/"+this.img.color+"";
      },
      getClass(){
        return  "img-circle color_"+this.val.rank;
      }
     },

}

 </script>
