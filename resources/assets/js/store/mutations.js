/**
 * Created by 12394 on 2017-2-15.
 */
import * as types from './mutation-types'
export default{
  [types.SET_USER](state,userInfo){
    state.user = userInfo
  },
  [types.SET_PRODUCT](state,product){
    state.product.id = product.id
  },
  [types.SET_EQUIPMENT](state,equipment){
    state.equipment.id = equipment.id
  },
  [types.CLEAN_USER](state){
    state.user.name = '';
    state.user.id = '';
  },
  [types.SET_STATE](state,n){
    state.isLogin = n
  },
  [types.ADD_TAB](state,tabLink){
    if (state.nowTabArray.indexOf(tabLink) == -1) state.nowTabArray.push(tabLink)
  },
  [types.CLOSE_TAB](state,index){
    var tem = state.nowTabArray[index].substr(1)
    if(state.temporary[tem]){
      state.temporary[tem].state = false
    }
    state.nowTabArray.splice(index,1)
  },
  [types.INIT_TAB](state) {
    var url = window.location.href
    var path = url.replace(/(.+)#!(.+)/g,'$2')
    state.nowTabArray.push(path)
  },
  [types.SET_NOW_TAB](state, tabLink) {
    state.nowTabIndex = state.nowTabArray.indexOf(tabLink)
  },
  [types.SET_G](state, g) {
    state.g = g
  },
  [types.SET_CAR](state, g) {
    state.car = g
  },
  [types.SET_TEMPORARY](state,g) {  //g的格式为{name:'',data:{}} 其中name为页面路由，data为存入数据
    state.temporary[g.name] = g.data
  },
  [types.CLEAN_TEMPORARY](state,g) {
    state.temporary[g.name] = {state:false}
  },
  [types.SET_ZOOM](state,z){
    state.zoom = z
  },
  [types.SET_IS_FULL](state,s){
    state.isFull = s
  },
  [types.SET_VEHICLE_CEN](state,s){
    state.vehicleCen = s
  }
}
