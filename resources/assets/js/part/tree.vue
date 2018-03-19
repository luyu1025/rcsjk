<template>
    <li class="tree_li">
        <div v-if="isFolder" @click="toggle">
            <i :class="{'el-icon-caret-right':!isOpen,'el-icon-caret-bottom':isOpen}"></i>
            <!--<i class="iconfont tree_icon" :class="'icon-'+data.icon"></i>-->
            <!--<img :src="getSrc(data.icon)" class="icon_img">-->
            {{data.name}}
        </div>
        <router-link v-if="!isFolder" :to="data.link" tag="div" active-class="tree_active">
            <!--<img :src="getSrc(data.icon)" class="icon_img">-->
            <i class="el-icon-document"></i>
            {{data.name}}</router-link>
        <ul class="tree_ul" v-if="isFolder" v-show="isOpen">
            <tree v-for="item in data.children" :data="item" :key="item.name"></tree>
        </ul>
    </li>
</template>
<style>
    .tree_icon{
        margin: 0 0.3rem 0 0.2rem;
    }
    .tree_active{
        background-color: bisque;
    }
    .tree_li>div{
        cursor: pointer;
        line-height: 2rem;
        padding-left: 0.5rem;
    }
    .tree_ul{
        margin: 0;
        padding-left: 1rem;
    }
    .icon_img{
        width: 1rem;
    }
</style>
<script>
//    import set from '../../assets/img/car_set.png'
//    import report from '../../assets/img/car_report.png'
//    import control from '../../assets/img/car_control.png'
//    import manage from '../../assets/img/car_manage.png'
//    import info from '../../assets/img/info.png'
//    import car from '../../assets/img/car.png'
//    import def from '../../assets/img/c.png'
    export default{
        props:['data'],
        data () {
            return{
                isOpen:false
            }
        },
        created:function(){

        },
        computed:{
            isFolder:function () {
                return this.data.children && this.data.children.length
            },
        },
        methods:{
            toggle:function () {
                if (this.isFolder) {
                    this.isOpen = !this.isOpen
                }
            },
//            getSrc:function (key) {
//                let src = def
//                switch (key){
//                    case "base_message":
//                        src = set
//                        break;
//                    case "vehicle_message":
//                        src = info
//                        break;
//                    case "user_message":
//                        src = info
//                        break;
//                    case "vehicle_manage":
//                        src = car
//                        break;
//                    case "vehicle_monitoring":
//                        src = car
//                        break;
//                    case "vehicle_online":
//                        src = car
//                        break;
//                    case "vehicle_monitor":
//                        src = control
//                        break;
//                }
//                return src
//            }
        }
    }
</script>
