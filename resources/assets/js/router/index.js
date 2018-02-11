import Vue from 'vue'
import Router from 'vue-router'
// import route from  '../components/routerView.vue'
import cvlist from  '../components/cv/list.vue'
import index from '../components/index1.vue'
import welcome from '../components/first.vue'
import communication from '../components/communication/main.vue'
import  mine from '../components/mine/main.vue'
import grow from '../components/grow/main.vue'
import grow_share from '../components/grow/share.vue'
import grow_active from '../components/grow/active.vue'
import grow_work from '../components/grow/work.vue'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            name: 'Main',
            component: index,
            redirect:'/index',
            children:[
                { path:'index', component:welcome, name:'首页' },
                { path:'list', component:cvlist, name:'简历列表' },
                { path:'communication', component:communication, name:'交流'},
                { path:'grow', component:grow, name:'成长', redirect:'/grow/share', children:[
                    { path:'share', component:grow_share, name:'取经' },
                    { path:'active', component:grow_active, name:'升级' },
                    { path:'work', component:grow_work, name:'打怪' },
                ]},
                { path:'mine', component:mine, name:'我的'},
            ]
        }
    ]
})
