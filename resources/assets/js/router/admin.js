import Vue from 'vue'
import Router from 'vue-router'

import routerView from '../components/routerView.vue'
import main from '../components/admin/main.vue'
import mine from '../components/admin/mine/main.vue'
import apply from '../components/admin/apply/list.vue'
import member from '../components/admin/member/list.vue'
import contentList from '../components/admin/content/list.vue'
import contentAdd from '../components/admin/content/add.vue'
import contentInfo from '../components/admin/content/info.vue'
import contentEdit from '../components/admin/content/edit.vue'
import safe from '../components/admin/mine/safe.vue'
import recruit from '../components/admin/recruit/recruit.vue'
import share from '../components/admin/share/share.vue'
import active from '../components/admin/active/active.vue'
Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            name: 'Main',
            component: main,
            redirect:'/mine',
            children:[
                { path:'mine', component:routerView, redirect:'/mine/index', name:'mine', children:[
                    {path:'index',component:mine},
                    {path:'safe',component:safe}
                ]},
                { path:'apply', component:apply, name:'apply'},
                { path:'member', component:member, name:'member'},
                { path:'recruit', component:recruit, name:'recruit'},
                { path:'share', component:share, name:'share'},
                { path:'active', component:active, name:'active'},
                { path:'content', component:routerView, redirect:'/content/list', name:'content',children:[
                    { path:'list', component:contentList, name:'contentList'},
                    { path:'add', component:contentAdd, name:'contentAdd'},
                    { path:'info/:id', component:contentInfo, name:'contentInfo'},
                    { path:'edit/:id', component:contentEdit, name:'contentEdit'},
                ]},
            ]
        }
    ]
})
