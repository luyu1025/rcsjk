<template>
    <div style="background-color: #ffffff">
        <div class="article-title">
            <h4>{{art.title}}</h4>
            <div>{{art.updated_at}}</div>
        </div>
        <div class="article-context">
            <div v-html="msg" class="post_content">{{msg}}</div>
        </div>
        <div class="">

        </div>
    </div>
</template>
<style>
    .post_content img{
        width: 100%;
    }
</style>
<script>
    export default{
        data () {
            return{
                msg: '成长',
                title:'title',
                context:'内容abcdefg',
                time:new Date(),
                art:{}
            }
        },
        mounted(){
//            this.getlist()
            this.getContentById()
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
            },
            getContentById:function () {
                let t = this
                let req = {
                    id:t.$route.params['id']
                }
                this.$ajax.post(window.host+'/api/content/getPostById',req).then(
                    (res)=>{
                        if(res.data.err_code == 0){
                            t.msg = res.data.data.content
                            t.art = res.data.data
                        }
                    },(res)=>{}
                )
            }
        }
    }
</script>