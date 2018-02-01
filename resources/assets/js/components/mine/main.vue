<template>
    <div>
        <div class="mine-top">
            <div class="background-img"><img :src="mine.bgp"></div>
            <div class="mine-head"><img :src="mine.head"></div>
            <div class="mine-text">
                <div>{{mine.name}}</div>
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
                msg: '我的',
                mine:{
                    id:1,
                    name:'卢宇',
                    email:'1239430843@qq.com',
                    phone:'18188286594',
                    bgp:'http://localhost:8088/un.jpg',
                    head:'http://localhost:8088/un.jpg',
                    sex:'0',
                    auth:'0'
                }
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