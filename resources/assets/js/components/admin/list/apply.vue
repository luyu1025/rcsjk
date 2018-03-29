<template>
    <div>
        <div>{{msg}}</div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg:this.$route.name
            }
        },
        mounted(){

        },
        methods:{

        }
    }
</script>