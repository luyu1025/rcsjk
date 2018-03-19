<template>
    <div>
        <div>
            <mt-field placeholder="Input tel" type="tel" v-model="phone"></mt-field>
            <mt-field placeholder="Input password" type="password" v-model="password"></mt-field>
        </div>
        <div class="login-btn">
            <mt-button size="small" @click="login">登陆</mt-button>
            <mt-button size="small" @click="register">注册</mt-button>
        </div>
    </div>
</template>
<style>
</style>
<script>
    import { MessageBox } from 'mint-ui';
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
                let t = this
                this.$ajax.post(window.host + '/api/login',{
                    phone:this.phone,
                    password:this.password
                }).then(
                    response => {
                        if(response.data.err_code!=0){
                            MessageBox('提示',response.data.msg)
                        }else {
//                            MessageBox('提示',response.data.msg)
                            t.$router.push('/')
                        }
                    },
                    response => {
                        console.log(response)
                    }
                )
            },
            register:function(){
                this.$router.push('/mine/register');
//                MessageBox('提示','操作成功')
            }
        }
    }
</script>