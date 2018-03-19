<template>
    <div>
        <div v-if="state">
            <tree v-for="item in list" :data="item" :key="item.name"></tree>
        </div>
        <div class="info_text" v-if="!state">
            {{text}}
        </div>
    </div>
</template>
<style>
    .info_text{
        font-size: 13px;
        color: #a0a0a0;
        text-align: center;
        padding: 1rem;
    }
</style>
<script>
    export default{
        data () {
            return{
                arr:[],
                list:[
                    { name:"我的",link:'',icon: "default",children:[
                        { name:'信息管理', icon: "default", link:'/mine/index'},
                        { name:'安全管理', icon: "default", link:'/mine/safe'},
                    ]},
                    { name:"会员管理",link:'',icon: "default",children:[
                        { name:'会员列表', icon: "default", link:'/member'},
                        { name:'申请管理', icon: "default", link:'/apply'},
                    ]},
                    { name:"内容管理",link:'',icon: "default",children:[
                        { name:'新闻发布', icon: "default", link:'/content'},
                        { name:'招募通告', icon: "default", link:'/recruit'},
                        { name:'分享审批', icon: "default", link:'/share'},
                        { name:'活动列表', icon: "default", link:'/active'},
                    ]},
                ],
                state:true,
                text:"正在获取菜单..."
            }
        },
        computed:{
            treeList:function () {
                let arr = []
                for (let i=0;i<this.list.length;i++){
                    this.list[i].pids = this.list[i].pid.split('.')
                }
            }
        },
        created:function(){
//            this.getTree()
        },
        methods:{
            getTree:function () {
                const v = this
                this.$ajax.get(window.host+'/api/getMenu').then(function (res) {
                    if(res.data.err_code == 0){
                        v.state = true
                        v.list = v.toTreeData(res.data.data)
                        console.log(v.list)
                    }else {
                        v.state = false
                        v.text = "获菜单表失败！"
                        v.$message.info(res.data.message)
                    }
                },function (res) {
                    v.$alert('请求异常！','警告',{
                        confirmButtonText:'确定',
                        type:'warning'
                    })
                })
            },
            toTreeData :function (list,pid='0',deep=0) {
                let arr = []
                const v = this
                for(let i=0; i<list.length; i++){
                    if (list[i].deep==deep&&list[i].pid==pid){
                        arr.push(list[i])
                        let li = arr[(arr.length-1)]
                        li.children = v.toTreeData(list,li.id,deep+1)
                    }
                }
                return arr
            }
        }
    }
</script>
