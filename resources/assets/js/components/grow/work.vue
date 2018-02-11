<template>
    <div>
        <img style="width: 100%; height:100%;" src="http://www.lsecret.cn/img/kdd.png">
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: '取经',
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