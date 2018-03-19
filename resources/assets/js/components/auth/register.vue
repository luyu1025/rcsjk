<template>
    <div>
        <mt-field label="用户名" placeholder="请输入用户名" v-model="name"></mt-field>
        <mt-field label="手机号" placeholder="请输入手机号" type="tel" v-model="phone"></mt-field>
        <mt-field label="邮箱" placeholder="请输入邮箱" type="email" v-model="email"></mt-field>
        <mt-field label="密码" placeholder="请输入密码" type="password" v-model="password"></mt-field>
        <mt-field label="确认密码" placeholder="请输再次入密码" type="password" v-model="password2"></mt-field>
        <button @click="register">注册</button>
        <button @click="getReg">获取验证码</button>

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
                name:'',
                email:'',
                phone:'',
                password:'',
                password2:'',
                reg:'',
                t:60
            }
        },
        mounted(){

        },
        methods:{
            register:function(){
                let user = {name:this.name,email:this.email,phone:this.phone,password:this.password}
                this.$ajax.post(window.host + '/api/register',user).then(
                    function(res){
                        if(res.data.length){
                            console.log(res.data)
                        }else {
                            console.log('不存在')
                        }
                    },function (res) {
                        console.log(res)
                    }
                )
            },
            getReg:function () {
                if(this.regPhone()){
//                    this.$ajax.post(window.host+'/api/sendMessage', {
//                        phone:this.phone
//                    }).then(
//                        function (res) {
//
//                        },function(err) {
//
//                        }
//                    )
                    console.log('success')
                }
                console.log('regPhone:'+this.regPhone())
            },
            regAll:function () {
                if(this.regPhone()){

                }
            },
            regPhone:function () {
                let myreg = /^1[3|4|5|7|8][0-9]{9}$/;
                if(myreg.test(this.phone)){
                    return true
                }else {
                    MessageBox.alert('请输入正确的手机号！','错误')
                    return false
                }
            },
            regPassWord:function () {
                if(this.password.length<6){
                    MessageBox.alert('密码长度不得少于6位！','错误')
                }else {

                    return true
                }
            },
            regPassWord2:function () {

            }
        }
    }
</script>