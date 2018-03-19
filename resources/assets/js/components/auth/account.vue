<template>
    <div>
        <div>
            {{this.password}}
            <mt-field placeholder="Input tel" type="tel" v-model="phone"></mt-field>
            <mt-field placeholder="Input password" type="password" v-model="password"></mt-field>
        </div>
        <div>
            <mt-button size="normal" @click="login">登陆</mt-button>
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
            login:function(){
                this.$ajax.post(window.host + '/api/login',{
                    phone:this.phone,
                    password:this.password
                }).then(
                    response => {
                        console.log(response.data)
                    },
                    response => {
                        console.log(response)
                    }
                )
            }
        }
    }
</script>