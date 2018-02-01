<template>
<div class="full">
    <router-view style="margin-bottom: 60px"></router-view>
    <nav class="my-tabbar container">
        <div class="row">
            <router-link tag="div" class="col-xs-3 bottom-bar" v-for="tab in tabbars" :key="tab.text" :to="tab.url" active-class="bottom-active">
                <i :class="tab.class" style="font-size: 3rem"></i>
                <div>{{tab.text}}</div>
            </router-link>
        </div>
    </nav>
</div>


</template>

<script>
    export default {
        data(){
            return {
                tabbars:[
                    {
                        text:'首页',
                        url:'/index',
                        class:'iconfont icon-index',
                    },
                    {
                        text:'成长',
                        url:'/grow',
                        class:'iconfont icon-grow',
                    },
                    {
                        text:'交流',
                        url:'/communication',
                        class:'iconfont icon-chat',
                    },
                    {
                        text:'我的',
                        url:'/mine',
                        class:'iconfont icon-mine',
                    }
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
