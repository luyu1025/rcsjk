/**
 * Created by 12394 on 2017-2-15.
 */
import * as types from './mutation-types'

export const logout = ({commit})=>{
  commit(types.CLEAN_USER)
}
export const setUser = ({commit},userInfo)=>{
  commit(types.SET_USER,userInfo)
}
export const isLogin = ({commit},st)=>{
  commit(types.SET_STATE,st)
}
export const SetG = ({commit},g)=>{
  commit(types.SET_G,g)
}
export const SetCar = ({commit},car)=>{
  commit(types.SET_CAR,car)
}
export const SetTemporary = ({commit},g)=>{
  commit(types.SET_TEMPORARY,g)
}
export const ClearTemporary = ({commit},t)=>{
  commit(types.CLEAN_TEMPORARY)
}
export const SetZoom = ({commit},z)=>{
  commit(types.SET_ZOOM)
}
export const SetIsFull = ({commit},z)=>{
  commit(types.SET_IS_FULL)
}
export const SetVehicleCen = ({commit},z)=>{
  commit(types.SET_VEHICLE_CEN)
}
