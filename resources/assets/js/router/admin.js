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

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            name: 'Main',
            component: main,
            redirect:'/mine',
            children:[
                { path:'mine', component:mine, name:'mine'},
                { path:'apply', component:apply, name:'apply'},
                { path:'member', component:member, name:'member'},
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
