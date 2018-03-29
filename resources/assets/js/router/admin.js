import Vue from 'vue'
import Router from 'vue-router'

import routerView from '../components/routerView.vue'
import main from '../components/admin/main.vue'
import mine from '../components/admin/mine/main.vue'
import apply from '../components/admin/list/apply.vue'
import member from '../components/admin/list/member.vue'
import contentList from '../components/admin/list/content.vue'
import contentAdd from '../components/admin/add/content.vue'
import contentInfo from '../components/admin/info/content.vue'
import contentEdit from '../components/admin/edit/edit.vue'
import safe from '../components/admin/mine/safe.vue'
import recruit from '../components/admin/list/recruit.vue'
import share from '../components/admin/list/share.vue'
import active from '../components/admin/list/active.vue'
import banner from '../components/admin/list/banner.vue'
import shareAdd from '../components/admin/add/share.vue'
import more from '../components/article/list.vue'
import article from '../components/article/main.vue'

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
                { path:'share', component:routerView, name:'share', redirect:'/share/list', children:[
                    { path:'list', component:share, name:'shareList'},
                    { path:'add', component:shareAdd, name:'shareAdd'},
                ]},
                { path:'active', component:active, name:'active'},
                { path:'content', component:routerView, redirect:'/content/list', name:'content',children:[
                    { path:'list', component:contentList, name:'contentList'},
                    { path:'add', component:contentAdd, name:'contentAdd'},
                    { path:'info/:id', component:contentInfo, name:'contentInfo'},
                    { path:'edit/:id', component:contentEdit, name:'contentEdit'},
                ]},
                { path:'banner', component:banner, name:'banner'},
            ]
        }
    ]
})
