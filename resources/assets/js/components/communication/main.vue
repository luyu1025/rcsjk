<template>
    <div>
        <div class="chat-tar">交流</div>
        <div class="aspectration" data-ratio="2:1">
            <img src="http://www.lsecret.cn/img/bg1.png">
        </div>
        <div class="info-tab"></div>
        <div class="container icon-box">
            <!--通讯录-->
            <div class="title-bar">
                通讯录
            </div>
            <div class="chat-menu">
                <div class="chat-icon" v-for="item in txl">
                    <img :src="item.img">
                    <p>{{item.name}}</p>
                </div>
                <div class="cb"></div>
            </div>
            <!--发起活动-->
            <div class="title-bar">
                发起活动
            </div>
            <div class="chat-menu">
                <div class="chat-icon" v-for="item in hd">
                    <img :src="item.img">
                    <p>{{item.name}}</p>
                </div>
                <div class="cb"></div>
            </div>
            <!--微社区-->
            <div class="title-bar">
                微社区
            </div>
            <div class="chat-menu">
                <div class="chat-icon" v-for="item in sq">
                    <img :src="item.img">
                    <p>{{item.name}}</p>
                </div>
                <div style="clear:both;"></div>
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
                msg: '交流',
                txl:[
                    {name:'我的校友',url:'',img:'http://www.lsecret.cn/img/chat/xy.png'},
                    {name:'我的部门',url:'',img:'http://www.lsecret.cn/img/chat/bm.png'},
                    {name:'分会',url:'',img:'http://www.lsecret.cn/img/chat/fh.png'},
                ],
                hd:[
                    {name:'老乡会',url:'',img:'http://www.lsecret.cn/img/chat/lxh.png'},
                    {name:'一起回家',url:'',img:'http://www.lsecret.cn/img/chat/home.png'},
                    {name:'发起活动',url:'',img:'http://www.lsecret.cn/img/chat/hd.png'},
                ],
                sq:[
                    {name:'',url:'',img:'http://www.lsecret.cn/img/chat/wsq.png'},
                ],
            }
        },
        mounted(){
//            this.getlist()
        },
        methods:{
            getlist:function () {
                this.$ajax.get(window.host + '/cv/getlist').then(
                    response => {
                        console.log(response.data)
                    },
                    response => {

                    }
                )
            }
        }
    }
</script>