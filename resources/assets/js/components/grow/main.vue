<template>
    <div>
        {{msg}}
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: '成长'
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