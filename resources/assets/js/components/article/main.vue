<template>
    <div class="page">
        <div class="article-detail">
            <section class="head">
                <h1>盘州市大学生联谊会全国分会执行发展委员会第二次代表大会成功举行</h1>
                <p style="float: right;">盘州大学生联谊会</p>
                <p>2018-03-12 09:00:24   |   浏览量 69</p>
            </section>
            <div class="body">
                <div class="article_content">
                </div>
            </div>
        </div>

        <div class="comment">
            <div class="title">
                <span>最新评论</span>
            </div>
            <div class="nocomment" style="padding: 30px 0;">
                <div class="icon"></div>
                <p>暂时没有人发布评论</p>
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
                msg: '文章'
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