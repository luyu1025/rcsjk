<template>
    <div>
        <div class="article-title">

        </div>
        <div></div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data () {
            return{
                msg: '成长',
                context:[
                    'sdjfaklsjfklfjklsdjfklajfklasjfklsjdfka',
                    '的萨芬监考老师房价开始龙卷风快速路附近束带结发',
                    'jkjjjjkdkkkkkkkkkk'
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