<template>
    <div>
        <div class="article-title">
            <div></div>
            <div>{{time}}</div>
        </div>
        <div class="article-context">

        </div>
        <div class="">

        </div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: '成长',
                title:'title',
                context:'内容abcdefg',
                time:new Date(),
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