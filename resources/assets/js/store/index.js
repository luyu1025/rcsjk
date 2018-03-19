/**
 * Created by 12394 on 2017-2-15.
 */
import Vue from 'vue'
import Vuex from 'vuex'
import * as getters from './getters'
import * as actions from './actions'
import mutations from './mutations'

Vue.use(Vuex)
const state = {
  isFull:false,
  //关于标签的数据
  nowTabArray: [],//当前标签数组
  nowTabIndex: 0,//当前标签在数组中的索引
  //用户信息显示状态
  showInfo: false,
  //下面是关于alert的数据
  tipStatus:false,//false关闭 true打开
  tipInfo:{
    type:'',//success,info,warning,danger
    desc:'',//提示tips信息
    isAuto:false,//是否自动关闭
    time:0//自动关闭时间 s为单位
  },
  user:{
    phone:0,
    id:''
  },
  isLogin:true
}
export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations
})
