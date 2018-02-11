<template>
    <div>
        <div class="aspectration" data-ratio="1:0.67">
            <img :src="mine.bgp" style="z-index: 0;">
            <div class="mine-top" style="z-index: 1;">
                <div class="title-bar">
                    我的
                </div>
                <img class="head-pic" :src="mine.head">
                <div>
                    <div class="name">{{mine.name}}</div>
                    <div style="clear: both;"></div>
                    <div class="qm">{{mine.qm}}</div>
                </div>
                <div class="mine-top-bottom">
                    <div>
                        <i class="iconfont icon-sc"></i>收藏
                    </div>
                    <div>
                        <i class="iconfont icon-tz"></i>通知
                    </div>
                </div>
            </div>
        </div>
        <div class="container menu-box">
            <div class="line-across"></div>
            <div class="line-stand left-25"></div>
            <div class="line-stand left-50"></div>
            <div class="line-stand left-75"></div>
            <div class="row">
                <div v-for="item in item1" class="col-xs-3">
                    <img :src="item.img">
                    <p>{{item.text}}</p>
                </div>
            </div>
            <div class="row">
                <div v-for="item in item2" class="col-xs-3">
                    <img :src="item.img">
                    <p>{{item.text}}</p>
                </div>
            </div>
        </div>

        <div class="container icon-box button-bar">
            <mt-button  size="small" class="mine-logout">不要点我</mt-button>
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