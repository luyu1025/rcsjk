<template>
    <div>
        <div>

        </div>

    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: '我的',
                mine:{
                    id:1,
                    name:'蒋小花',
                    email:'1239430843@qq.com',
                    phone:'18188286594',
                    qm:'我想想要一个很酷的签名',
                    bgp:'http://www.lsecret.cn/img/user/bg.jpg',
                    head:'http://www.lsecret.cn/img/user/head.jpg',
                    sex:'0',
                    auth:'0'
                },
                item1:[
                    {text:'个人信息',img:'http://www.lsecret.cn/img/icon/mine/info.png',url:''},
                    {text:'我的申请',img:'http://www.lsecret.cn/img/icon/mine/apply.png',url:''},
                    {text:'我的发布',img:'http://www.lsecret.cn/img/icon/mine/fb.png',url:''},
                    {text:'建议反馈',img:'http://www.lsecret.cn/img/icon/mine/jy.png',url:''},
                ],
                item2:[
                    {text:'我的设置',img:'http://www.lsecret.cn/img/icon/mine/set.png',url:''},
                    {text:'我的校友',img:'http://www.lsecret.cn/img/icon/mine/xy.png',url:''},
                    {text:'安全中心',img:'http://www.lsecret.cn/img/icon/mine/safe.png',url:''},
                    {text:'我想静静',img:'http://www.lsecret.cn/img/icon/mine/unable.png',url:''},
                ],
            }
        },
        mounted(){
            this.getInfo()
        },
        methods:{
            getInfo:function () {
                let t = this
                this.$ajax.get(window.host + '/api/user/info/getUser').then(
                    response => {
                        console.log(response.data)
                        if(response.data.err_code == 0){
                            t.mine = response.data.data
                        }else {
                            t.mine = {
                                id:0,
                                name:'未登录',
                                email:'',
                                phone:'',
                                qm:'',
                                bgp:'http://www.lsecret.cn/img/user/bg.jpg',
                                head:'http://www.lsecret.cn/img/user/head.jpg',
                                sex:'0',
                                auth:'0'
                            }
                        }
                    },
                    response => {

                    }
                )
            },
            updateInfo:function () {

            }
        }
    }
</script>