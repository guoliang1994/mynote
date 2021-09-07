import request from '@/utils/request'

export function login(data) {
  return request({
    url: '/sanctum/csrf-cookie',
    method: 'get'
  }).then(res => {
    return request({
      url: '/api/vue-admin-template/user/login',
      method: 'post',
      data
    })
  })
}

export function getInfo() {
  return request({
    url: '/api/vue-admin-template/user/info',
    method: 'get'
  })
}

export function logout() {
  return request({
    url: '/api/vue-admin-template/user/logout',
    method: 'post'
  })
}
