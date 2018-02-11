<template>
    <div>
        <div class="grow-tar">
            <router-link tag="div" v-for="tab in tabs" :key="tab.text" :to="tab.url" active-class="top-active">
                {{tab.text}}
            </router-link>
        </div>
        <router-view class="grow-body"></router-view>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: '成长',
                tabs:[
                    {text:'取经',url:'/grow/share'},
                    {text:'升级',url:'/grow/active'},
                    {text:'打怪',url:'/grow/work'},
                ]
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