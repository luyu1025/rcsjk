<template>
<div class="full">
    <router-view style="margin-bottom: 60px"></router-view>
    <nav class="my-tabbar container">
        <div class="row">
            <router-link tag="div" class="col-xs-3 bottom-bar" v-for="tab in tabbars" :key="tab.text" :to="tab.url" active-class="bottom-active">
                <div :class="tab.class"></div>
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
                        class:'bottom-icon bottom-icon-index',
                    },
                    {
                        text:'成长',
                        url:'/grow',
                        class:'bottom-icon bottom-icon-grow',
                    },
                    {
                        text:'交流',
                        url:'/communication',
                        class:'bottom-icon bottom-icon-chat',
                    },
                    {
                        text:'我的',
                        url:'/mine',
                        class:'bottom-icon bottom-icon-mine',
                    }
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
