<template>
    <div>
        <div class="aspectration" data-ratio="3:1">
            <img src="http://www.lsecret.cn/img/bg2.png">
        </div>
        <mt-loadmore :top-method="loadTop" @top-status-change="handleTopChange">
            <div class="aspectration" data-ratio="20:7" v-for="active in actives">
                <div class="active-box">
                    <div class="active-main">
                        <div class="active-title">{{active.title}}</div>
                        <div class="active-type">招新：{{active.type}}</div>
                        <div class="times">{{active.date}}</div>
                    </div>
                    <div class="active-img">
                        <img :src="active.img">
                    </div>
                </div>
            </div>
        </mt-loadmore>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: '取经',
                actives:[
                    {id:0,title:'2018年盘州市大学生联谊会寒假“春联下乡”活动招新',type:'活动',date:'2月9日',img:'http://www.lsecret.cn/img/bg2.png'},
                    {id:1,title:'2018年盘州市大学生联谊会寒假“春联下乡”活动招新',type:'活动',date:'2月9日',img:'http://www.lsecret.cn/img/bg2.png'},
                    {id:2,title:'2018年盘州市大学生联谊会寒假“春联下乡”活动招新',type:'活动',date:'2月9日',img:'http://www.lsecret.cn/img/bg2.png'},
                    {id:3,title:'2018年盘州市大学生联谊会寒假“春联下乡”活动招新',type:'活动',date:'2月9日',img:'http://www.lsecret.cn/img/bg2.png'},
                    {id:4,title:'2018年盘州市大学生联谊会寒假“春联下乡”活动招新',type:'活动',date:'2月9日',img:'http://www.lsecret.cn/img/bg2.png'},
                    {id:5,title:'2018年盘州市大学生联谊会寒假“春联下乡”活动招新',type:'活动',date:'2月9日',img:'http://www.lsecret.cn/img/bg2.png'},
                    {id:6,title:'2018年盘州市大学生联谊会寒假“春联下乡”活动招新',type:'活动',date:'2月9日',img:'http://www.lsecret.cn/img/bg2.png'},
                ],
                topStatus: '',
            }
        },
        mounted(){

        },
        methods:{
            handleTopChange(status) {
                this.topStatus = status;
            },
            loadTop(){},
        }
    }
</script>