import Vue from 'vue'
import Router from 'vue-router'
// import route from  '../components/routerview.vue'
import cvlist from  '../components/cv/list.vue'
import index from '../components/index1.vue'
import welcome from '../components/first.vue'
import communication from '../components/communication/main.vue'
import  mine from '../components/mine/main.vue'
import grow from '../components/grow/main.vue'
import grow_share from '../components/grow/share.vue'
import grow_active from '../components/grow/active.vue'
import grow_work from '../components/grow/work.vue'
import login from '../components/auth/login.vue'
import register from '../components/auth/register.vue'
import routerView from '../components/index.vue'
import accountLogin from '../components/auth/account.vue'
import atricle from '../components/grow/article.vue'
import more from '../components/article/list.vue'

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
                { path:'mine', component:routerView, redirect:'/mine/index', children:[
                    {path:'index', component:mine, name:'我的'},
                    {path:'login', component:login, name:'登录', redirect:'/mine/login/account', children:[
                        { path:'account', component:accountLogin, name:'账号登陆'}
                    ]},
                    {path:'register', component:register, name:'注册'}
                ]},
                { path:'article/:id', component:atricle, name:'article'},
                { path:'more', component:more, name:'list'},
            ]
        }
    ]
})
