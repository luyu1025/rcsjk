<template>
    <div>
       <div class="top-bar">

           <div class="title">后台管理系统</div>
           <div class="name"> {{user.name}} <a :href="host+'/api/admin/logout'">登出</a></div>

       </div>
       <div class="left-menu">
           <left-menu></left-menu>
       </div>
        <div class="tab_bar">

        </div>
       <router-view class="main-box">
       </router-view>
       <div class="bottom-bar"></div>
    </div>
</template>
<style>
</style>
<script>
    import leftMenu from './layout/leftBar.vue'
    export default{
        data () {
            return{
                msg:this.$route.name,
                host:window.host,
                user:{
                    id:0,
                    name:''
                }
            }
        },
        mounted(){
            this.getUser();
        },
        components:{
            leftMenu
        },
        methods:{
            getUser:function () {
                const t = this
                this.$ajax.get(window.host+'/api/getMine').then(function (res) {
                    console.log(res.data)
                    if(res.data.err_code==0){
                        t.user=res.data.data
                        t.$store.commit('SET_USER',res.data.data)
                        console.log(123,t.$store.getters.user)
                    }else {
                        t.$message.error(res.data.msg)
                    }
                },function (res) {
                    t.$message.error('获取用户信息失败！')
                })
            }
        }
    }
</script>