import Vue from 'vue'
import Router from 'vue-router'
// import route from  '../components/routerView.vue'
import cvlist from  '../components/cv/list.vue'
import index from '../components/index.vue'
import welcome from '../components/first.vue'
import communication from '../components/communication/main.vue'
import  mine from '../components/mine/main.vue'
import grow from '../components/grow/main.vue'

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
                { path:'grow', component:grow, name:'成长'},
                { path:'mine', component:mine, name:'我的'},
            ]
        }
    ]
})
