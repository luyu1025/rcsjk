<template>
    <div class="full">
        <!--    顶部图片滚动     -->
        <div class="top_pic">
            <mt-swipe :auto="0">
                <mt-swipe-item>
                    <img src="http://localhost:8088/img/1.jpg">
                </mt-swipe-item>
                <mt-swipe-item><img src="http://localhost:8088/img/2.jpg"></mt-swipe-item>
                <mt-swipe-item><img src="http://localhost:8088/img/3.jpg"></mt-swipe-item>
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
            <div class="row">
                <div v-for="icon in icons2" class="col-xs-3 icon_bar">
                    <img :src=icon.img>
                    <p>{{icon.text}}</p>
                </div>
            </div>
        </div>
        <!--最新动态-->
        <div class="container icon-box">
           <div class="title-bar">
               <font><span>|</span>最新动态</font>
               <span class="more">查看更多</span>
           </div>
            <div class="raw info-box" v-for="item in news">
                <img class="col-xs-3" :src="item.img">
                <div class="col-xs-9">
                    <h4 style="margin:5px 0;">
                        {{item.title}}
                    </h4>
                    <div>
                        {{item.info}}
                    </div>
                </div>
                <span class="times">{{item.time}}</span>
                <span style="color:#fff">1</span>
            </div>
        </div>

        <!--团队招新-->
        <div class="container icon-box">
            <div class="title-bar">
                <font><span>|</span>团队招新</font>
                <span class="more">查看更多</span>
            </div>
            <div class="raw info-box" v-for="item in employs">
                <img class="col-xs-3" :src="item.img">
                <div class="col-xs-9">
                    <h4 style="margin:5px 0;">
                        {{item.title}}
                    </h4>
                    <div>
                        {{item.info}}
                    </div>
                </div>
                <span class="times">{{item.time}}</span>
                <span style="color:#fff">1</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                icons1:[
                    {
                        img:window.host+'/img/logo.png',
                        text:'新闻中心',
                        url:'/index'
                    },
                    {
                        img:window.host+'/img/logo.png',
                        text:'新闻中心',
                        url:'/index'
                    },
                    {
                        img:window.host+'/img/logo.png',
                        text:'新闻中心',
                        url:'/index'
                    },
                    {
                        img:window.host+'/img/logo.png',
                        text:'新闻中心',
                        url:'/index'
                    },
                ],
                icons2:[
                    {
                    img:window.host+'/img/logo.png',
                    text:'新闻中心',
                    url:'/index'
                    },
                    {
                        img:window.host+'/img/logo.png',
                        text:'新闻中心',
                        url:'/index'
                    },
                    {
                        img:window.host+'/img/logo.png',
                        text:'新闻中心',
                        url:'/index'
                    },
                    {
                        img:window.host+'/img/logo.png',
                        text:'新闻中心',
                        url:'/index'
                    }
                ],
                news:[
                    {
                        id:1,
                        title:'2018年寒假活动启动仪式',
                        time:'1月22日 13:59:00',
                        img:window.host+'/img/logo.png',
                        url:'/article/1',
                        info:'盘州市大学生联谊会活动在XX举行启动仪式'
                    },
                    {
                        id:1,
                        title:'2018年寒假活动启动仪式',
                        time:'1月22日 13:59:00',
                        img:window.host+'/img/logo.png',
                        url:'/article/1',
                        info:'盘州市大学生联谊会活动在XX举行启动仪式'
                    }
                ],
                employs:[
                    {
                        id:1,
                        title:'2018年寒假部门招新',
                        time:'1月22日 13:59:00',
                        img:window.host+'/img/logo.png',
                        url:'/article/1',
                        info:'2018年寒假部门招新'
                    },
                    {
                        id:1,
                        title:'2018年寒假活动招新',
                        time:'1月22日 13:59:00',
                        img:window.host+'/img/logo.png',
                        url:'/article/1',
                        info:'盘州市大学生联谊会活动招新'
                    }
                ]
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
