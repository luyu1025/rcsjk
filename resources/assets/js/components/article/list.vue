<template>
    <div class="full">
        <div class="top-bar">最新动态</div>
        <mt-loadmore :top-method="loadTop" :bottom-all-loaded="allLoaded" ref="loadmore">
        <div v-infinite-scroll="loadMore"
             infinite-scroll-disabled="loading"
             infinite-scroll-distance="10">
            <div class="info-box" v-for="item in news" @click="turnTo(item.id)">
                <img :src="item.img">
                <div class="content">
                    {{item.title}}
                </div>
                <span class="times">{{item.updated_at}}</span>
                <span style="color:#fff">1</span>
            </div>
        </div>
        </mt-loadmore>

        <!--最新动态-->
        <!--<div class="container icon-box">-->
            <!--<div class="title-bar">-->
                <!--<div><div class="color_bar"></div>最新动态</div>-->
                <!--<span class="more">查看更多<img src="http://www.lsecret.cn/img/icon/next.png"></span>-->
            <!--</div>-->
            <!--<div class="hr"></div>-->
            <!---->
        <!--</div>-->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                news:[],
                page:1,
                loading :false,
                per_page:3,
                allLoaded:false,
            }
        },
        mounted() {
//            this.getPosts()
        },
        methods:{
            turnTo:function(id){
                this.$router.push({ name: 'article', params: { id: id }});
            },
            loadTop:function () {
                this.page =1
                this.news = []
                this.loadMore()
                this.$refs.loadmore.onTopLoaded();
            },
            getPosts:function () {
                let t = this
                t.$ajax.post(window.host+'/api/content/getPosts',{type:'new',isUser:true,per_page:t.per_page,page:t.page}).then(
                    (res)=>{
                            t.news = []
                            for(let i=0; i<res.data.data.length; i++){
                                t.$set(t.news,i,res.data.data[i])
                            }
                            t.page++
                    },(res)=>{}
                )
            },
            loadMore:function () {
                let t = this
                this.loading = true;
                t.$ajax.post(window.host+'/api/content/getPosts',{type:'new',isUser:true,per_page:t.per_page,page:t.page}).then(
                    (res)=>{
                        for(let i=0; i<res.data.data.length; i++){
                            t.news.push(res.data.data[i])
                        }
                        if (res.data.data.length==t.per_page){
                            t.page++
                            t.loading = false;
                        }else {

                        }
                    },(res)=>{}
                )
            },
            test:function(){
                console.log(this.news)
            }
        }
    }
</script>
