<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-1"></div>
            {{msg}}
        </div>
    </div>

</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: 'hello vue'
            }
        },
        mounted(){
            this.getlist()
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