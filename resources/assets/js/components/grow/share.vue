<template>
    <div>
        <div class="aspectration" data-ratio="3:1">
            <img src="http://www.lsecret.cn/img/bg1.png">
        </div>
        <mt-loadmore :top-method="loadTop" @top-status-change="handleTopChange">
        <div class="aspectration" data-ratio="20:7" v-for="share in shares">
            <div class="share-box">
                <div class="share-title">{{share.title}}</div>
                <div class="share-major">分享主题：{{share.type}}</div>
                <div class="times">{{share.date}}</div>
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
                shares:[
                    {id:0,title:'学长教你做简历：应届毕业生该如何规划职业生涯',type:'面试',date:'2月9日'},
                    {id:1,title:'学长教你做简历：应届毕业生该如何规划职业生涯',type:'面试',date:'2月9日'},
                    {id:2,title:'学长教你做简历：应届毕业生该如何规划职业生涯',type:'面试',date:'2月9日'},
                    {id:3,title:'学长教你做简历：应届毕业生该如何规划职业生涯',type:'面试',date:'2月9日'},
                    {id:4,title:'学长教你做简历：应届毕业生该如何规划职业生涯',type:'面试',date:'2月9日'},
                    {id:5,title:'学长教你做简历：应届毕业生该如何规划职业生涯',type:'面试',date:'2月9日'},
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