<template>
    <div>
        <router-view></router-view>
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
            this.msg = this.$route.name
            this.cou()
        },
        methods:{
            cou:function() {
                this.msg = 'haah'
            }
        }

    }
</script>