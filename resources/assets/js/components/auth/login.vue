<template>
    <div style="margin-bottom: 0px!important; overflow:hidden;">
       <div class="bg-div">
           <!--<img src="http://www.lsecret.cn/img/SJK1.png">-->
           <div class="auth_box">
               <div class="login_tittle">
                   <!--<div>账号登陆</div>-->
                   <!--<div>快捷登陆</div>-->
               </div>
               <router-view>

               </router-view>

           </div>
       </div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: 'hello vue',
                phone:'',
                password:''
            }
        },
        mounted(){

        },
        methods:{

        }
    }
</script>