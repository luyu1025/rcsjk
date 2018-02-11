<template>
    <div class="full">
        <!--    顶部图片滚动     -->
        <div class="aspectration" data-ratio="2:1">
            <mt-swipe :auto="0">
                <mt-swipe-item v-for="swipe in swipes" :key="swipe.id">
                    <img :src="swipe.img">
                </mt-swipe-item>
            </mt-swipe>
        </div>
        <!-- 快捷入口栏 -->
        <div class="container icon-box">
            <div class="row">
                <div v-for="icon in icons1" class="col-xs-3 icon_bar" @click="turnto(icon.url)">
                    <img :src=icon.img>
                    <p>{{icon.text}}</p>
                </div>
            </div>
        </div>
        <!--分割栏-->
        <div class="background-bar">
            <hr>
            <div>终于等到你</div>
        </div>
        <!--最新动态-->
        <div class="container icon-box">
           <div class="title-bar">
               <div><div class="color_bar"></div>最新动态</div>
               <span class="more">查看更多<img src="http://www.lsecret.cn/img/icon/next.png"></span>
           </div>
            <div class="hr"></div>
            <div class="info-box" v-for="item in news">
                <img :src="item.img">
                <div class="content">
                        {{item.title}}
                </div>
                <span class="times">{{item.time}}</span>
                <span style="color:#fff">1</span>
            </div>
        </div>
        <!--分割栏-->
        <div class="background-bar">
            <hr>
            <div>我是底线</div>
        </div>
        <div style="clear: both"></div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                icons1:[
                    {
                        img:'http://www.lsecret.cn/img/icon/home.png',
                        text:'会员之家',
                        url:'/index'
                    },
                    {
                        img:'http://www.lsecret.cn/img/icon/gk.png',
                        text:'高考指南',
                        url:'/index'
                    },
                    {
                        img:'http://www.lsecret.cn/img/icon/qc.png',
                        text:'活力青春',
                        url:'/index'
                    },
                    {
                        img:'http://www.lsecret.cn/img/icon/rc.png',
                        text:'人才平台',
                        url:'/index'
                    },
                ],
                news:[
                    {
                        id:1,
                        title:'2018年寒假活动启动仪式',
                        time:'1月22日 13:59:00',
                        img:'http://www.lsecret.cn/img/user/bg.jpg',
                        url:'/article/1',
                    },
                    {
                        id:1,
                        title:'2018年寒假活动启动仪式',
                        time:'1月22日 13:59:00',
                        img:'http://www.lsecret.cn/img/user/bg.jpg',
                        url:'/article/1',
                    }
                ],
                swipes:[
                    {id:0,url:'',img:'http://www.lsecret.cn/img/SJK.png'},
                    {id:1,url:'',img:'http://www.lsecret.cn/img/user/bg.jpg'},
                ],
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            turnto:function(url){
                this.$router.push(url);
            }
        }
    }
</script>
